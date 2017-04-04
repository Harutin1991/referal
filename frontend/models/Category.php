<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_descritpion
 * @property string $description
 * @property integer $ordering
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Attribute[] $attributes
 * @property Product[] $products
 */
class Category extends \common\models\Category {

    /**
     * @inheritdoc
     */
    public static function findList($position = '', $parent = false) {
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query
                ->select(['category.id', 'tr_category.name', 'category.route_name'])
                ->from('category')
                ->leftJoin('tr_category', 'category.id = tr_category.category_id')
                ->leftJoin('language', 'language.id = tr_category.language_id');

        if ($position != '') {
            $where = array_merge($where, ['category.position' => $position]);
        }
        if ($parent) {
            $where = array_merge($where, ['category.parent_id' => null]);
        }
        $query->where($where);
        $rows = $query->orderBy(['category.ordering' => SORT_ASC])
                ->all();
        return $rows;
    }

    public static function getSubCategory($category_id) {
        $language = Yii::$app->language;
        $query = (new Query());
        $query
                ->select(['tr_category.*', 'category.route_name'])
                ->from('category')
                ->leftJoin('tr_category', 'category.id = tr_category.category_id')
                ->leftJoin('language', 'language.id = tr_category.language_id')
                ->where(['language.short_code' => $language, 'category.parent_id' => $category_id]);
        $rows = $query->orderBy(['category.ordering' => SORT_ASC])
                ->all();
        return $rows;
    }

    public static function getCategoryTree() {
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language, 'category.parent_id' => null];
        $query = (new Query());
        $query
                ->select(['category.id', 'category.parent_id', 'tr_category.name', 'category.route_name'])
                ->from('category')
                ->leftJoin('tr_category', 'category.id = tr_category.category_id')
                ->leftJoin('language', 'language.id = tr_category.language_id');
        $query->where($where);
        $categories = $query->orderBy(['category.ordering' => SORT_ASC])
                ->all();
        $menu = "<ul class='menu-fild'>";
        foreach ($categories as $category) {
            $current_id = $category['id'];
            //$menu[$category['id']] = ['parentName' => $category['name']];
            $sub = self::getSubCategory($current_id);
            if (!empty($sub)) {
                $menu .= "<li>";
                $menu .= '<i class="fa fa-angle-right" aria-hidden="true"></i>';
                $menu .= '<a href="javascript:void(0)">' . $category['name'] . '</a>';
                $menu .= '<ul class="sub-fild">';
                foreach ($sub as $cat) {
                    $menu .= '<li><a href="/product/'.$cat['route_name'].'">' . $cat['name'] . '</a></li>';
                    //$menu[$cat['parent_id']][] = $cat;
                }
                $menu .= "</ul></li>";
            } else {
                $menu .= "<li><a href='/product/".$category['route_name']."'>" . $category['name'] . "</a></li>";
            }
        }
        $menu .= "</ul>";
        return $menu;
    }

}
