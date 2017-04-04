<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Files;

/**
 * This is the model class for table "{{%materials}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $url
 */
class Materials extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%materials}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['name', 'short_description', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'url' => Yii::t('app', 'Url'),
        ];
    }

    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($material_id) {
        $result = Files::find()->where(['category_id' => $material_id, 'category' => 'materials', 'top' => 1, 'status' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }

    public function updateDefaultTranslate() {
        $tr = TrMaterials::findOne(['language_id' => 1, 'materials_id' => $this->id]);
        if (!$tr) {
            $tr = new TrMaterials();
            $tr->setAttribute('language_id', 1);
            $tr->setAttribute('materials_id', $this->id);
        }
        $tr->setAttribute('name', $this->name);
        $tr->save();

        return true;
    }

}
