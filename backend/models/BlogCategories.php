<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%blog_categories}}".
 *
 * @property string $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class BlogCategories extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%blog_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs() {
        return $this->hasMany(Blog::className(), ['blog_category_id' => 'id']);
    }

}
