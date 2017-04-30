<?php

namespace backend\controllers;

use Yii;
use backend\models\HowToEarn;
use backend\models\HowToEarnSearch;
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
use backend\models\TrHowToEarn;

/**
 * HowToEarnController implements the CRUD actions for HowToEarn model.
 */
class HowToEarnController extends Controller {

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
     * Lists all HowToEarn models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new HowToEarnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HowToEarn model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HowToEarn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new HowToEarn();

        if ($model->load(Yii::$app->request->post())) {
            $order = HowToEarn::find()// AQ instance
                    ->select('max(ordering)')// we need only one column
                    ->scalar();
            $model->ordering = $order ? $order + 1 : 1;
            $model->save();
            $modelFiles = new Files();
            $file = UploadedFile::getInstances($modelFiles, 'path');

            if (!empty($file)) {
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);
                $modelFiles->multiSave($paths, $model->id, $ProdDefImg, 'how_to_earn');
            }
            $objLang = new Language();
            $languages = $objLang->find()->asArray()->all();
            foreach ($languages as $value) {
                $trmodel = new TrHowToEarn();
                $trmodel->short_description = $model->short_description;
                $trmodel->how_to_earn_id = $model->id;
                $trmodel->language_id = $value['id'];
                $trmodel->save();
            }
            Yii::$app->session->setFlash('success', Yii::t('app', 'How To earn successfully created'));
            return $this->redirect('index');
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $modelFiles = new Files();
            $trmodel = new TrHowToEarn();
            return $this->render('create', [
                        'model' => $model,
                        'trmodel' => $trmodel,
                        'modelFiles' => $modelFiles,
                        'defoultId' => $defaultLanguage->id
            ]);
        }
    }

    /**
     * Updates an existing HowToEarn model.
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
                $oldFiles = Files::find()->where(['category' => 'how_to_earn', 'category_id' => $id])->asArray()->all();
                if (!empty($oldFiles)) {
                    $filemodel = Files::findOne($oldFiles[0]['id']);
                    $directory = Yii::getAlias("@backend/web/uploads/images/how_to_earn/" . $id);
                    $directoryThumb = Yii::getAlias("@backend/web/uploads/images/how_to_earn/" . $id . "/thumbnail");

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
                        $updateFile->category = 'how_to_earn';
                        $updateFile->top = $ProdDefImg;
                    } else {
                        $updateFile->path = $value;
                        $updateFile->category_id = $model->id;
                        $updateFile->category = 'how_to_earn';
                        $updateFile->top = 0;
                    }
                    $updateFile->save();
                }
            }
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $model->updateDefaultTranslate($defaultLanguage->id);
            return $this->redirect('index');
        } else {
            $images = Files::find()->where(['category' => 'how_to_earn', 'category_id' => $id])->asArray()->all();
            $modelFiles = new Files();
            return $this->render('update', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'imagePaths' => $images,
            ]);
        }
    }

    /**
     * Deletes an existing HowToEarn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HowToEarn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HowToEarn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = HowToEarn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function upload($imageFile, $id) {
        $directoryBlog = Yii::getAlias("@backend/web/uploads/images/how_to_earn/");
        $directory = Yii::getAlias("@backend/web/uploads/images/how_to_earn/" . $id);
        $directoryThumb = Yii::getAlias("@backend/web/uploads/images/how_to_earn/" . $id . "/thumbnail");
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
            $directory = Yii::getAlias("@backend/web/uploads/images/how_to_earn/" . $model->category_id);
            $directoryThumb = Yii::getAlias("@backend/web/uploads/images/how_to_earn/" . $model->category_id . "/thumbnail");

            // BaseFileHelper::removeDirectory($directoryThumb);
            //BaseFileHelper::removeDirectory($directory);
            if (file_exists($directory . '/' . $model->path)) {
                unlink($directory . '/' . $model->path);
                unlink($directoryThumb . '/' . $model->path);
            }

            return $model->delete();
        }
    }

}
