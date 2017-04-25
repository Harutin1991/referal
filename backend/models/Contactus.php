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
            [['description','title','short_description'], 'string'],
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
            'title' => Yii::t('app', 'Title'),
            'coordinate' => Yii::t('app', 'Coordinate'),
        ];
    }
	
	/**
     * @param $AllData
     * @return int
     */
    public function bachUpdate($AllData) {

        $updateQuery = "UPDATE `contactus` SET ";
        $subUpdateOrderingQuery = '`ordering` = CASE `id` ';
        foreach ($AllData as $item => $data) {
            $subUpdateOrderingQuery .= ' WHEN ' . $data['id'] . ' THEN ' . "'{$data['ordering']}'";
        }
        $updateQuery .= $subUpdateOrderingQuery . ' END';
        return self::getDb()->createCommand($updateQuery)->execute();
    }
}
