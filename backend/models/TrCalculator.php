<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_calculator}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property integer $calculator_id
 * @property integer $language_id
 */
class TrCalculator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_calculator}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['calculator_id', 'language_id'], 'required'],
            [['calculator_id', 'language_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'calculator_id' => Yii::t('app', 'Calculator ID'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }
}
