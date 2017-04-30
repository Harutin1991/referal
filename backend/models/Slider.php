<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Files;

/**
 * This is the model class for table "{{%slider}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $link
 * @property integer $status
 */
class Slider extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%slider}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status'], 'integer'],
            [['title', 'short_description', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'link' => Yii::t('app', 'Link'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($material_id) {
        $result = Files::find()->where(['category_id' => $material_id, 'category' => 'slider', 'top' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }

}
