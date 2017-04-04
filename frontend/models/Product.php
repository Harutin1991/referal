<?php

namespace frontend\models;

use common\models\Language;
use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use common\models\Favorites;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property integer $status
 * @property double $price
 * @property double $price_start
 * @property double $price_end
 * @property integer $category_id
 * @property string $created_date
 * @property string $updated_date
 * @property integer $brand_id
 * @property string $product_sku
 *
 * @property Brand $brand
 * @property Category $category
 * @property ProductAttribute[] $productAttributes
 * @property ProductParts[] $productParts
 */
class Product extends \common\models\Product {

    public static function findList($filters,$params = null) {

        $language = Yii::$app->language;
        $where = ['language.short_code' => $language, 'product_image.default_image_id' => '1'];
        $query = (new Query());
        $query->select(['product_image.name as image', 'product.id', 'tr_product.name as name', 'product.route_name', 'tr_product.short_description', 'tr_product.description','tr_product.product_id']);
        $query->from('product');
        if (!empty($filters) && !empty($filters['ids'])) {
            $where = array_merge($where, ['product.id' => $filters['ids']]);
        }
        if (!empty($filters) && !empty($filters['route_name'])) {
            $where = array_merge($where, ['product.route_name' => $filters['route_name']]);
        }
        if (!empty($filters) && !empty($filters['in_slider'])) {
            $where = array_merge($where, ['product.in_slider' => $filters['in_slider']]);
        }
        if (!empty($filters) && !empty($filters['best_seller'])) {
            $where = array_merge($where, ['product.best_seller' => $filters['best_seller']]);
        }

        $query->leftJoin('tr_product', 'product.id = tr_product.product_id');
        $query->leftJoin('product_image', 'product.id = product_image.product_id');
        $query->leftJoin('language', 'language.id = tr_product.language_id');
        $query->where($where);
        $query->orderBy(['product.ordering' => SORT_DESC]);
         if (isset($filters['limit'])) {
            $query->limit($filters['limit']);
        }
        $rows = $query->all();
        $arrData = self::makeArray($rows);
        return $arrData;
    }


    /**
     * @return array
     */
    public static function getShowInSliders() {
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language, 'product_image.default_image_id' => '1', 'product.in_slider' => 1];
        $query = (new Query());
        $query->select(['product_image.name as image', 'product.id', 'tr_product.name  as name', 'product.route_name', 'tr_product.short_description', 'tr_product.description']);
        $query->from('product');
        $query->leftJoin('tr_product', 'product.id = tr_product.product_id');
        $query->leftJoin('product_image', 'product.id = product_image.product_id');
        $query->leftJoin('language', 'language.id = tr_product.language_id');

        $query->where($where);
        $query->orderBy(['product.ordering' => SORT_ASC]);
        $rows = $query->all();

        return $rows;
    }

    public static function productsCount($filters) {
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language, 'product_image.default_image_id' => '1'];
        $query = (new Query());
        $query->select(['product.id']);
        $query->from('product');
        if (!empty($filters) && !empty($filters['id'])) {
            $where = array_merge($where, ['product.id' => $filters['id']]);
        }

        $query->leftJoin('tr_product', 'product.id = tr_product.product_id');
        $query->leftJoin('product_image', 'product.id = product_image.product_id');
        $query->leftJoin('language', 'language.id = tr_product.language_id');
        //$query->leftJoin('brand', 'brand.id = product.brand_id');
        //$query->innerJoin('product_package', 'product_package.product_id = product.id');
//        if (!empty($filters) && !empty($filters['categories'])) {
//            $query->leftJoin('category', 'category.id = product.category_id');
//            $where['category.route_name'] = $filters['categories'];
//        }
        $query->where($where);

        
        $query->orderBy(['product.ordering' => SORT_ASC]);
        $arrData = array();
        $rows = $query->all();
        //echo '<pre>';var_dump($rows);die;
        foreach ($rows as $key => $value) {
            if (!key_exists($value['id'], $arrData)) {
                $arrData[$value['id']] = $value;
            }
        }
        return count($arrData);
    }

    public static function getPrCountByCategory($filters){
            $ids = array();
            $query = (new Query());
            $query->select(['product.id']);
            $query->from('product');
            
            $query->where($where);
            $rows = $query->all();
            foreach($rows as $items){
                $ids[] = $items['id'];
            }

            return $ids;

    }

    public static function findBestSeller($filter){
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language, 'product_image.default_image_id' => '1'];
        $where = array_merge($where,$filter);
        $query = (new Query());
        $query->select(['product_image.name as image', 'product.id', 'tr_product.name', 'product.route_name', 'tr_product.short_description', 'tr_product.description']);
        $query->from('product');
        $query->leftJoin('tr_product', 'product.id = tr_product.product_id');
        $query->leftJoin('product_image', 'product.id = product_image.product_id');
        $query->leftJoin('language', 'language.id = tr_product.language_id');
        $query->where($where);
        $query->orderBy(['product.ordering' => SORT_ASC]);
        $rows = $query->all();
        $arrData = self::makeArray($rows);
        return $arrData;
    }



    public static function makeArray($rows){
$arrData = [];
        foreach($rows as $row){
                $arrData[] = array(
                    'name'=>$row['name'],
                    'image'=>$row['image'],
                    'id'=>$row['id'],
                    'product_id'=>$row['product_id'],
                    'route_name'=>$row['route_name'],
                    'short_description'=>$row['short_description'],
                    'description'=>$row['description'],

                );
        }

        return $arrData;
    }

    public static function getFavoritesByUser($user_id)
    {
        $favorite_product_ids = Favorites::find()->select(['product_id'])->where(['user_id' => $user_id])->asArray()->all();
        $favorite_product_ids = ArrayHelper::map($favorite_product_ids, 'product_id', 'product_id');
        $Products = array();
        if(!empty($favorite_product_ids)){
            $Products = self::findList(['ids' => $favorite_product_ids]);
        }
        return $Products;
    }
}
