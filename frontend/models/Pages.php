<?php

namespace frontend\models;

use Yii;
use backend\models\TrPages;
/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property integer $ordering
 * @property string $created_date
 * @property string $updated_date
 *
 * @property TrPages[] $trPages
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    public function findList($page_id){
        $language = Yii::$app->language;

        $rows = (new \yii\db\Query())
            ->select(['pages.id', 'tr_pages.*'])
            ->from('pages')
            ->leftJoin('tr_pages','pages.id = tr_pages.pages_id')
            ->leftJoin('language','language.id = tr_pages.language_id')
            ->where(['language.short_code' => $language,'pages.id'=>$page_id])
            ->orderBy(['pages.ordering'=>SORT_ASC])
            ->all();

        return $rows;
    }



}
