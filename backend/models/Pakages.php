<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%pakages}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property integer $price
 * @property integer $status
 * @property integer $created_date
 * @property integer $updated_date
 */
class Pakages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pakages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','price'], 'required'],
            [['description'], 'string'],
            [['price', 'status'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['short_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Package Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price From'),
            'status' => Yii::t('app', 'Status'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }
}
