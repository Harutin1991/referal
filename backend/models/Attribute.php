<?php

namespace backend\models;

use Yii;
use backend\models\TrAttribute;
use common\components\RuleHelper;

/**
 * This is the model class for table "attribute".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $created_date
 * @property string $updated_date
 * @property integer $category_id
 *
 * @property Category $category
 * @property ProductAttribute[] $productAttributes
 * @property TrAttribute[] $trAttributes
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'category_id','ordering'], 'integer'],
            [['name'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'ordering' => Yii::t('app', 'Ordering'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
            'category_id' => Yii::t('app', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(ProductAttribute::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrAttributes()
    {
        return $this->hasMany(TrAttribute::className(), ['attribute_id' => 'id']);
    }
    public function updateDefaultTranslate($language_id){
        $tr = TrAttribute::findOne(['language_id' => $language_id,'attribute_id'=>$this->id]);
        if(!$tr){
            $tr = new TrAttribute();
            $tr->setAttribute('language_id',$language_id);
            $tr->setAttribute('attribute_id',$this->id);
        }
        $tr->setAttribute('name',$this->name);
        $tr->save();

        return true;
    }



}
