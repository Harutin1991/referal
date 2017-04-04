<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_service}}".
 *
 * @property string $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property integer $service_id
 * @property integer $language_id
 */
class TrService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_service}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_description', 'description', 'service_id', 'language_id'], 'required'],
            [['description'], 'string'],
            [['service_id', 'language_id'], 'integer'],
            [['name', 'short_description'], 'string', 'max' => 255],
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
            'service_id' => Yii::t('app', 'Service ID'),
            'language_id' => Yii::t('app', 'Language ID'),
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
    public function getService() {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
