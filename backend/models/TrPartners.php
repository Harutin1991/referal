<?php

namespace backend\models;

use Yii;
use common\models\Language;
/**
 * This is the model class for table "{{%tr_partners}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_description
 * @property integer $language_id
 * @property integer $partners_id
 */
class TrPartners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_partners}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'short_description', 'language_id', 'partners_id'], 'required'],
            [['language_id', 'partners_id'], 'integer'],
            [['title', 'short_description'], 'string', 'max' => 255],
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
            'language_id' => Yii::t('app', 'Language ID'),
            'partners_id' => Yii::t('app', 'Partners ID'),
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
    public function getPartner() {
        return $this->hasOne(Partners::className(), ['id' => 'partners_id']);
    }

    public function updateDefaultTranslate() {
        $tr = TrPartners::findOne(['language_id' => 1, 'partners_id' => $this->id]);

        if (!$tr) {
            $tr = new TrPartners();
            $tr->setAttribute('language_id', 1);
            $tr->setAttribute('partners_id', $this->id);
        }
        $tr->setAttribute('name', $this->name);
        $tr->setAttribute('short_description', $this->short_description);
        $tr->save();

        return true;
    }
}
