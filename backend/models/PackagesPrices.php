<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%packages_prices}}".
 *
 * @property string $id
 * @property integer $package_id
 * @property integer $price
 */
class PackagesPrices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%packages_prices}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package_id', 'price'], 'required'],
            [['package_id', 'price'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'package_id' => Yii::t('app', 'Package ID'),
            'price' => Yii::t('app', 'Price'),
        ];
    }
}
