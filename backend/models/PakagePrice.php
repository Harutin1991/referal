<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%pakage_price}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $created_date
 * @property string $updated_date
 * @property string $route_name
 * @property integer $status
 */
class PakagePrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pakage_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'short_description', 'description', 'route_name', 'status'], 'required'],
            [['description'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['status'], 'integer'],
            [['title', 'route_name'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'route_name' => Yii::t('app', 'Route Name'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
