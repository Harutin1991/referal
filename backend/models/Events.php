<?php

namespace backend\models;

use Yii;
use backend\models\Files;
use yii\helpers\ArrayHelper;
use yii\db\Query;
/**
 * This is the model class for table "{{%events}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $url
 * @property integer $status
 */
class Events extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%events}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'short_description', 'description', 'url', 'status'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['title', 'short_description', 'url'], 'string', 'max' => 255],
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
            'description' => Yii::t('app', 'Description'),
            'url' => Yii::t('app', 'Url'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($event_id) {
        $result = Files::find()->where(['category_id' => $event_id, 'category' => 'events', 'top' => 1, 'status' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }

    public static function find_One($url = ''){
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query->select(['tr_events.*','events.url']);
        $query->from('events');
        if($url != ''){
           $where = array_merge($where,['events.url'=>$url]);
        }
        $query->leftJoin('tr_events', 'events.id = tr_events.events_id');
        $query->leftJoin('language', 'language.id = tr_events.language_id');
        $query->where($where);
       // $query->offset(1);
        $query->orderBy(['events.id' => SORT_DESC]);
        $query->limit(1);
        $rows = $query->all();
        //$arrData = self::makeArray($rows);
        return $rows;
    }
    
    public static function findList(){
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language,'events.status'=>1];
        $query = (new Query());
        $query->select(['tr_events.*','events.url']);
        $query->from('events');
        
        $query->leftJoin('tr_events', 'events.id = tr_events.events_id');
        $query->leftJoin('language', 'language.id = tr_events.language_id');
        $query->where($where);
        $query->orderBy(['events.id' => SORT_DESC]);
        $rows = $query->all();
        return $rows;
    }
}
