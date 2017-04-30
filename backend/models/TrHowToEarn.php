<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_how_to_earn}}".
 *
 * @property string $id
 * @property string $short_description
 * @property integer $how_to_earn_id
 * @property integer $language_id
 */
class TrHowToEarn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_how_to_earn}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['how_to_earn_id', 'language_id'], 'required'],
            [['how_to_earn_id', 'language_id'], 'integer'],
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
            'how_to_earn_id' => Yii::t('app', 'How To Earn ID'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }

}
