<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product_parts".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $in_stock
 * @property integer $product_id
 *
 * @property Product $product
 */
class ProductParts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'product_id'], 'required'],
            [['description'], 'string'],
            [['price', 'in_stock', 'product_id'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'price' => Yii::t('app', 'Price'),
            'in_stock' => Yii::t('app', 'In Stock'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public static function findById($id)
    {
       $arrayPartData = self::find()->where(['id'=>$id,])->andWhere(['!=', 'in_stock', 0])->asArray()->all();
        return $arrayPartData;
    }
}
