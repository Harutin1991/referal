<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%package_messages}}".
 *
 * @property string $id
 * @property integer $package_id
 * @property string $message
 */
class PackageMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%package_messages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package_id', 'message'], 'required'],
            [['package_id'], 'integer'],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'package_id' => Yii::t('app', 'Package ID'),
            'message' => Yii::t('app', 'Message'),
        ];
    }
}
