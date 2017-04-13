<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%calculator_profit}}".
 *
 * @property string $id
 * @property string $background
 * @property string $description
 */
class CalculatorProfit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%calculator_profit}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['background'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'background' => Yii::t('app', 'Background'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
