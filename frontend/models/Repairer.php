<?php

namespace frontend\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "repairer".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property integer $user_id
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $address
 * @property string $zip
 * @property string $long
 * @property string $lat
 * @property double $percent
 * @property integer $status
 * @property string $created_date
 * @property string $updated_date
 * @property string $work_status
 *
 * @property Order[] $orders
 * @property User $user
 * @property RepairerInfo[] $repairerInfos
 */
class Repairer extends \backend\models\Repairer
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repairer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'phone', 'user_id', 'created_date', 'updated_date'], 'required'],
            [['user_id', 'status', 'work_status'], 'integer'],
            [['percent', 'long', 'lat'], 'number'],
            [['created_date', 'updated_date'], 'safe'],
            [['name', 'surname', 'email', 'phone', 'country', 'city', 'state', 'address', ], 'string', 'max' => 50],
            [['zip'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'user_id' => Yii::t('app', 'User ID'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
            'address' => Yii::t('app', 'Address'),
            'zip' => Yii::t('app', 'Zip'),
            'long' => Yii::t('app', 'Long'),
            'lat' => Yii::t('app', 'Lat'),
            'percent' => Yii::t('app', 'Percent'),
            'status' => Yii::t('app', 'Status'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['repairer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairerInfos()
    {
        return $this->hasMany(RepairerInfo::className(), ['repairer_id' => 'id']);
    }
}
