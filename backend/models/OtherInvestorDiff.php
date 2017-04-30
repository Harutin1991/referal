<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Files;
use backend\models\TrOtherInvestorDiff;
use yii\db\Query;
/**
 * This is the model class for table "other_investor_diff".
 *
 * @property string $id
 * @property string $title
 * @property string $icon
 * @property integer $status
 * @property integer $ordering
 */
class OtherInvestorDiff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%other_investor_diff}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'ordering'], 'integer'],
            [['title', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'icon' => Yii::t('app', 'Icon'),
            'status' => Yii::t('app', 'Status'),
            'ordering' => Yii::t('app', 'Ordering'),
        ];
    }
    
    /**
     * @param $AllData
     * @return int
     */
    public function bachUpdate($AllData) {

        $updateQuery = "UPDATE `other_investor_diff` SET ";
        $subUpdateOrderingQuery = '`ordering` = CASE `id` ';
        foreach ($AllData as $item => $data) {
            $subUpdateOrderingQuery .= ' WHEN ' . $data['id'] . ' THEN ' . "'{$data['ordering']}'";
        }
        $updateQuery .= $subUpdateOrderingQuery . ' END';
        return self::getDb()->createCommand($updateQuery)->execute();
    }
    
    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($diff_id) {
        $result = Files::find()->where(['category_id' => $diff_id, 'category' => 'other_investor_diff', 'top' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }
    
    public function updateDefaultTranslate($language_id) {
        $tr = TrOtherInvestorDiff::findOne(['language_id' => $language_id, 'other_investor_diff_id' => $this->id]);
        if (!$tr) {
            $tr = new TrOtherInvestorDiff();

            $tr->setAttribute('language_id', $language_id);
            $tr->setAttribute('other_investor_diff_id', $this->id);
        }
        $tr->setAttribute('title', $this->title);

        $tr->save();
        return true;
    }
}
