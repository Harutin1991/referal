<?php

namespace backend\models;

use Yii;
use yii\db\Query;
/**
 * This is the model class for table "{{%investor_packages}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property double $price
 * @property string $create_date
 * @property string $update_date
 * @property integer $default_package
 */
class InvestorPackages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%investor_packages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['create_date', 'update_date'], 'safe'],
            [['ordering'], 'integer'],
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
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'create_date' => Yii::t('app', 'Create Date'),
            'update_date' => Yii::t('app', 'Update Date'),
            'ordering' => Yii::t('app', 'Ordering'),
        ];
    }
    
    /**
     * @param $AllData
     * @return int
     */
    public function bachUpdate($AllData) {

        $updateQuery = "UPDATE `investor_packages` SET ";
        $subUpdateOrderingQuery = '`ordering` = CASE `id` ';
        foreach ($AllData as $item => $data) {
            $subUpdateOrderingQuery .= ' WHEN ' . $data['id'] . ' THEN ' . "'{$data['ordering']}'";
        }
        $updateQuery .= $subUpdateOrderingQuery . ' END';
        return self::getDb()->createCommand($updateQuery)->execute();
    }
    
    public static function findList($blog_id = false,$limit = false) {

        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query->select(['tr_investor_packages.*','investor_packages.price']);
        $query->from('investor_packages');
        $query->leftJoin('tr_investor_packages', 'investor_packages.id = tr_investor_packages.invsetor_packages_id');
        $query->leftJoin('language', 'language.id = tr_investor_packages.language_id');
        $query->where($where);
        $query->orderBy(['investor_packages.ordering' => SORT_ASC]);
        $rows = $query->all();
        return $rows;
    }
}
