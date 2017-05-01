<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use backend\models\Files;
use backend\models\TrCalculator;
use yii\db\Query;
/**
 * This is the model class for table "{{%calculator}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $created_date
 * @property string $updated_date
 * @property integer $status
 */
class Calculator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%calculator}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['description'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['status'], 'integer'],
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
            'title' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($calculator_id) {
        $result = Files::find()->where(['category_id' => $calculator_id, 'category' => 'calculator', 'top' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }

    public function updateDefaultTranslate($language_id) {
        $tr = TrCalculator::findOne(['language_id' => $language_id, 'calculator_id' => $this->id]);
        if (!$tr) {
            $tr = new TrCalculator();

            $tr->setAttribute('language_id', $language_id);
            $tr->setAttribute('calculator_id', $this->id);
        }
        $tr->setAttribute('title', $this->title);
        $tr->setAttribute('short_description', $this->short_description);

        $tr->save();
        return true;
    }
    
}
