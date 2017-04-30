<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_slider}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property integer $slider_id
 * @property integer $language_id
 */
class TrSlider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_slider}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slider_id', 'language_id'], 'required'],
            [['slider_id', 'language_id'], 'integer'],
            [['title', 'short_description'], 'string', 'max' => 255],
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
            'slider_id' => Yii::t('app', 'Slider ID'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }
}
