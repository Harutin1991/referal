<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%other_investor_diff}}".
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
            [['status', 'ordering'], 'required'],
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
}
