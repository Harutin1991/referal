<?php

namespace backend\models;

use Yii;
use backend\models\TrEvents;
/**
 * This is the model class for table "{{%tr_events}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property integer $events_id
 * @property integer $language_id
 */
class TrEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_events}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description'], 'required'],
            [['description'], 'string'],
            [['events_id', 'language_id'], 'integer'],
            [['name', 'short_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'events_id' => Yii::t('app', 'Events ID'),
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
    public function getEvent() {
        return $this->hasOne(Events::className(), ['id' => 'events_id']);
    }

    public function updateDefaultTranslate() {
        $tr = TrEvents::findOne(['language_id' => 1, 'events_id' => $this->id]);

        if (!$tr) {
            $tr = new TrEvents();
            $tr->setAttribute('language_id', 1);
            $tr->setAttribute('events_id', $this->id);
        }
        $tr->setAttribute('name', $this->name);
        $tr->setAttribute('short_description', $this->short_description);
        $tr->setAttribute('description', $this->description);
        $tr->save();

        return true;
    }
}
