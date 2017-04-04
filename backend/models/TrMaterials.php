<?php

namespace backend\models;

use Yii;
use common\models\Language;

/**
 * This is the model class for table "{{%tr_materials}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property integer $materials_id
 * @property integer $language_id
 */
class TrMaterials extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%tr_materials}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['materials_id', 'language_id'], 'integer'],
            [['name', 'short_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'materials_id' => Yii::t('app', 'Materials ID'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage() {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial() {
        return $this->hasOne(Materials::className(), ['id' => 'materials_id']);
    }

    public function updateDefaultTranslate() {
        $tr = TrMaterials::findOne(['language_id' => 1, 'product_id' => $this->id]);

        if (!$tr) {
            $tr = new TrMaterials();
            $tr->setAttribute('language_id', 1);
            $tr->setAttribute('materials_id', $this->id);
        }
        $tr->setAttribute('name', $this->name);
        $tr->setAttribute('short_description', $this->short_description);
        $tr->setAttribute('description', $this->description);
        $tr->save();

        return true;
    }

}
