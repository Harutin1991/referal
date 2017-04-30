<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%referal_links}}".
 *
 * @property string $id
 * @property string $referal_link
 * @property integer $user_id
 * @property string $created_date
 * @property string $expiration_date
 * @property integer $status
 */
class ReferalLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%referal_links}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['created_date', 'expiration_date'], 'safe'],
            [['referal_link'], 'unique'],
            [['referal_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'referal_link' => Yii::t('app', 'Referal Link'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_date' => Yii::t('app', 'Created Date'),
            'expiration_date' => Yii::t('app', 'Expiration Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
