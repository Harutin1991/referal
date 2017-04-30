<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user_avatars}}".
 *
 * @property string $id
 * @property string $path
 */
class UserAvatars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_avatars}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
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
        ];
    }
}
