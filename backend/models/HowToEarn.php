<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%how_to_earn}}".
 *
 * @property string $id
 * @property string $short_description
 * @property integer $ordering
 * @property integer $status
 */
class HowToEarn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%how_to_earn}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ordering', 'status'], 'required'],
            [['ordering', 'status'], 'integer'],
            [['short_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'short_description' => Yii::t('app', 'Short Description'),
            'ordering' => Yii::t('app', 'Ordering'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
