<?php

namespace backend\models;

use Yii;
use common\models\Language;

/**
 * This is the model class for table "tr_faq".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property integer $faq_id
 * @property integer $language_id
 *
 * @property Language $language
 * @property Faq $faq
 */
class TrFaq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tr_faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_description', 'description'], 'required'],
            [['description'], 'string'],
            [['faq_id', 'language_id'], 'integer'],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['faq_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faq::className(), 'targetAttribute' => ['faq_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'faq_id' => Yii::t('app', 'Faq ID'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaq()
    {
        return $this->hasOne(Faq::className(), ['id' => 'faq_id']);
    }
}
