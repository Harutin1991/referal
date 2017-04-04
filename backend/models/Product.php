<?php

namespace backend\models;

use Yii;
use backend\models\Brand;
use backend\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $ordering
 * @property integer $in_slider
 * @property integer $commercial
 * @property integer $popular
 * @property integer $best_seller
 *
 * @property ProductAttribute[] $productAttributes
 * @property ProductParts[] $productParts
 * @property TrProduct[] $trProducts
 */
class Product extends \yii\db\ActiveRecord {

    const UPLOAD_MAX_COUNT = 10;

    public static $Extensions = ['jpg', 'png'];
    public $imageFiles;
    public $productAttributes = array();

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'route_name'], 'required'],
            [['description', 'route_name'], 'string'],
            [['status', 'in_slider'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name', 'short_description', 'product_sku', 'route_name'], 'string', 'max' => 250],
            [['art_no'], 'string', 'max' => 255],
            [['route_name'], 'match', 'pattern' => "/^[^\-][a-z\-0-9]{0,}[^\-]$/"],
            [['route_name'], 'unique'],
            [['in_slider'], 'default', 'value' => 0],
            [['best_seller'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'status' => Yii::t('app', 'Status'),
            'art_no' => Yii::t('app', 'Art No'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'product_sku' => Yii::t('app', 'Product Sku'),
            'route_name' => Yii::t('app', 'Name In Route'),
            'in_slider' => Yii::t('app', 'Show In Slider'),
            'popular' => Yii::t('app', 'popular'),
            'commercial' => Yii::t('app', 'Commercial'),
            'best_seller' => Yii::t('app', 'Best Seller'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute($product_id) {
        $attributes_id = ProductAttribute::find()->where(['product_id' => $product_id])->asArray()->all();
        $attributesArray = ArrayHelper::map($attributes_id, 'attribute_id', 'value');

        $attributes = [];
        foreach ($attributesArray as $key => $attribute) {
            $attributes[] = array('id' => $key, 'name' => Attribute::find()->where(['id' => $key])->select('name')->one()->name, 'value' => $attribute);
        }
        return $attributes;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrProducts() {
        return $this->hasMany(Product::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages() {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id'])->where(['type' => 1]);
    }

    /**
     * list of categories
     * @return array
     */
    public function getAllCategories() {

        $Categories = Category::find()->where([])->all();
        return ArrayHelper::map($Categories, 'id', 'name');
    }

//
//    public function getAllBrands() {
//        $Brands = Brand::find()->all();
//        return ArrayHelper::map($Brands, 'id', 'name');
//    }

    public function getProductBrand($id) {
        $Brands = Brand::find()->where(['id' => $id])->asArray()->all();
        return ArrayHelper::map($Brands, 'id', 'name');
    }

    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($product_id) {
        $result = ProductImage::find()->where(['product_id' => $product_id, 'default_image_id' => 1, 'type' => 1])->asArray()->all();
//        var_dump(ArrayHelper::map($result,'default_image_id','name'));die;
        return ArrayHelper::map($result, 'default_image_id', 'name');
    }

    public function getImages($product_id) {
        $images = ProductImage::find()->where(['product_id' => $product_id, 'type' => 1])->asArray()->all();
        return ArrayHelper::map($images, 'id', 'name');
    }

    public function DeleteData($id) {
        $ProdImages = $this->getImages($id);
        foreach ($ProdImages as $item => $prodImage) {
            ProductImage::findOne($item)->delete();
            if (file_exists(Yii::$app->basePath . '/web/' . $prodImage)) {
                unlink(Yii::$app->basePath . '/web/' . $prodImage);
            }
        }
        $Parts = new ProductParts();
        $ProductParts = $Parts->getProductParts($id);
        $PartIds = ArrayHelper::map($ProductParts, 'id', 'id');
        foreach ($PartIds as $partId) {
            $PartImages = ArrayHelper::map($Parts::getImageByPartId($partId), 'id', 'name');
            foreach ($PartImages as $image => $partImage) {
                ProductImage::findOne($image)->delete();
                if (file_exists(Yii::$app->basePath . '/web/' . $partImage)) {
                    unlink(Yii::$app->basePath . '/web/' . $partImage);
                }
            }
            $Parts::findOne($partId)->delete();
        }
        $tr_products = TrProduct::findAll(['product_id' => $id]);
        $product_package = ProductPackage::findOne(['product_id' => $id])->delete();
        foreach ($tr_products as $trporudtc) {
            $trporudtc->delete();
        }
        return $this->delete();
    }

    public static function getImagesToFront($product_id, $class = '', $alt = '', $thumb = false) {
        $params = [
            'class' => 'img-responsive ' . $class,
            'alt' => $alt,
        ];

        $images = ProductImage::find()->where(['product_id' => $product_id, 'type' => 1, 'default_image_id' => 1])->asArray()->all();
        if ($thumb) {
            return Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/product/' . $product_id . '/thumbnail/' . $images[0]['name'], $params);
        } else {
            return Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/product/' . $product_id . '/' . $images[0]['name'], $params);
        }
    }

    public static function getImagesHTML($image_id, $class = '', $alt = '', $thumb = false, $product_id = '') {
        $params = [
            'class' => 'img-responsive ' . $class,
            'alt' => $alt,
        ];

        $images = ProductImage::find()->where(['id' => $image_id])->asArray()->all();
        if ($thumb) {
            return Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/product/' . $product_id . '/thumbnail/' . $images[0]['name'], $params);
        } else {
            return Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/product/' . $product_id . '/' . $images[0]['name'], $params);
        }
    }

    public function updateDefaultTranslate($language_id) {
        $tr = TrProduct::findOne(['language_id' => $language_id, 'product_id' => $this->id]);

        if (!$tr) {
            $tr = new TrProduct();
            $tr->setAttribute('language_id', $language_id);
            $tr->setAttribute('product_id', $this->id);
        }
        $tr->setAttribute('name', $this->name);
        $tr->setAttribute('short_description', $this->short_description);
        $tr->setAttribute('description', $this->description);
        $tr->save();

        return true;
    }

}
