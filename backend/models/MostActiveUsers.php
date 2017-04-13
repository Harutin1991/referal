<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%most_active_users}}".
 *
 * @property string $id
 * @property integer $user_id
 */
class MostActiveUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%most_active_users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
}
