<?php

namespace backend\controllers;

use common\components\Location;
use Yii;
use backend\models\Service;
use backend\models\ServiceSearch;
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
use backend\models\TrService;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller {

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
                    //'create' => ['POST'],
                    // 'update' => ['POST'],
                    'delete' => ['POST'],
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
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new Service();
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $modelFiles = new Files();
        $images = Files::find()->where(['category' => 'service'])->asArray()->all();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'images' => $images,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Service();
        $modelFiles = new Files();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelFiles = new Files();
            $file = UploadedFile::getInstances($modelFiles, 'path');

            if (!empty($file)) {
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);
                $modelFiles->multiSave($paths, $model->id, $ProdDefImg, 'service');
            }

            $objLang = new Language();
            $languages = $objLang->find()->asArray()->all();
            foreach ($languages as $value) {
                $trmodel = new TrService();
                $trmodel->name = $model->name;
                $trmodel->short_description = $model->short_description;
                $trmodel->description = $model->description;
                $trmodel->service_id = $model->id;
                $trmodel->language_id = $value['id'];
                $trmodel->save();
            }
            Yii::$app->session->setFlash('success', 'Service successfully created');
            return $this->redirect(['update',
                        'id' => $model->id,
                        'modelFiles' => $modelFiles,
            ]);
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            return $this->render('create', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'defoultId' => $defaultLanguage->id
            ]);
        }
    }

    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelFiles = new Files();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $file = UploadedFile::getInstances($modelFiles, 'path');
            if (!empty($file)) {
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);
                $modelFiles->multiSave($paths, $model->id, $ProdDefImg, 'service');
            }
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $model->updateDefaultTranslate($defaultLanguage->id);
            return json_encode(['success' => true]);
        } else {
            $images = Files::find()->where(['category' => 'service', 'category_id' => $id])->asArray()->all();
            $modelFiles = new Files();
            return $this->render('update', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'images' => $images,
            ]);
        }
    }

    public function actionDeleteByAjax() {

        if (Yii::$app->request->isAjax) {
            $brand_ids = Yii::$app->request->post('ids');
            try {
                Service::deleteAll(['in', 'id', $brand_ids]);
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
     * change Service status with ajax
     */
    public function actionChangestatus() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post('data');
            $data = json_decode($post);
            $model = $this->findModel($data->id);
            $model->status = $data->status;
            if ($model->save()) {
                echo 'true';
                exit();
            } else {
                echo 'false';
                exit();
            }
        }
    }

    public function actionPartbyproduct() {
        if (Yii::$app->request->isAjax) {
            $prodct_id = Yii::$app->request->post('id');
            $repairs = new Repairs();
            $parts = $repairs->getPartsByProduct($prodct_id);
            return json_encode($parts);
        }
    }

    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function upload($imageFile, $id) {
        $directory = Yii::getAlias("@backend/web/uploads/images/service/" . $id);
        $directoryThumb = Yii::getAlias("@backend/web/uploads/images/service/" . $id . "/thumbnail");
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
                Image::thumbnail($filePath, 800, 600)->save(Yii::getAlias($directoryThumb . '/' . $fileName), ['quality' => 100]);
                $paths[$key + 1] = $fileName;
            }
            return $paths;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function actionDefaultImage() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            return Files::updatDefaultImage($data['newid'], $data['product_id'],$data['category']);
        }
    }

}
