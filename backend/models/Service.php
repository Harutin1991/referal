<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use backend\models\Files;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property string $description
 * @property string $short_description
 * @property integer $status
 * @property string $created_date
 * @property string $updated_date
 */
class Service extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['description', 'route_name'], 'string'],
            [['status','parent_id'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name', 'short_description', 'route_name'], 'string', 'max' => 250],
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
            'status' => Yii::t('app', 'Status'),
            'parent_id' => Yii::t('app', 'Parent'),
            'route_name' => Yii::t('app', 'Rout Name'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    /**
     * @return array
     */
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_date', 'updated_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_date'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findList($limit = '',$filters = []) {
        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        if (!empty($filters)) {
            $where = array_merge($where, ['service.parent_id' => $filters['parent_id']]);
        }
        $query = (new Query());
        $query
                ->select(['service.id', 'tr_service.*', 'service.route_name','service.parent_id'])
                ->from('service')
                ->leftJoin('tr_service', 'service.id = tr_service.service_id')
                ->leftJoin('language', 'language.id = tr_service.language_id')
                ->where($where);
        if(empty($filters)){
            $query->andWhere(['not', ['service.parent_id' => null]]);
        }
        if ($limit != '') {
            $query->limit($limit);
        }
        $rows = $query->orderBy(['service.id' => SORT_ASC])
                ->all();
        return $rows;
    }

    public function updateDefaultTranslate($lanugage_id) {
        $tr = TrService::findOne(['language_id' => $lanugage_id, 'service_id' => $this->id]);
        if (!$tr) {
            $tr = new TrService();

            $tr->setAttribute('language_id', $lanugage_id);
            $tr->setAttribute('service_id', $this->id);
        }
        $tr->setAttribute('name', $this->name);
        $tr->save();
        return true;
    }

    /**
     * @param $product_id
     * @return array
     */
    public function getDefaultImage($service_id) {
        $result = Files::find()->where(['category_id' => $service_id, 'category' => 'service', 'top' => 1, 'status' => 1])->asArray()->all();
        return ArrayHelper::map($result, 'top', 'path');
    }

    /**
     * list of categories
     * @return array
     */
    public function getParentsByID($id) {
        return self::find()->where(['id' => $id])->one();
    }

}
