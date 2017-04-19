<?php

namespace backend\models;

use Yii;
use backend\models\TrBlog;
use yii\db\Query;
/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $description
 * @property string $title
 * @property string $short_description
 * @property string $meta_key
 * @property string $meta_description
 * @property integer $status
 */
class Blog extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'title'], 'required'],
            [['blog_category_id', 'user_id', 'status', 'views','ordering'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title', 'meta_description', 'meta_key'], 'string', 'max' => 255],
            [['short_description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'blog_category_id' => Yii::t('app', 'Blog Category ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_key' => Yii::t('app', 'Meta Key'),
            'status' => Yii::t('app', 'Status'),
            'views' => Yii::t('app', 'Views'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategory() {
        return $this->hasOne(BlogCategories::className(), ['id' => 'blog_category_id']);
    }

    public function updateDefaultTranslate($language_id) {
        $tr = TrBlog::findOne(['language_id' => $language_id, 'blog_id' => $this->id]);
        if (!$tr) {
            $tr = new TrBlog();

            $tr->setAttribute('language_id', $language_id);
            $tr->setAttribute('blog_id', $this->id);
        }
        $tr->setAttribute('title', $this->title);
        $tr->setAttribute('description', $this->description);
        $tr->setAttribute('short_description', $this->short_description);
        $tr->setAttribute('meta_description', $this->meta_description);
        $tr->setAttribute('meta_key', $this->meta_key);
        $tr->save();
        return true;
    }
    
    public static function findList($blog_id = false,$limit = false) {

        $language = Yii::$app->language;
        $where = ['language.short_code' => $language];
        $query = (new Query());
        $query->select(['tr_blog.*','blog.created_at','blog.views']);
        $query->from('blog');
        $query->leftJoin('tr_blog', 'blog.id = tr_blog.blog_id');
        $query->leftJoin('language', 'language.id = tr_blog.language_id');
        if($blog_id){
            $where = array_merge($where,['blog.id'=>$blog_id]);
        }
		if($limit){
			$query->limit($limit);
		}
        $query->where($where);
        $query->orderBy(['blog.ordering' => SORT_ASC]);
        $rows = $query->all();
        return $rows;
    }
    
    /**
     * @param $AllData
     * @return int
     */
    public function bachUpdate($AllData) {

        $updateQuery = "UPDATE `blog` SET ";
        $subUpdateOrderingQuery = '`ordering` = CASE `id` ';
        foreach ($AllData as $item => $data) {
            $subUpdateOrderingQuery .= ' WHEN ' . $data['id'] . ' THEN ' . "'{$data['ordering']}'";
        }
        $updateQuery .= $subUpdateOrderingQuery . ' END';
        return self::getDb()->createCommand($updateQuery)->execute();
    }

}
