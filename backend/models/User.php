<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property integer $role
 * @property string $bio
 * @property string $gender
 * @property string $dob
 * @property string $pic
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string $mobile_phone
 * @property string $postal
 * @property integer $starting_amount
 * @property string $purse
 * @property string $referal_link
 * @property string $invitation_users_count
 * @property string $auth_key
 * @property string $remember_token
 * @property string $password_token
 * @property string $api_key
 * @property string $social_type
 * @property string $social_id
 * @property string $social_user_name
 * @property integer $status
 * @property integer $activity_status
 * @property string $referal_link_created
 * @property string $deleted_at
 * @property string $created
 * @property string $updated
 */
class User extends \yii\db\ActiveRecord {

    const ADMIN = 0;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'first_name', 'last_name', 'email', 'password', 'phone', 'mobile_phone', 'starting_amount', 'purse', 'referal_link', 'invitation_users_count', 'auth_key', 'social_user_name', 'status', 'activity_status'], 'required'],
            [['role', 'starting_amount', 'purse', 'invitation_users_count', 'status', 'activity_status'], 'integer'],
            [['bio'], 'string'],
            [['dob', 'referal_link_created', 'deleted_at', 'created', 'updated'], 'safe'],
            [['username', 'first_name', 'last_name', 'email', 'gender', 'pic', 'country', 'state', 'city', 'address', 'postal', 'referal_link', 'password_token', 'api_key', 'social_type', 'social_id', 'social_user_name'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 60],
            [['phone', 'mobile_phone'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['remember_token'], 'string', 'max' => 100],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
            'bio' => Yii::t('app', 'Bio'),
            'gender' => Yii::t('app', 'Gender'),
            'dob' => Yii::t('app', 'Dob'),
            'pic' => Yii::t('app', 'Pic'),
            'country' => Yii::t('app', 'Country'),
            'state' => Yii::t('app', 'State'),
            'city' => Yii::t('app', 'City'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'mobile_phone' => Yii::t('app', 'Mobile Phone'),
            'postal' => Yii::t('app', 'Postal'),
            'starting_amount' => Yii::t('app', 'Starting Amount'),
            'purse' => Yii::t('app', 'Purse'),
            'referal_link' => Yii::t('app', 'Referal Link'),
            'invitation_users_count' => Yii::t('app', 'Invitation Users Count'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'remember_token' => Yii::t('app', 'Remember Token'),
            'password_token' => Yii::t('app', 'Password Token'),
            'api_key' => Yii::t('app', 'Api Key'),
            'social_type' => Yii::t('app', 'Social Type'),
            'social_id' => Yii::t('app', 'Social ID'),
            'social_user_name' => Yii::t('app', 'Social User Name'),
            'status' => Yii::t('app', 'Status'),
            'activity_status' => Yii::t('app', 'Activity Status'),
            'referal_link_created' => Yii::t('app', 'Referal Link Created'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

}
