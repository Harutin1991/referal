<?php

namespace backend\controllers;

use Yii;
use backend\models\TrProduct;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use backend\models\User;
use common\models\Language;
use backend\models\Files;
use yii\helpers\BaseFileHelper;
use yii\imagine\Image;
use backend\models\ProductAttribute;
use backend\models\ProductAttributeSearch;
use backend\models\Brand;
use backend\models\Category;
use backend\models\ProductImage;
use backend\models\TrProductAttribute;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller {

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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ProductSearch();
        $model = new Product();
        //$ProductAttributes = new ProductAttribute();
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
        $model = new Product();
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $model = $this->findModel($id);
            $attributes = ProductAttribute::find()->where(['product_id' => $id])->all();
            echo $_form = $this->renderAjax('_form', [
        'model' => $model,
        'categories' => $model->getAllCategories(),
        'attributes' => $attributes
            ]);
            exit();
        }

        $_form = $this->renderPartial('_form', [
            'model' => $model,
            'categories' => $model->getAllCategories(),
            'attributes' => $attributes
        ]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    '_Form' => $_form
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        // $product_parts_model = new ProductParts();
        $product_image_model = new ProductImage();
        // $product_attribute_model = new ProductAttribute();

        return $this->render('view', [
                    'model' => $model,
                    'model_parts' => $product_parts_model,
                    'model_attributes' => $product_attribute_model
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();

            $model = new Product();
            $product_image_model = new ProductImage();
            $ProdDefImg = Yii::$app->request->post('defaultImage');
            $productsCount = Product::find()->count();
            //$product_attribute_model = new ProductAttribute();
            //$ProductAttributeItems = Yii::$app->request->post('ProductAttribute');
            $model->load($post);
            $order = Product::find()// AQ instance
                    ->select('max(ordering)')// we need only one column
                    ->scalar();
            $model->ordering = $order ? $order + 1 : 1;
            $model->art_no = ($productsCount + 1) . "Chew";
            if ($model->save()) {
                $objLang = new Language();
                $languages = $objLang->find()->asArray()->all();

                foreach ($languages as $value) {
                    $product = new TrProduct();
                    $product->name = $model->name;
                    $product->short_description = $model->short_description;
                    $product->description = $model->description;
                    $product->product_id = $model->id;
                    $product->language_id = $value['id'];
                    $product->save();
                }

                $images = UploadedFile::getInstances($model, 'imageFiles');
                $paths = $this->upload($images, $model->id);
                $product_image_model->multiSave($paths, $model->id, $ProdDefImg, 1);
                //$product_attributes = $model->getAttribute($model->id);
                Yii::$app->session->setFlash('success', 'Product successfully created');
                $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
                return $this->render('update', [
                            'model' => $model,
                            'defoultId' => $defaultLanguage->id,
                            //'product_attributes' => $product_attributes,
                            //'categories' => $model->getAllCategories(),
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Somthing want wrong');
                $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
                return $this->render('create', [
                            'model' => $model,
                            'defoultId' => $defaultLanguage->id,
                ]);
            }
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $model = new Product();
            return $this->render('create', [
                        'model' => $model,
                        'defoultId' => $defaultLanguage->id,
                        'categories' => $model->getAllCategories(),
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $product_image_model = new ProductImage();
        $ProdDefImg = Yii::$app->request->post('defaultImage');
        $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
        $product_attributes = $model->getAttribute($id);
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $model->art_no = 1000 + (int) $id . "Chew";
            $model->load($post);
            if ($model->save()) {
                $images = UploadedFile::getInstances($model, 'imageFiles');
                $paths = $this->upload($images, $id);
                $defaultImage = ProductImage::getDefaultImageIdByProductId($model->id);
                if (!empty($defaultImage)) {
                    $product_image_model->multiSave($paths, $model->id, '', 1);
                } else {
                    $product_image_model->multiSave($paths, $model->id, $ProdDefImg, 1);
                }

                $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
                $model->updateDefaultTranslate($defaultLanguage->id);
                echo 'true';
                exit();
            } else {
                return $this->render('update', [
                            'model' => $model,
                            'defoultId' => $defaultLanguage->id,
                ]);
            }
        } else {

            return $this->render('update', [
                        'model' => $model,
                        'defoultId' => $defaultLanguage->id,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $images = ProductImage::getImageByProductId($id);
        $directory = Yii::getAlias("@backend/web/uploads/images/product/" . $id);
        $directoryThumb = Yii::getAlias("@backend/web/uploads/images/product/" . $id . "/thumbnail");
        foreach ($images as $image) {
            if (file_exists($directory . '/' . $image)) {
                unlink($directory . '/' . $image);
            }
            if (file_exists($directoryThumb . '/' . $image)) {
                unlink($directoryThumb . '/' . $image);
            }
        }
        BaseFileHelper::removeDirectory($directoryThumb);
        BaseFileHelper::removeDirectory($directory);

        $languages = Language::find()->asArray()->all();
        foreach ($languages as $language) {
            TrProduct::findOne(['product_id' => $id, 'language_id' => $language['id']])->delete();
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionDeleteByAjax() {
        if (Yii::$app->request->isAjax) {
            $product_ids = Yii::$app->request->post('ids');
            try {
                // $forinkeys = [];
                $allow = true;
                foreach ($product_ids as $id) {
                    $model = ProductImage::findOne(['product_id' => $id]);
                    $directory = Yii::getAlias("@backend/web/uploads/images/product/" . $id);
                    $directoryThumb = Yii::getAlias("@backend/web/uploads/images/product/" . $id . "/thumbnail");

                    if (isset($model->name) && file_exists($directory . '/' . $model->name)) {
                        if (file_exists($directory . '/' . $model->name)) {
                            unlink($directory . '/' . $model->name);
                        }
                        if (file_exists($directoryThumb . '/' . $model->name)) {
                            unlink($directoryThumb . '/' . $model->name);
                        }

                        BaseFileHelper::removeDirectory($directoryThumb);
                        BaseFileHelper::removeDirectory($directory);
                        $model->delete();
                    }
                    Product::deleteAll(['in', 'id', $product_ids]);
                }
                if ($allow) {
                    echo true;
                    exit();
                }
                // print_r(json_encode($forinkeys));
                // exit();
            } catch (\mysqli_sql_exception $e) {
                Yii::$app->session->setFlash('error', 'you are not deleted');
                echo json_encode(['deleted' => 'error']);
                exit();
            }
        }
    }

    public function actionChangestatus() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post('data');
            $data = json_decode($post);
            $model = $this->findModel($data->id);
            $model->status = $data->status;
            if ($model->update()) {
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
            $product_ids = $post['id'];
            $status = $post['status'];
            try {
                if (Product::updateAll(['status' => $status], ['in', 'id', $product_ids])) {
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function upload($imageFile, $id) {
        $productPath = Yii::getAlias("@backend/web/uploads/images/product");
        $directory = Yii::getAlias("@backend/web/uploads/images/product/" . $id);
        $directoryThumb = Yii::getAlias("@backend/web/uploads/images/product/" . $id . "/thumbnail");
        BaseFileHelper::createDirectory($productPath);
        BaseFileHelper::createDirectory($directory);
        BaseFileHelper::createDirectory($directoryThumb);
        if ($imageFile) {
            $paths = [];
            foreach ($imageFile as $key => $image) {
                $uid = uniqid(time(), true);
                $fileName = $uid . '_' . $key . '.' . $image->extension;
                $filePath = $directory . '/' . $fileName;
                $image->saveAs($filePath);
                Image::thumbnail($filePath, 120, 120)->save(Yii::getAlias($directoryThumb . '/' . $fileName), ['quality' => 100]);
                //$filePathThumb = $directoryThumb . '/' . $fileName;
                //$image->saveAs($filePathThumb);
                $paths[$key + 1] = $fileName;
            }
            return $paths;
        }
        return false;
    }

    /**
     * @return string
     */
    public function actionProductDetails() {
        if (Yii::$app->request->isAjax) {
            $category_id = Yii::$app->request->post('category_id');
            $attributes = TrAttribute::getAttributeByCategory($category_id);
//            var_dump($attributes);
            return json_encode($attributes);
        }
    }

    /**
     * @return false|int
     * @throws \Exception
     */
    public function actionDeleteImage() {
        if (Yii::$app->request->isAjax) {
            $model = new ProductImage();
            $id = Yii::$app->request->post('id');
            $model = $model->findOne($id);
            $directory = Yii::getAlias("@backend/web/uploads/images/product/" . $model->product_id);
            $directoryThumb = Yii::getAlias("@backend/web/uploads/images/product/" . $model->product_id . "/thumbnail");

            if (file_exists($directory . '/' . $model->name)) {
                unlink($directory . '/' . $model->name);
                unlink($directoryThumb . '/' . $model->name);
                // BaseFileHelper::removeDirectory($directoryThumb);
                //BaseFileHelper::removeDirectory($directory);
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
            return ProductImage::updatDefaultImage($data['newid'], $data['product_id']);
        }
    }

}
