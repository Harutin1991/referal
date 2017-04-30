<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_other_investor_diff}}".
 *
 * @property string $id
 * @property string $title
 * @property integer $other_investor_diff_id
 * @property integer $language_id
 */
class TrOtherInvestorDiff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_other_investor_diff}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['other_investor_diff_id', 'language_id'], 'required'],
            [['other_investor_diff_id', 'language_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'other_investor_diff_id' => Yii::t('app', 'Other Investor Diff ID'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }
}
