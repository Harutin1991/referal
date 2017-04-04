<?php

namespace backend\controllers;

use Yii;
use backend\models\Works;
use backend\models\WorksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TrWorks;
use yii\web\UploadedFile;
use backend\models\Files;
use yii\helpers\BaseFileHelper;
use yii\filters\AccessControl;
use backend\models\User;
use common\models\Language;
use yii\imagine\Image;

/**
 * WorksController implements the CRUD actions for Works model.
 */
class WorksController extends Controller {

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
     * Lists all Works models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new WorksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Works();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Works model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Works model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->request->post()) {
            $works = $model = new Works();
            $modelFiles = new Files();
            $postData = Yii::$app->request->post('Works');
            $works->setAttributes($postData);

            /* $order = Works::find() // AQ instance
              ->select('max(ordering)') // we need only one column
              ->scalar();
             */
            //$ordering = $order ? $order + 1 : 1;
            //  $works->setAttribute('ordering', $ordering);
            if ($works->save()) {
                $modelFiles = new Files();
                $file = UploadedFile::getInstances($modelFiles, 'path');

                if (!empty($file)) {
                    $ProdDefImg = Yii::$app->request->post('defaultImage');
                    $paths = $this->upload($file, $model->id);
                    $modelFiles->multiSave($paths, $model->id, $ProdDefImg, 'work');
                }


                $objLang = new Language();
                $languages = $objLang->find()->asArray()->all();
                foreach ($languages as $value) {
                    $model = new TrWorks();
                    $model->name = $works->name;
                    $model->short_description = $works->short_description;
                    $model->description = $works->description;
                    $model->works_id = $works->id;
                    $model->language_id = $value['id'];
                    $model->save();
                }
                Yii::$app->session->setFlash('success', 'Category successfully created');
                return $this->redirect(['update',
                            'id' => $works->id,
                            'modelFiles' => $modelFiles,
                ]);
            } else {
                $defaultLanguage = Language::find()->where(['is_default' => 1])->one();

                return $this->render('create', [
                            'model' => $category,
                            'modelFiles' => $modelFiles,
                            'defoultId' => $defaultLanguage->id
                ]);
            }
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $model = new Works();
            $modelFiles = new Files();
            return $this->render('create', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'defoultId' => $defaultLanguage->id
            ]);
        }
    }

    /**
     * Updates an existing Works model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelFiles = new Files();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!empty($file)) {
                $ProdDefImg = Yii::$app->request->post('defaultImage');
                $paths = $this->upload($file, $model->id);

                foreach ($paths as $key => $value) {
                    $updateFile = new Files();
                    if ($key == $ProdDefImg) {
                        $updateFile->path = $value;
                        $updateFile->category_id = $model->id;
                        $updateFile->category = 'work';
                        $updateFile->top = $ProdDefImg;
                        $updateFile->status = 1;
                    } else {
                        $updateFile->path = $value;
                        $updateFile->category_id = $model->id;
                        $updateFile->category = 'work';
                        $updateFile->top = 0;
                        $updateFile->status = 1;
                    }
                    $updateFile->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $images = Files::find()->where(['category' => 'work', 'category_id' => $id])->asArray()->all();
            $modelFiles = new Files();
            return $this->render('update', [
                        'model' => $model,
                        'images' => $images,
                        'modelFiles' => $modelFiles,
            ]);
        }
    }

    /**
     * Deletes an existing Works model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Works model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Works the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Works::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
            $directory = Yii::getAlias("@backend/web/uploads/images/work/" . $model->category_id);
            $directoryThumb = Yii::getAlias("@backend/web/uploads/images/work/" . $model->category_id . "/thumbnail");

            if (file_exists($directory . '/' . $model->path)) {
                unlink($directory . '/' . $model->path);
                unlink($directoryThumb . '/' . $model->path);
                BaseFileHelper::removeDirectory($directoryThumb);
                BaseFileHelper::removeDirectory($directory);
            }

            return $model->delete();
        }
    }

    public function actionDeleteByAjax() {

        if (Yii::$app->request->isAjax) {
            $works_ids = Yii::$app->request->post('ids');

            try {
                Works::deleteAll(['in', 'id', $works_ids]);
                TrWorks::deleteAll(['in', 'works_id', $works_ids]);
                echo true;exit();
            } catch (\mysqli_sql_exception $e) {
                Yii::$app->session->setFlash('error', 'you are not deleted');
                echo json_encode(['deleted' => 'error']);exit();
            }
        }
    }

    public function upload($imageFile, $id) {
        $directory = Yii::getAlias("@backend/web/uploads/images/work/" . $id);
        $directoryThumb = Yii::getAlias("@backend/web/uploads/images/work/" . $id . "/thumbnail");
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
     * @return bool
     */
    public function actionDefaultImage() {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            return Files::updatDefaultImage($data['newid'], $data['product_id'],$data['category']);
        }
    }

}
