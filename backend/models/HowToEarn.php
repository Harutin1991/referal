<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Files;
use backend\models\TrHowToEarn;
use yii\db\Query;

/**
 * This is the model class for table "{{%how_to_earn}}".
 *
 * @property string $id
 * @property string $short_description
 * @property integer $ordering
 * @property integer $status
 */
class HowToEarn extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%how_to_earn}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ordering'], 'required'],
            [['ordering', 'status'], 'integer'],
            [['short_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'short_description' => Yii::t('app', 'Short Description'),
            'ordering' => Yii::t('app', 'Ordering'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($earn_id) {
        $result = Files::find()->where(['category_id' => $earn_id, 'category' => 'how_to_earn', 'top' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }

    public function updateDefaultTranslate($language_id) {
        $tr = TrHowToEarn::findOne(['language_id' => $language_id, 'how_to_earn_id' => $this->id]);
        if (!$tr) {
            $tr = new TrHowToEarn();

            $tr->setAttribute('language_id', $language_id);
            $tr->setAttribute('how_to_earn_id', $this->id);
        }
        $tr->setAttribute('short_description', $this->short_description);

        $tr->save();
        return true;
    }
    
    public static function findList($blog_id = false,$limit = false) {

        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query->select(['tr_how_to_earn.*']);
        $query->from('how_to_earn');
        $query->leftJoin('tr_how_to_earn', 'how_to_earn.id = tr_how_to_earn.how_to_earn_id');
        $query->leftJoin('language', 'language.id = tr_how_to_earn.language_id');
        $query->where($where);
        $query->orderBy(['how_to_earn.ordering' => SORT_ASC]);
        $rows = $query->all();
        return $rows;
    }
    
    /**
     * @param $AllData
     * @return int
     */
    public function bachUpdate($AllData) {

        $updateQuery = "UPDATE `how_to_earn` SET ";
        $subUpdateOrderingQuery = '`ordering` = CASE `id` ';
        foreach ($AllData as $item => $data) {
            $subUpdateOrderingQuery .= ' WHEN ' . $data['id'] . ' THEN ' . "'{$data['ordering']}'";
        }
        $updateQuery .= $subUpdateOrderingQuery . ' END';
        return self::getDb()->createCommand($updateQuery)->execute();
    }

}
