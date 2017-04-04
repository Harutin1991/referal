<?php

namespace backend\models;

use Yii;
use common\models\Language;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property integer $ordering
 *
 * @property Product[] $products
 */
class TrBrand extends \yii\db\ActiveRecord {

   /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description'], 'required'],
            [['description'], 'string'],
            [['language_id', 'brand_id'], 'integer'],
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
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'language_id' => Yii::t('app', 'Language ID'),
            'brand_id' => Yii::t('app', 'Brand ID'),
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
    public function getBrand() {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }

}
