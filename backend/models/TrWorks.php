<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Language;

/**
 * This is the model class for table "{{%tr_works}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property string $route_name
 * @property integer $works_id
 * @property integer $language_id
 */
class TrWorks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_works}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description'], 'required'],
            [['works_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['works_id'], 'exist', 'skipOnError' => true, 'targetClass' => Works::className(), 'targetAttribute' => ['works_id' => 'id']],
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
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'works_id' => Yii::t('app', 'Works ID'),
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
    public function getWork()
    {
        return $this->hasOne(Works::className(), ['id' => 'works_id']);
    }
}
