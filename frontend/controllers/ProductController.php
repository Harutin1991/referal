<?php

namespace frontend\controllers;

use frontend\models\Brand;
use frontend\models\Comment;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\TrProduct;
use backend\models\TrBrand;
use frontend\models\Product;
use yii\data\ArrayDataProvider;
use backend\models\ProductImage;
use yii\web\NotFoundHttpException;
use common\models\Favorites;
use frontend\models\Category;
use backend\models\TrCategory;
use yii\data\Pagination;
use common\models\Language;
use backend\models\Currency;
use common\components\CurrencyHelper;
use frontend\models\Attribute;
use backend\models\TrProductAttribute;

/**
 * Product controller
 */
class ProductController extends Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionChangeView() {

        if (Yii::$app->request->isAjax) {
            $view = Yii::$app->request->post('view');
            $get = Yii::$app->request->get();
            $filter = array();
            $params = array();
            $productsCount = Product::productsCount($filter);

            if (!empty($get) && isset($get['page'])) {
                $params['offset'] = $get['page'] * 12;
                $params['limit'] = 12;
                $params['page'] = $get['page'];
                $params['pagescount'] = ceil($productsCount / $params['limit']);
            } else {
                if ($productsCount > 12) {
                    $params['offset'] = 0;
                    $params['limit'] = 12;
                    $params['page'] = 1;
                    $params['pagescount'] = ceil($productsCount / $params['limit']);
                }
            }

            $products = Product::findList($filter, $params);
            $categories = Category::findList();

            if ($view == "list") {
                echo $this->renderPartial('forms/products-list-view', [
                    'products' => $products,
                    'active' => 'list',
                    'page' => $params
                ]);
                exit();
            } else {
                echo $this->renderPartial('forms/products-grid-view', [
                    'products' => $products,
                    'active' => 'grid',
                    'page' => $params
                ]);
                exit();
            }
        }
    }

    public function actionFilter() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $get = Yii::$app->request->get();
            $filter = array();
            $params = array();
            $attribute_id = Yii::$app->request->post('attribute');
            $category_id = Attribute::find()->where(['id' => $attribute_id])->select('category_id')->asArray()->one();

            $filter = ['cat_id' => $category_id['category_id']];
            $productsCount = Product::productsCount($filter);

            if (!empty($get) && isset($get['page'])) {
                $params['offset'] = $get['page'] * 12;
                $params['limit'] = 12;
                $params['page'] = $get['page'];
                $params['pagescount'] = ceil($productsCount / $params['limit']);
            } else {
                if ($productsCount > 12) {
                    $params['offset'] = 0;
                    $params['limit'] = 12;
                    $params['page'] = 1;
                    $params['pagescount'] = ceil($productsCount / $params['limit']);
                }
            }
            $products = Product::findList($filter, $params);
            $provider = new ArrayDataProvider([
                'allModels' => $products,
                'pagination' => [
                    'pageSize' => 6,
                ],
                'sort' => [
                    'attributes' => ['id', 'name'],
                ],
            ]);
            echo $this->renderPartial('forms/products-grid-view', [
                'products' => $products,
                'active' => 'grid',
                'provider' => $provider,
                'page' => $params
            ]);
            exit();
        }
    }

    public function actionIndex($id = null) {
        $filter = array();
        $params = array();
        $cat = array();
        if ($id) {
            $filter['cat_id'] = $id;
            $cat = Category::find()->where(['route_name' => $id])->asArray()->one();
            $attributes = TrProductAttribute::findByCategory($cat['id']);
            $filter = ['cat_id' => $cat['id']];
            $products = Product::findList($filter, $params);
        } else {
            $language = Language::find()->where(['short_code' => Yii::$app->language])->asArray()->one();
            $attributes = TrProductAttribute::find()->where(['language_id' => $language['id']])->asArray()->all();
            $products = Product::findList($filter, $params);
        }
        $categories = Category::findList();

        $provider = new ArrayDataProvider([
            'allModels' => $products,
            'pagination' => [
                'pageSize' => 6,
            ],
            'sort' => [
                'attributes' => ['id', 'name'],
            ],
        ]);

        if (Yii::$app->request->isAjax) {
            $view = Yii::$app->request->post('view');
            setcookie("view_type", $view, '/');

            $rows = $provider->getModels();
            echo $this->renderPartial('forms/products-grid-view', [
                'products' => $products,
                'active' => 'grid',
                'page' => $params,
                'provider' => $provider
            ]);
            exit();
        }

        return $this->render('index', [
                    'products' => $products,
                    'categories' => $categories,
                    'categ' => $cat,
                    'provider' => $provider,
                    'attributes' => $attributes,
                    'cat_id' => $id,
        ]);
    }

    public function actionSubPage($tag) {
        $filter = ['route_name' => $tag];
        $products = Product::findList($filter);
        return $this->render('product', [
                    'products' => $products]);
    }

    public function actionView($id) {
        if (Yii::$app->user->isGuest) {
            Url::remember();
        }

        $model = $this->findModel($id);
        $comments = Comment::findAll(['product_id' => $id]);

        return $this->render('product_view', [
                    'model' => $model,
                    'comments' => $comments
        ]);
    }

    public function actionSearch() {
        if (Yii::$app->request->isAjax) {
            $product_name = Yii::$app->request->post('name');
            $limit = Yii::$app->request->post('limit');
            $products = Product::findList(['like' => $product_name]);
            $html = $this->renderPartial('forms/search-form', [
                'products' => $products,
            ]);

            echo json_encode(['html' => $html]);
            exit();
        }
    }

    private function whatever($array, $val) {
        foreach ($array as $index => $item) {
            if ($index == $val) {
                return $index;
            }
        }
        return false;
    }

    public function actionChangePackage() {
        if (Yii::$app->request->isAjax) {
            $package_id = Yii::$app->request->post('package_id');
            $packageInfo = Product::findPackageInfo($package_id);
            echo json_encode($packageInfo);
            exit();
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

    public function actionAddComment() {
        if (Yii::$app->request->isAjax && !empty(Yii::$app->request->post())) {
            $comment = new Comment();
            echo $comment->addComment();
        }
    }

    public function actionRefreshComments() {
        if (Yii::$app->request->isAjax && !empty(Yii::$app->request->post())) {
            $comments = Comment::findAll(['product_id' => Yii::$app->request->post('productId')]);
            echo $this->renderPartial('product_comment_view', ['comments' => $comments]);
        }
    }

}
