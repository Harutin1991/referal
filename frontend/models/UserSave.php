<?php

namespace frontend\models;

use yii\base\Model;
use Yii;
use common\models\User;
/**
 * Signup form
 */
class UserSave extends Model {

    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $address;
    public $state;
    public $city;
    public $country;
    public $phone;
    public $postal;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 50],
            ['first_name', 'trim'],
            ['first_name', 'required'],
            ['first_name', 'string', 'min' => 2, 'max' => 50],
            ['last_name', 'trim'],
            ['last_name', 'required'],
            ['last_name', 'string', 'min' => 2, 'max' => 50],
            ['email', 'trim'],
            ['email', 'required', 'message' => Yii::t('app', 'Login field required')],
            ['email', 'email'],
            ['email', 'string', 'max' => 50],
            ['email', 'unique', 'targetClass' => '\frontend\models\Customer', 'message' => 'This email address has already been taken.'],
            ['password', 'required', 'message' => Yii::t('app', 'Password field required')],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'required'],
            ['confirm_password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            ['address', 'trim'],
            ['state', 'trim'],
            ['city', 'trim'],
            ['country', 'trim'],
            ['phone', 'trim']
        ];
    }
    
    public function updateUserData(){
        if (!$this->validate()) {
            return null;
        }
        
        $customer = Customer::findOne(Yii::$app->user->identity->customer->id);
        $customer->first_name = !is_null($this->first_name)?$this->first_name:$customer->first_name;
    }
}

?>