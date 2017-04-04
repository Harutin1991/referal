<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%contactus}}".
 *
 * @property string $id
 * @property string $phone
 * @property string $mobile_phone
 * @property string $fax
 * @property string $email
 * @property string $coordinate
 */
class Contactus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contactus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'mobile_phone', 'fax', 'email', 'coordinate'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'mobile_phone' => Yii::t('app', 'Mobile Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'coordinate' => Yii::t('app', 'Coordinate'),
        ];
    }
}
