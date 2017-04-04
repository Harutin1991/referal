<?php

namespace backend\models;

use Yii;
use backend\models\Attribute;
/**
 * This is the model class for table "{{%tr_product_attribute}}".
 *
 * @property string $id
 * @property string $value
 * @property integer $language_id
 * @property integer $attribute_id
 */
class TrProductAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_product_attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'language_id', 'attribute_id'], 'required'],
            [['language_id', 'attribute_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
            'language_id' => Yii::t('app', 'Language ID'),
            'attribute_id' => Yii::t('app', 'Attribute ID'),
        ];
    }
    
    public static function findByCategory($category_id){
        $attributes = Attribute::find()->where(['category_id'=>$category_id])->select('id')->asArray()->all();
        $language = \common\models\Language::find()->where(['short_code' => Yii::$app->language])->asArray()->one();
        $tr_attr = [];
        foreach($attributes as $attr){
            $tr_attr[] = self::find()->where(['attribute_id'=>$attr['id'],'language_id'=>$language['id']])->asArray()->all();
        }
        return $tr_attr;
    }
    
    /**
     * @inheritdoc
     */
    public static function findList() {
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query
                ->select(['attribute.id', 'tr_attribute.*','product_attribute.value'])
                ->from('attribute')
                ->leftJoin('tr_attribute', 'attribute.id = tr_attribute.attribute_id')
                ->leftJoin('product_attribute', 'attribute.id = product_attribute.attribute_id')
                ->leftJoin('language', 'language.id = tr_attribute.language_id');
        $query->where($where);
        $rows = $query->orderBy(['attribute.ordering' => SORT_ASC])
                ->all();
        return $rows;
    }
}
