<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%product_category}}".
 *
 * @property string $id
 * @property integer $category_id
 * @property integer $product_id
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'product_id'], 'required'],
            [['category_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }
}
