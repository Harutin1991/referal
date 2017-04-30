<?php

namespace frontend\controllers;

use common\models\Countries;
use common\models\Favorites;
use common\models\Product;
use frontend\models\CustomerAddress;
use common\models\User;
use frontend\models\EditPassword;
use Yii;
use frontend\models\Order;
use frontend\models\OrderSearch;
use yii\filters\VerbFilter;
use frontend\models\Customer;
use yii\helpers\ArrayHelper;

class UserController extends \yii\web\Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update-item' => ['POST'],
                    'delete' => ['POST'],
                    'edite-address' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['history', 'profile', 'edit-password', 'update-item'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionProfile() {
        $role = Yii::$app->user->identity->role;
        $view_file_path = '';
        $userModel = null;
        if ($role == User::CUSTOMER) {
            $userModel = Yii::$app->user->identity->customer;
            $view_file_path = 'customer/profile';
        }
        $customerAdressObj = CustomerAddress::findOne(['customer_id' => $userModel->id, 'default_address' => 1]);
        if ($customerAdressObj) {
            $modelAdd = $customerAdressObj;
            $countries = Countries::find()->select(['id', 'name'])->asArray()->all();
            $countries = ArrayHelper::map($countries, 'name', 'name');
            $addresForm = $this->renderPartial('customer/update', array(
                'model' => $modelAdd,
                'countries' => $countries,
            ));
        } else {
            $modelAdd = new CustomerAddress();
            $countries = Countries::find()->select(['id', 'name'])->where(['status' => 1])->asArray()->all();
            $countries = ArrayHelper::map($countries, 'name', 'name');
            $addresForm = $this->renderPartial('customer/create', array(
                'model' => $modelAdd,
                'countries' => $countries,
            ));
        }

        if (Yii::$app->request->post()) {
            $postArr = Yii::$app->request->post();
            $postArr['CustomerAddress']['customer_id'] = $userModel->id;
            $postArr['CustomerAddress']['default_address'] = 1;
            if ($modelAdd->load($postArr) && $modelAdd->save()) {
                return $this->redirect(['user/profile']);
            } else {
                return $this->render($view_file_path, [
                            'UserModel' => $userModel,
                            'addressForm' => $addresForm
                ]);
            }
        }
        $user_id = Yii::$app->user->identity->id;
        $favorites = \frontend\models\Product::getFavoritesByUser($user_id);
        $referalLink = \frontend\models\ReferalLinks::find()->where(['user_id'=>$user_id])->select('referal_link')->one();
        return $this->render($view_file_path, [
                    'UserModel' => $userModel,
                    'addressForm' => $addresForm,
                    'referalLink' => $referalLink,
                    'favorites' => $favorites
        ]);
    }

    public function actionHistory() {
        $this->layout = 'profile';
        $role = Yii::$app->user->identity->role;
        $view_file_path = '';
        if ($role == User::CUSTOMER) {
            $user_id = Yii::$app->user->identity->customer->id;
            $view_file_path = 'customer/history';
        } elseif ($role == User::REPAIRER) {
            $user_id = Yii::$app->user->identity->repairer->id;
            $view_file_path = 'repairer/history';
        }
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $user_id, $role);

        return $this->render($view_file_path, [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionEditPassword() {
        $this->layout = 'profile';
        $model = new EditPassword();
        $model->username = Yii::$app->user->identity->username;
        if ($model->load(Yii::$app->request->post()) && $model->edit()) {
            Yii::$app->session->setFlash('success', 'Your password successfuly updated!');
            return $this->redirect('/user/profile');
        }

        return $this->render('edit-password', [
                    'model' => $model,
        ]);
    }

    public function actionProfileImage() {
        $this->layout = 'profile';
        return $this->render('profile-image');
    }

    public function actionUpdateItem() {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $user = User::findOne(Yii::$app->user->identity->id);
            $customer = Customer::findOne(Yii::$app->user->identity->customer->id);
            $customerAddress = CustomerAddress::findOne(['customer_id' => Yii::$app->user->identity->customer->id]);
            if (isset($customer->$post['name']) || is_null($customer->$post['name'])) {
                echo "Asdas";die;
                $customer->$post['name'] = $post['value'];
                $customer->save();
                return json_encode(['success' => true]);
            } elseif (isset($customerAddress->$post['name'])) {
                $customerAddress->$post['name'] = $post['value'];
                $customerAddress->customer_id = Yii::$app->user->identity->customer->id;
                $customerAddress->save();
                return json_encode(['success' => true]);
            } elseif (isset($user->$post['name'])) {
                if ($user->editUser($post)) {
                    return json_encode(['success' => true]);
                } else {
                    return json_encode(['success' => false]);
                }
            } else {
                return json_encode(['success' => false]);
            }
        }
    }

}
