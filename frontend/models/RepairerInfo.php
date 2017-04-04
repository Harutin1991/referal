<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "repairer_info".
 *
 * @property integer $id
 * @property integer $repairer_id
 * @property string $specialty
 * @property string $qualification
 * @property string $work_experience
 * @property integer $rating
 *
 * @property Repairer $repairer
 */
class RepairerInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repairer_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repairer_id'], 'required'],
            [['repairer_id', 'rating'], 'integer'],
            [['specialty', 'qualification', 'work_experience'], 'string', 'max' => 250],
            [['repairer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Repairer::className(), 'targetAttribute' => ['repairer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'repairer_id' => Yii::t('app', 'Repairer ID'),
            'specialty' => Yii::t('app', 'Specialty'),
            'qualification' => Yii::t('app', 'Qualification'),
            'work_experience' => Yii::t('app', 'Work Experience'),
            'rating' => Yii::t('app', 'Rating'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairer()
    {
        return $this->hasOne(Repairer::className(), ['id' => 'repairer_id']);
    }
}
