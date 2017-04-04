<?php

namespace backend\controllers;

use backend\models\ProductAttribute;
use Yii;
use backend\models\TrAttribute;
use backend\models\Attribute;
use backend\models\AttributeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;
use common\models\Language;

/**
 * AttributeController implements the CRUD actions for Attribute model.
 */
class AttributeController extends Controller {

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
     * Lists all Attribute models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new Attribute();
        $searchModel = new AttributeSearch();
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
     *  Attriibute form for index page
     * @return form
     */
    public function actionGetform() {
        $model = new Attribute();
        $searchModel = new AttributeSearch();
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
     * Displays a single Attribute model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Attribute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->request->post()) {
            $attribute = new Attribute();
            $postData = Yii::$app->request->post('Attribute');
            $attribute->name = $postData['name'];
            $attribute->category_id = $postData['category_id'];
            $attribute->type = 1;
            $order = Attribute::find() // AQ instance
                    ->select('max(ordering)') // we need only one column
                    ->scalar();
            $attribute->ordering = $order ? $order + 1 : 1;
            if ($attribute->save()) {
                $objLang = new Language();
                $languages = $objLang->find()->asArray()->all();
                foreach ($languages as $value) {
                        $model = new TrAttribute();
                        $model->name = $attribute->name;
                        $model->attribute_id = $attribute->id;
                        $model->language_id = $value['id'];
                        $model->save();
                }
                Yii::$app->session->setFlash('success', 'Attribute successfully created');
                return $this->redirect(['update',
                    'id' => $attribute->id,

                ]);
            }
        } else {
            $defaultLanguage = Language::find()->where(['is_default'=>1])->one();
            $model = new Attribute();
            return $this->render('create', [
                'model' => $model,
                'defoultId'=>$defaultLanguage->id

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $model->updateDefaultTranslate($defaultLanguage->id);
           return true;
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Attribute model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $tr_attributes = TrAttribute::find(['attribute_id' => $id])->all();
        
        foreach($tr_attributes as $tr_attribute){
            $tr_attribute->delete();
        }
        if (TrAttribute::find()->where(['attribute_id'=>$id])->count() == 0) {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Attribute successfully removed');
            return $this->redirect(['index']);
        }
    }
    public function actionDeleteByAjax(){

        if (Yii::$app->request->isAjax) {
            $attribute_ids = Yii::$app->request->post('ids');

            try {
                $forinkeys = [];
                $allow = true;
                foreach ($attribute_ids as $id){
                    $productAttribute = ProductAttribute::find()->where(['attribute_id'=> $id])->one();
                    if (!empty($productAttribute)){
                        $allow = false;
                        $forinkeys[$id]['product'] = $productAttribute;
                    }
                }
                if($allow){
                    Attribute::deleteAll(['in','id', $attribute_ids]);
                    echo true; exit();
                }
                print_r(json_encode($forinkeys)); exit();
            } catch (\mysqli_sql_exception $e) {
                Yii::$app->session->setFlash('error', 'you are not deleted');
                echo json_encode(['deleted' => 'error']); exit();
            }
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
        if (($model = Attribute::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetAttributesByCategory() {
        if (Yii::$app->request->isAjax) {
            $category_id = Yii::$app->request->post('id');
            $attributes = Attribute::find()->where(['category_id' => $category_id])->asArray()->all();
            echo $this->renderPartial('attributes', [
                'attributes' => $attributes,
            ]);
            exit();
        }
    }

}
