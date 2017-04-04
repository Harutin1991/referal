<?php

namespace backend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "{{%sitesettings}}".
 *
 * @property string $id
 * @property string $logoText
 * @property string $facebook
 * @property string $google
 * @property string $youtube
 */
class Sitesettings extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%sitesettings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['logoText', 'facebook', 'google', 'youtube'], 'required'],
            [['logoText', 'facebook', 'twitter', 'google', 'youtube'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'logoText' => Yii::t('app', 'Opened times'),
            'facebook' => Yii::t('app', 'Facebook'),
            'google' => Yii::t('app', 'Google'),
            'youtube' => Yii::t('app', 'Youtube'),
            'twitter' => Yii::t('app', 'Twitter'),
        ];
    }

    public static function find_One() {
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query->select(['tr_sitesettings.*', 'sitesettings.facebook', 'sitesettings.youtube', 'sitesettings.google', 'sitesettings.twitter']);
        $query->from('sitesettings');

        $query->leftJoin('tr_sitesettings', 'sitesettings.id = tr_sitesettings.settings_id');
        $query->leftJoin('language', 'language.id = tr_sitesettings.language_id');
        $query->where($where);
        // $query->offset(1);
        $query->orderBy(['sitesettings.id' => SORT_DESC]);
        $query->limit(8);
        $rows = $query->all();
        //$arrData = self::makeArray($rows);
        return $rows;
    }

    public function updateDefaultTranslate($language_id) {
        $tr = TrSitesettings::findOne(['language_id' => $language_id, 'settings_id' => $this->id]);
        if (!$tr) {
            $tr = new TrSitesettings();
            $tr->setAttribute('language_id', $language_id);
            $tr->setAttribute('settings_id', $this->id);
        }
        $tr->setAttribute('logoText', $this->logoText);
        $tr->save();
        return true;
    }

}
