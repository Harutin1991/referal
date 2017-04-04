<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Files;
use yii\db\Query;

/**
 * This is the model class for table "{{%partners}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 */
class Partners extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%partners}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title'], 'required'],
            [['status'], 'integer'],
            [['title', 'short_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($partners_id) {
        $result = Files::find()->where(['category_id' => $partners_id, 'category' => 'partners', 'top' => 1, 'status' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }
    
    public static function findList() {

        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query->select(['tr_partners.*']);
        $query->from('partners');
        $query->leftJoin('tr_partners', 'partners.id = tr_partners.partners_id');
        $query->leftJoin('language', 'language.id = tr_partners.language_id');
        $query->where($where);
        $query->orderBy(['partners.id' => SORT_ASC]);
        $rows = $query->all();
        return $rows;
    }

}
