<?php

namespace backend\controllers;

use Yii;
use backend\models\Blog;
use backend\models\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;
use yii\web\UploadedFile;
use backend\models\Files;
use yii\helpers\BaseFileHelper;
use common\models\Language;
use yii\imagine\Image;
use backend\models\TrBlog;
/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'view' => ['GET'],
                    'create' => ['POST', 'GET'],
                    'update' => ['POST', 'GET'],
                    'delete' => ['POST', 'GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => 'common\components\CAccessRule',
                ],
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            User::ADMIN,
                        ],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BlogSearch();
        $model = new Blog();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Blog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelFiles = new Files();
            $file = UploadedFile::getInstances($modelFiles, 'path');

            if (!empty($file)) {
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);
                $modelFiles->multiSave($paths, $model->id, $ProdDefImg, 'blog');
            }
            $objLang = new Language();
            $languages = $objLang->find()->asArray()->all();
            foreach ($languages as $value) {
                $trmodel = new TrBlog();
                $trmodel->title = $model->title;
                $trmodel->short_description = $model->short_description;
                $trmodel->description = $model->description;
                $trmodel->meta_description = $model->meta_description;
                $trmodel->meta_key = $model->meta_key;
                $trmodel->blog_id = $model->id;
                $trmodel->language_id = $value['id'];
                $trmodel->save();
            }
            Yii::$app->session->setFlash('success', Yii::t('app','Blog successfully created'));
           /*  return $this->redirect(['update',
                        'id' => $model->id,
                        'modelFiles' => $modelFiles,
            ]); */
			return $this->redirect('index');
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $modelFiles = new Files();
            $trmodel = new TrBlog();
            return $this->render('create', [
                        'model' => $model,
                        'trmodel' => $trmodel,
                        'modelFiles' => $modelFiles,
                        'defoultId' => $defaultLanguage->id
            ]);
        }
    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelFiles = new Files();
            $file = UploadedFile::getInstances($modelFiles, 'path');
            if (!empty($file)) {
				$oldFiles = Files::find()->where(['category' => 'blog', 'category_id' => $id])->asArray()->all();
				if(!empty($oldFiles)){
					$filemodel = Files::findOne($oldFiles[0]['id']);
					$directory = Yii::getAlias("@backend/web/uploads/images/blog/" . $id);
					$directoryThumb = Yii::getAlias("@backend/web/uploads/images/blog/" . $id . "/thumbnail");

					// BaseFileHelper::removeDirectory($directoryThumb);
					//BaseFileHelper::removeDirectory($directory);
					if (file_exists($directory . '/' . $oldFiles[0]['path'])) {
						unlink($directory . '/' . $oldFiles[0]['path']);
						unlink($directoryThumb . '/' . $oldFiles[0]['path']);
					}
					$filemodel->delete();
				}
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);

                foreach ($paths as $key => $value) {
                    $updateFile = new Files();
                    if ($key == $ProdDefImg) {
                        $updateFile->path = $value;
                        $updateFile->category_id = $model->id;
                        $updateFile->category = 'blog';
                        $updateFile->top = $ProdDefImg;
                    } else {
                        $updateFile->path = $value;
                        $updateFile->category_id = $model->id;
                        $updateFile->category = 'blog';
                        $updateFile->top = 0;
                    }
                    $updateFile->save();
                }
            }
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $model->updateDefaultTranslate($defaultLanguage->id);
            return json_encode(['success' => true]);
        } else {
            $images = Files::find()->where(['category' => 'blog', 'category_id' => $id])->asArray()->all();
            $modelFiles = new Files();
            return $this->render('update', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'imagePaths' => $images,
            ]);
        }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        
        $trmodel = TrBlog::find()->where(['blog_id'=>$id])->all();
        foreach($trmodel as $blog){
            $blog->delete();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findTrModel($id) {
        $currentLanguage = Language::find()->where(['short_code' => Yii::$app->language])->one();
        if (($model = TrBlog::findOne(['blog_id'=>$id,'language_id'=>$currentLanguage->id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function upload($imageFile, $id) {
        $directoryBlog = Yii::getAlias("@backend/web/uploads/images/blog/");
        $directory = Yii::getAlias("@backend/web/uploads/images/blog/" . $id);
        $directoryThumb = Yii::getAlias("@backend/web/uploads/images/blog/" . $id . "/thumbnail");
        BaseFileHelper::createDirectory($directoryBlog);
        BaseFileHelper::createDirectory($directory);
        BaseFileHelper::createDirectory($directoryThumb);
        if ($imageFile) {
            $paths = [];
            foreach ($imageFile as $key => $image) {
                $uid = uniqid(time(), true);
                $fileName = $uid . '_' . $key . '.' . $image->extension;
                $filePath = $directory . '/' . $fileName;
                $filePathThumb = $directoryThumb . '/' . $fileName;
                $image->saveAs($filePath);
                Image::thumbnail($filePath, 120, 120)->save(Yii::getAlias($directoryThumb . '/' . $fileName), ['quality' => 100]);
                $paths[$key + 1] = $fileName;
            }
            return $paths;
        }
        return false;
    }
    
    /**
     * @return mixed
     */
    public function actionUpdateOrdering() {
        if (Yii::$app->request->isAjax) {
            $model = new Blog();
            $data = Yii::$app->request->post();
            return $model->bachUpdate($data);
        }
    }

    /**
     * @return false|int
     * @throws \Exception
     */
    public function actionDeleteImage() {
        if (Yii::$app->request->isAjax) {
            $model = new Files();
            $id = Yii::$app->request->post('id');
            $model = $model->findOne($id);
            $directory = Yii::getAlias("@backend/web/uploads/images/blog/" . $model->category_id);
            $directoryThumb = Yii::getAlias("@backend/web/uploads/images/blog/" . $model->category_id . "/thumbnail");

            // BaseFileHelper::removeDirectory($directoryThumb);
            //BaseFileHelper::removeDirectory($directory);
            if (file_exists($directory . '/' . $model->path)) {
                unlink($directory . '/' . $model->path);
                unlink($directoryThumb . '/' . $model->path);
            }

            return $model->delete();
        }
    }

    /**
     * @return bool
     */
    public function actionDefaultImage() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            return Files::updatDefaultImage($data['newid'], $data['product_id']);
        }
    }

}
