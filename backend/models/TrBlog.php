<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tr_blog}}".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $short_description
 * @property string $meta_description
 * @property string $meta_key
 * @property integer $language_id
 * @property integer $blog_id
 */
class TrBlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tr_blog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'short_description', 'meta_description', 'meta_key', 'language_id', 'blog_id'], 'required'],
            [['description'], 'string'],
            [['language_id', 'blog_id'], 'integer'],
            [['title', 'short_description', 'meta_description', 'meta_key'], 'string', 'max' => 255],
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
            'short_description' => Yii::t('app', 'Short Description'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_key' => Yii::t('app', 'Meta Key'),
            'language_id' => Yii::t('app', 'Language ID'),
            'blog_id' => Yii::t('app', 'Blog ID'),
        ];
    }
}
