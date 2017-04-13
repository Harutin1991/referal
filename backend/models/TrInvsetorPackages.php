<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_invsetor_packages}}".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $invsetor_packages_id
 * @property integer $language_id
 */
class TrInvsetorPackages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_invsetor_packages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'invsetor_packages_id', 'language_id'], 'required'],
            [['description'], 'string'],
            [['invsetor_packages_id', 'language_id'], 'integer'],
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
            'description' => Yii::t('app', 'Description'),
            'invsetor_packages_id' => Yii::t('app', 'Invsetor Packages ID'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }
}
