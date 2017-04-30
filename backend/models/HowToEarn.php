<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Files;
use backend\models\TrHowToEarn;
use yii\db\Query;

/**
 * This is the model class for table "{{%how_to_earn}}".
 *
 * @property string $id
 * @property string $short_description
 * @property integer $ordering
 * @property integer $status
 */
class HowToEarn extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%how_to_earn}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ordering'], 'required'],
            [['ordering', 'status'], 'integer'],
            [['short_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'short_description' => Yii::t('app', 'Short Description'),
            'ordering' => Yii::t('app', 'Ordering'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($earn_id) {
        $result = Files::find()->where(['category_id' => $earn_id, 'category' => 'how_to_earn', 'top' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }

    public function updateDefaultTranslate($language_id) {
        $tr = TrHowToEarn::findOne(['language_id' => $language_id, 'how_to_earn_id' => $this->id]);
        if (!$tr) {
            $tr = new TrBlog();

            $tr->setAttribute('language_id', $language_id);
            $tr->setAttribute('how_to_earn_id', $this->id);
        }
        $tr->setAttribute('short_description', $this->short_description);

        $tr->save();
        return true;
    }

}
