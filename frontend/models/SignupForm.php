<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use Yii;
use common\components\Location;

/**
 * Signup form
 */
class SignupForm extends Model
{
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
    public $gender;
    public $dob;
    public $confirm_password;
    public $verifyToken;


    /**
     * @inheritdoc
     */
    public function rules()
    {
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
            ['email', 'required','message' => Yii::t('app','Login field required')],
            ['email', 'email'],
            ['email', 'string', 'max' => 50],
            ['email', 'unique', 'targetClass' => '\frontend\models\Customer', 'message' => 'This email address has already been taken.'],

            ['password', 'required','message' => Yii::t('app','Password field required')],
            ['password', 'string', 'min' => 6],

            ['confirm_password', 'required'],
            ['confirm_password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password'],
            
            ['address', 'trim'],
            ['state', 'trim'],
            ['city', 'trim'],
            ['country', 'trim'],
            ['phone', 'trim'],
            ['dob', 'trim'],
            ['postal', 'trim'],
            ['gender', 'trim'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $customer = new Customer();
        $customerAddress = new CustomerAddress();
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->role = 20;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($user->save()){
            $customer->first_name = $this->first_name;
            $customer->last_name = $this->last_name;
            $customer->email = $this->email;
            $customer->gender = $this->gender;
            $customer->dob = $this->dob;
            $customer->user_id = $user->id;
            $customer->last_ip = \Yii::$app->request->userIP;
            $customer->save(false);
            $customerAddress->city = $this->city;
            $customerAddress->customer_id = $customer->id;
            $customerAddress->address = $this->address;
            $customerAddress->country = $this->country;
            $customerAddress->postal = $this->postal;
            $customerAddress->default_address = 1;
            $customerAddress->save(false);
            return $user ;
        }
        return null;
    }
    
    public function getNewUser() {
        $user = new User();
        $user->username = $this->username;
        $user->role = 20;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($user->save()){
            return $user;
        }
    }
}
