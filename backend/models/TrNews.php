<?php

namespace backend\models;

use Yii;
use backend\models\TrNews;

/**
 * This is the model class for table "{{%tr_news}}".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property string $route_name
 * @property integer $news_id
 * @property integer $language_id
 */
class TrNews extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%tr_news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['news_id', 'language_id'], 'integer'],
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
            'news_id' => Yii::t('app', 'News ID'),
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
    public function getNews() {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }

    public function updateDefaultTranslate() {
        $tr = TrNews::findOne(['language_id' => 1, 'news_id' => $this->id]);

        if (!$tr) {
            $tr = new TrNews();
            $tr->setAttribute('language_id', 1);
            $tr->setAttribute('news_id', $this->id);
        }
        $tr->setAttribute('name', $this->name);
        $tr->setAttribute('short_description', $this->short_description);
        $tr->setAttribute('description', $this->description);
        $tr->save();

        return true;
    }

}
