<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%packages}}".
 *
 * @property string $id
 * @property string $title
 * @property integer $status
 * @property integer $created_date
 * @property integer $updated_date
 * @property integer $ordering
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%packages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status', 'created_date', 'updated_date'], 'required'],
            [['status', 'created_date', 'updated_date', 'ordering'], 'integer'],
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
            'status' => Yii::t('app', 'Status'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'ordering' => Yii::t('app', 'Ordering'),
        ];
    }
    /**
     * @param $AllData
     * @return int
     */
    public function bachUpdate($AllData) {

        $updateQuery = "UPDATE `packages` SET ";
        $subUpdateOrderingQuery = '`ordering` = CASE `id` ';
        foreach ($AllData as $item => $data) {
            $subUpdateOrderingQuery .= ' WHEN ' . $data['id'] . ' THEN ' . "'{$data['ordering']}'";
        }
        $updateQuery .= $subUpdateOrderingQuery . ' END';
        return self::getDb()->createCommand($updateQuery)->execute();
    }
}
