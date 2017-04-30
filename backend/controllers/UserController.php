<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Customer;
use common\models\CustomerAddress;
use backend\models\CustomerSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
        $customermodel = new Customer();
        $customermodelAddress = new CustomerAddress();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $customermodel->load(Yii::$app->request->post());
            $customermodel->user_id = $model->id;
            $customermodel->email = $model->email;
            $customermodel->status = 1;
            $customermodel->save();
            $customermodelAddress->load(Yii::$app->request->post());
            $customermodelAddress->customer_id = $customermodel->id;
            $customermodelAddress->save();
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'customermodel' => $customermodel,
                        'customermodelAddress' => $customermodelAddress,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $customermodel = $this->findCustomerModel($id);
        $customermodelAddress = $this->findAddressModel($customermodel->id);
        if(!$customermodelAddress){
            $customermodelAddress = new CustomerAddress();
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'customermodel' => $customermodel,
                        'customermodelAddress' => $customermodelAddress,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findCustomerModel($id) {
        if (($model = Customer::findOne(['user_id'=>$id])) !== null) {
            return $model;
        } else {
            return false;
        }
    }
    protected function findAddressModel($id) {
        if (($model = CustomerAddress::findOne(['customer_id'=>$id])) !== null) {
            return $model;
        } else {
            return false;
        }
    }

}
