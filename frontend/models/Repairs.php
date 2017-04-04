<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "repairs".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $part_id
 * @property integer $service_id
 *
 * @property Service $service
 */
class Repairs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repairs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id',  'service_id'], 'required'],
            [['product_id', 'part_id', 'service_id'], 'integer'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'part_id' => Yii::t('app', 'Product Part ID'),
            'service_id' => Yii::t('app', 'Service ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
