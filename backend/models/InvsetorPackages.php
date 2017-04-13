<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%invsetor_packages}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property double $price
 * @property string $create_date
 * @property string $update_date
 * @property integer $default_package
 */
class InvsetorPackages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invsetor_packages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['create_date', 'update_date'], 'safe'],
            [['default_package'], 'integer'],
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
            'price' => Yii::t('app', 'Price'),
            'create_date' => Yii::t('app', 'Create Date'),
            'update_date' => Yii::t('app', 'Update Date'),
            'default_package' => Yii::t('app', 'Default Package'),
        ];
    }
}
