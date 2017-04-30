<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_pakages}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property integer $pakage_id
 * @property integer $language_id
 */
class TrPakages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_pakages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'pakage_id', 'language_id'], 'required'],
            [['description'], 'string'],
            [['pakage_id', 'language_id'], 'integer'],
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
            'pakage_id' => Yii::t('app', 'Pakage ID'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }
}
