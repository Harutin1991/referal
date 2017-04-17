<?php

namespace backend\models;

use Yii;
use backend\models\TrFaq;
/**
 * This is the model class for table "faq".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property integer $ordering
 * @property integer $status
 * @property integer $yes_count
 * @property integer $no_count
 *
 * @property TrFaq[] $trFaqs
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','description'], 'required'],
            [['short_description', 'description'], 'string'],
            [['ordering', 'status', 'yes_count', 'no_count'], 'integer'],
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
            'title' => Yii::t('app', 'Question'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Answer'),
            'ordering' => Yii::t('app', 'Ordering'),
            'status' => Yii::t('app', 'Status'),
            'yes_count' => Yii::t('app', 'Yes Count'),
            'no_count' => Yii::t('app', 'No Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrFaqs()
    {
        return $this->hasMany(TrFaq::className(), ['faq_id' => 'id']);
    }

    public function updateDefaultTranslate(){
        $tr = TrFaq::findOne(['language_id' => 1,'faq_id'=>$this->id]);
        if(!$tr){
            $tr = new TrFaq();
            $tr->setAttribute('language_id',1);
            $tr->setAttribute('faq_id',$this->id);
        }
            $tr->setAttribute('name',$this->title);
            $tr->setAttribute('short_description',$this->short_description);
            $tr->setAttribute('description',$this->description);
            $tr->save();

        return true;
    }
}
