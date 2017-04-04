<?php

namespace backend\controllers;

use Yii;
use backend\models\Partners;
use backend\models\PartnersSearch;
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
use backend\models\TrPartners;

/**
 * PartnersController implements the CRUD actions for Partners model.
 */
class PartnersController extends Controller {

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
     * Lists all Partners models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PartnersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Partners();
        $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'defoultId' => $defaultLanguage->id
        ]);
    }

    /**
     * Displays a single Partners model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Partners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Partners();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelFiles = new Files();
            $file = UploadedFile::getInstances($modelFiles, 'path');

            if (!empty($file)) {
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);
                $modelFiles->multiSave($paths, $model->id, $ProdDefImg, 'partners');
            }

            $objLang = new Language();
            $languages = $objLang->find()->asArray()->all();
            foreach ($languages as $value) {
                $trmodel = new TrPartners();
                $trmodel->title = $model->title;
                $trmodel->short_description = $model->short_description;
                $trmodel->partners_id = $model->id;
                $trmodel->language_id = $value['id'];
                $trmodel->save();
            }
            Yii::$app->session->setFlash('success', 'Partner successfully created');
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
     * Updates an existing Partners model.
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
                        $updateFile->category = 'partners';
                        $updateFile->top = $ProdDefImg;
                        $updateFile->status = 1;
                    } else {
                        $updateFile->path = $value;
                        $updateFile->category_id = $model->id;
                        $updateFile->category = 'materials';
                        $updateFile->top = 0;
                        $updateFile->status = 1;
                    }
                    $updateFile->save();
                }
                //$modelFiles->multiUpdate($paths, $model->id, $ProdDefImg, 'news');
            }
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $trmodel = TrPartners::findOne(['partners_id' => $id, 'language_id' => $defaultLanguage->id]);
            $trmodel->title = $model->title;
            $trmodel->short_description = $model->short_description;
            $trmodel->save();
            //$model->updateDefaultTranslate();
            return json_encode(['success' => true]);
        } elseif (Yii::$app->request->isAjax && !$model->save()) {
            return json_encode(['success' => false, 'message' => $model->errors]);
        } else {
            $images = Files::find()->where(['category' => 'partners', 'category_id' => $id])->asArray()->all();
            $modelFiles = new Files();
            return $this->render('update', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'images' => $images,
            ]);
        }
    }

    /**
     * Deletes an existing Partners model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Partners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Partners::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function upload($imageFile, $id) {
        $directory = Yii::getAlias("@backend/web/uploads/images/partners/" . $id);
        $directoryThumb = Yii::getAlias("@backend/web/uploads/images/partners/" . $id . "/thumbnail");
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
            $directory = Yii::getAlias("@backend/web/uploads/images/partners/" . $model->category_id);
            $directoryThumb = Yii::getAlias("@backend/web/uploads/images/partners/" . $model->category_id . "/thumbnail");

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
            $partners_ids = Yii::$app->request->post('ids');

            try {
                Partners::deleteAll(['in', 'id', $partners_ids]);
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
            return Files::updatDefaultImage($data['newid'], $data['product_id'],$data['category']);
        }
    }

}
