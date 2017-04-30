<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%user_images}}".
 *
 * @property integer $id
 * @property string $path
 * @property integer $user_id
 */
class UserImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_images}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path' => Yii::t('app', 'Path'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
}
