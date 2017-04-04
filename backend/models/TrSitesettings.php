<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_sitesettings}}".
 *
 * @property string $id
 * @property string $logoText
 * @property integer $language_id
 * @property integer $settings_id
 */
class TrSitesettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_sitesettings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logoText', 'language_id', 'settings_id'], 'required'],
            [['language_id', 'settings_id'], 'integer'],
            [['logoText'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'logoText' => Yii::t('app', 'Logo Text'),
            'language_id' => Yii::t('app', 'Language ID'),
            'settings_id' => Yii::t('app', 'Settings ID'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage() {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetting() {
        return $this->hasOne(Sitesettings::className(), ['id' => 'settings_id']);
    }
}
