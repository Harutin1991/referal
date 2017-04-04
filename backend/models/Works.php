<?php

namespace backend\models;

use Yii;
use yii\db\Query;
/**
 * This is the model class for table "{{%works}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $url
 * @property integer $status
 */
class Works extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%works}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','status'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['name', 'short_description', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'url' => Yii::t('app', 'Url'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    
    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($material_id) {
        $result = Files::find()->where(['category_id' => $material_id,'category'=>'work', 'top' => 1, 'status' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }
    
    public static function find_One($url = ''){
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query->select(['tr_works.*','works.url']);
        $query->from('works');
        if($url != ''){
            $where = array_merge($where,['works.url' => $url]);
        }
        $query->leftJoin('tr_works', 'works.id = tr_works.works_id');
        $query->leftJoin('language', 'language.id = tr_works.language_id');
        $query->where($where);
       // $query->offset(1);
        $query->orderBy(['works.id' => SORT_DESC]);
        $query->limit(8);
        $rows = $query->all();
        //$arrData = self::makeArray($rows);
        return $rows;
    }
}
