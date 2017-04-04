<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Product as BackProduct;

class Brand extends \common\models\Brand
{
    /**
     * @inheritdoc
     */
    public static function findList(){
        $language = Yii::$app->language;
        $rows = (new \yii\db\Query())
            ->select(['brand.id', 'brand.name'])
            ->from('brand')
            ->leftJoin('tr_brand','brand.id = tr_brand.brand_id')
            ->leftJoin('language','language.id = tr_brand.language_id')
            ->where(['language.short_code' => $language])
            ->orderBy(['brand.ordering'=>SORT_ASC])
            ->all();
        return $rows;
    }
    
    public static function getProductCountByBrand($brand_id){
        return BackProduct::find()->where(['brand_id'=>$brand_id])->count();
    }
    
}