<?php

namespace backend\controllers;

use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use backend\models\TrNews;
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

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET', 'POST'],
                    'view' => ['GET'],
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'POST'],
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => 'common\components\CAccessRule',
                ],
                'only' => ['index', 'view', 'create', 'update', 'delete', 'allrules', 'trcats', 'trproducts'],
                'rules' => [
                    // allow authenticated users
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'allrules', 'trcats', 'trproducts'],
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new News();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelFiles = new Files();
            $file = UploadedFile::getInstances($modelFiles, 'path');

            if (!empty($file)) {
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);
                $modelFiles->multiSave($paths, $model->id, $ProdDefImg, 'news');
            }

            $objLang = new Language();
            $languages = $objLang->find()->asArray()->all();
            foreach ($languages as $value) {
                $trmodel = new TrNews();
                $trmodel->name = $model->title;
                $trmodel->short_description = $model->short_description;
                $trmodel->description = $model->description;
                $trmodel->news_id = $model->id;
                $trmodel->language_id = $value['id'];
                $trmodel->save();
            }
            Yii::$app->session->setFlash('success', 'Material successfully created');
            return $this->redirect(['update',
                        'id' => $model->id,
                        'modelFiles' => $modelFiles,
            ]);
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $modelFiles = new Files();
            return $this->render('create', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'defoultId' => $defaultLanguage->id
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelFiles = new Files();
            $file = UploadedFile::getInstances($modelFiles, 'path');

            if (!empty($file)) {
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);

                foreach ($paths as $key => $value) {
                    $updateFile = new Files();
                    if ($key == $ProdDefImg) {
                        $updateFile->path = $value;
                        $updateFile->category_id = $model->id;
                        $updateFile->category = 'news';
                        $updateFile->top = $ProdDefImg;
                        $updateFile->status = 1;
                    } else {
                        $updateFile->path = $value;
                        $updateFile->category_id = $model->id;
                        $updateFile->category = 'news';
                        $updateFile->top = 0;
                        $updateFile->status = 1;
                    }
                    $updateFile->save();
                }
            }
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $trmodel = TrNews::findOne(['news_id' => $id, 'language_id' => $defaultLanguage->id]);
            $trmodel->name = $model->title;
            $trmodel->short_description = $model->short_description;
            $trmodel->description = $model->description;
            $trmodel->save();
            return json_encode(['success' => true]);
        } else {
            $images = Files::find()->where(['category' => 'news', 'category_id' => $id])->asArray()->all();
            $modelFiles = new Files();
            return $this->render('update', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'images' => $images,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function upload($imageFile, $id) {
        $directory = Yii::getAlias("@backend/web/uploads/images/news/" . $id);
        $directoryThumb = Yii::getAlias("@backend/web/uploads/images/news/" . $id . "/thumbnail");
        BaseFileHelper::createDirectory($directory);
        BaseFileHelper::createDirectory($directoryThumb);
        if ($imageFile) {
            $paths = [];
            foreach ($imageFile as $key => $image) {
                $uid = uniqid(time(), true);
                $fileName = $uid . '_' . $key . '.' . $image->extension;
                $fileName_return = $fileName;
                $filePath = $directory . '/' . $fileName;
                $filePathThumb = $directoryThumb . '/' . $fileName;
                $image->saveAs($filePath);
                Image::thumbnail($filePath, 120, 120)->save(Yii::getAlias($directoryThumb . '/' . $fileName), ['quality' => 100]);
                $paths[$key + 1] = $fileName_return;
            }
            return $paths;
        }
        return false;
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
            $directory = Yii::getAlias("@backend/web/uploads/images/news/" . $model->category_id);
            $directoryThumb = Yii::getAlias("@backend/web/uploads/images/news/" . $model->category_id . "/thumbnail");

            // BaseFileHelper::removeDirectory($directoryThumb);
            //BaseFileHelper::removeDirectory($directory);
            if (file_exists($directory . '/' . $model->path)) {
                unlink($directory . '/' . $model->path);
                unlink($directoryThumb . '/' . $model->path);
            }
            return $model->delete();
        }
    }

    public function actionDeleteByAjax() {

        if (Yii::$app->request->isAjax) {
            $brand_ids = Yii::$app->request->post('ids');
            try {
                News::deleteAll(['in', 'id', $brand_ids]);
                echo true;
                exit();
            } catch (\mysqli_sql_exception $e) {
                Yii::$app->session->setFlash('error', 'you are not deleted');
                echo json_encode(['deleted' => 'error']);
                exit();
            }
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
