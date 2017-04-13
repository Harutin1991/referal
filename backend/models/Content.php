<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property string $id
 * @property string $slider
 * @property string $how_to_earn
 * @property string $investor_pakage
 * @property string $other_investor_diff
 * @property string $most_active_users
 * @property string $calculator
 * @property string $articles
 * @property string $content_type
 * @property integer $ordering
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_type', 'ordering'], 'required'],
            [['ordering'], 'integer'],
            [['slider'], 'string', 'max' => 50],
            [['how_to_earn', 'investor_pakage', 'other_investor_diff', 'most_active_users', 'calculator', 'articles', 'content_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slider' => Yii::t('app', 'Slider'),
            'how_to_earn' => Yii::t('app', 'How To Earn'),
            'investor_pakage' => Yii::t('app', 'Investor Pakage'),
            'other_investor_diff' => Yii::t('app', 'Other Investor Diff'),
            'most_active_users' => Yii::t('app', 'Most Active Users'),
            'calculator' => Yii::t('app', 'Calculator'),
            'articles' => Yii::t('app', 'Articles'),
            'content_type' => Yii::t('app', 'Content Type'),
            'ordering' => Yii::t('app', 'Ordering'),
        ];
    }
}
