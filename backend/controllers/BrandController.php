<?php

namespace backend\controllers;

use common\models\Language;
use frontend\models\TrBrand;
use Yii;
use backend\models\Brand;
use backend\models\BrandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;
use backend\models\Product;
use yii\web\UploadedFile;
use backend\models\Files;
use yii\helpers\BaseFileHelper;
use yii\imagine\Image;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class BrandController extends Controller {

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
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new Brand();
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $defaultLanguage = Language::find()->where(['is_default' => 1])->one();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'defoultId' => $defaultLanguage->id
        ]);
    }

    /**
     * Lists all Brand models.
     * @return mixed
     */
    public function actionGetform() {
        $model = new Brand();
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = $this->findModel($id);
            echo $_form = $this->renderPartial('_form', [
        'model' => $model,
            ]);
            exit();
        }

        $_form = $this->renderPartial('_form', [
            'model' => $model,
        ]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    '_Form' => $_form
        ]);
    }

    /**
     * Displays a single Brand model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->request->post()) {
            $brand = new Brand();
            $modelFiles = new Files();
            $postData = Yii::$app->request->post('Brand');
            $brand->setAttributes($postData);
            $order = Brand::find() // AQ instance
                    ->select('max(ordering)') // we need only one column
                    ->scalar();
            $brand->ordering = $order ? $order + 1 : 1;
            if ($brand->save()) {
                $file = UploadedFile::getInstances($modelFiles, 'path');
                if (!empty($file)) {
                    $path = Yii::getAlias("@backend/web/uploads/images/brand");
                    $pathImage = Yii::getAlias("@backend/web/uploads/images/brand/" . $brand->id);
                    $directoryThumb = Yii::getAlias("@backend/web/uploads/images/brand/" . $brand->id . "/thumbnail");
                    BaseFileHelper::createDirectory($path);
                    BaseFileHelper::createDirectory($pathImage);
                    BaseFileHelper::createDirectory($directoryThumb);
                    $file_ext = explode(".", $file[0]->name);
                    $ext = $file_ext[count($file_ext) - 1];
                    $name = \Yii::$app->security->generateRandomString(8) . ".{$ext}";
                    if ($file[0]->saveAs($pathImage . DIRECTORY_SEPARATOR . $name)) {
                        Image::thumbnail($pathImage . DIRECTORY_SEPARATOR . $name, 120, 120)->save(Yii::getAlias($directoryThumb . '/' . $name), ['quality' => 100]);
                        $modelFiles->path =  $name;
                        $modelFiles->category_id = $brand->id;
                        $modelFiles->category = "brand";
                        $modelFiles->status = 1;
                        $modelFiles->top = 1;
                        $modelFiles->save();
                    }
                }
                $objLang = new Language();
                $languages = $objLang->find()->asArray()->all();
                foreach ($languages as $value) {

                    $model = new TrBrand();
                    $model->name = $brand->name;
                    $model->brand_id = $brand->id;
                    $model->language_id = $value['id'];
                    $model->save();
                }
                Yii::$app->session->setFlash('success', 'Brand successfully created');
                return $this->redirect(['update',
                            'id' => $brand->id,
                            'modelFiles' => $modelFiles,
                ]);
            }
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $modelFiles = new Files();
            $model = new Brand();
            return $this->render('create', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'defoultId' => $defaultLanguage->id
            ]);
        }
    }

    /**
     * Updates an existing Brand model.
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
                $path = Yii::getAlias("@backend/web/uploads/images/brand");
                $pathImage = Yii::getAlias("@backend/web/uploads/images/brand/" . $model->id);
                $directoryThumb = Yii::getAlias("@backend/web/uploads/images/brand/" . $model->id . "/thumbnail");
                BaseFileHelper::createDirectory($path);
                BaseFileHelper::createDirectory($pathImage);
                BaseFileHelper::createDirectory($directoryThumb);
                $file_ext = explode(".", $file[0]->name);
                $ext = $file_ext[count($file_ext) - 1];
                $name = \Yii::$app->security->generateRandomString(8) . ".{$ext}";
                if ($file[0]->saveAs($pathImage . DIRECTORY_SEPARATOR . $name)) {
                    Image::thumbnail($pathImage . DIRECTORY_SEPARATOR . $name, 120, 120)->save(Yii::getAlias($directoryThumb . '/' . $name), ['quality' => 100]);
                    $modelFiles->path =  $name;
                    $modelFiles->category_id = $model->id;
                    $modelFiles->category = "brand";
                    $modelFiles->status = 1;
                    $modelFiles->top = 1;
                    $modelFiles->save();
                }
            }
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $model->updateDefaultTranslate($defaultLanguage->id);
            return true;
        } else {
            $images = Files::find()->where(['category' => 'brand', 'category_id' => $id])->asArray()->all();
            $modelFiles = new Files();

            return $this->render('update', [
                        'model' => $model,
                        'modelFiles' => $modelFiles,
                        'images' => $images,
            ]);
        }
    }

    /**
     * Deletes an existing Brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $productCount = Product::find()->where(['brand_id' => $id])->count();
        if ($productCount > 0) {
            Yii::$app->session->setFlash('error', 'Sorry, brand was connected with Product');
            return $this->redirect(['index']);
        } else {
            $tr_brands = TrBrand::find()->where(['brand_id' => $id])->all();
            if (!is_null($tr_brands)) {
                foreach ($tr_brands as $tr_brand) {
                    $tr_brand->delete();
                }
                if (TrBrand::find()->where(['brand_id' => $id])->count() == 0) {
                    $this->findModel($id)->delete();
                    Yii::$app->session->setFlash('success', 'Brand successfully removed');
                    return $this->redirect(['index']);
                }
            } else {
                $this->findModel($id)->delete();
                return $this->redirect(['index']);
            }
        }
    }

    public function actionDeleteByAjax() {

        if (Yii::$app->request->isAjax) {
            $brand_ids = Yii::$app->request->post('ids');
            try {
                $forinkeys = [];
                $allow = true;
                foreach ($brand_ids as $id) {
                    $product = Product::find()->where(['brand_id' => $id])->one();
                    if (!empty($product)) {
                        $allow = false;
                        $forinkeys[$id]['product'] = $product;
                    }
                }
                if ($allow) {
                    Brand::deleteAll(['in', 'id', $brand_ids]);
                    echo true;
                    exit();
                }
                print_r(json_encode($forinkeys));
                exit();
            } catch (\mysqli_sql_exception $e) {
                Yii::$app->session->setFlash('error', 'you are not deleted');
                echo json_encode(['deleted' => 'error']);
                exit();
            }
        }
    }

    /**
     * @return mixed
     */
    public function actionUpdateOrdering() {
        if (Yii::$app->request->isAjax) {
            $model = new Brand();
            $data = Yii::$app->request->post();
            return $model->bachUpdate($data);
        }
    }

    /**
     * change Brand status with ajax
     */
    public function actionChangestatus() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post('data');
            $model = $this->findModel($post['id']);
            $model->status = $post['status']; //$data->status;
            if ($model->save()) {
                echo 'true';
                exit();
            } else {
                echo 'false';
                exit();
            }
        }
    }

    public function actionChangeitemsstatus() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post('data');
            $brand_ids = $post['id'];
            $status = $post['status'];
            try {
                if (Brand::updateAll(['status' => $status], ['in', 'id', $brand_ids])) {
                    echo true;
                    exit();
                }
                echo false;
                exit();
            } catch (\mysqli_sql_exception $e) {
                echo false;
                exit();
            }
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
            $directory = Yii::getAlias("@backend/web/uploads/images/brand/" . $model->category_id);
            $directoryThumb = Yii::getAlias("@backend/web/uploads/images/brand/" . $model->category_id . "/thumbnail");

            //BaseFileHelper::removeDirectory($directoryThumb);
            //BaseFileHelper::removeDirectory($directory);
            if (file_exists($directory . '/' . $model->path)) {
                unlink($directory . '/' . $model->path);
                unlink($directoryThumb . '/' . $model->path);
                BaseFileHelper::removeDirectory($directoryThumb);
                BaseFileHelper::removeDirectory($directory);
            }
            return $model->delete();
        }
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
