<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%files}}".
 *
 * @property string $id
 * @property string $path
 * @property integer $category_id
 * @property string $category
 * @property integer $status
 * @property integer $top
 */
class Files extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
         return [
            [['filename', 'category', 'category_id', 'mime'], 'required'],
            [['category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['filename', 'category', 'mime'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'filename' => Yii::t('app', 'Filename'),
            'category' => Yii::t('app', 'Category'),
            'category_id' => Yii::t('app', 'Category ID'),
            'mime' => Yii::t('app', 'Mime'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @param $productId
     * @return array
     */
    public static function getDefaultImageIdByProductId($category_id, $category) {
        $data = self::find()->where(['category_id' => $category_id, 'category' => $category, 'top' => 1])->asArray()->all();
        return ArrayHelper::map($data, 'id', 'id');
    }

    /**
     * @param $paths
     * @param $product_id
     * @param $default_image
     * @return bool
     */
    public function multiSave($paths, $product_id, $default_image, $img_type) {
        if (!empty($paths)) {
            $data = [];

            foreach ($paths as $key => $value) {

                if ($key == $default_image) {
                    $data[] = [
                        'filename' => $value,
                        'category_id' => $product_id,
                        'category' => $img_type,
                        'top' => $default_image,
                    ];
                } else {
                    $data[] = [
                        'filename' => $value,
                        'category_id' => $product_id,
                        'category' => $img_type,
                        'top' => 0,
                    ];
                }
            }
            Yii::$app->db->createCommand()
                    ->batchInsert(
                            'files', ['filename', 'category_id', 'category', 'top'], $data
                    )
                    ->execute();
            return true;
        }
        return false;
    }

    public static function updatDefaultImage($new_id, $category_id, $category) {
        if ($category == 'aboutus') {
            $category = 'about';
        }
        self::getDb()->createCommand("UPDATE files SET top = 0 WHERE category_id = $category_id AND category = '" . $category . "'")->execute();
        self::getDb()->createCommand("UPDATE files SET top = 1 WHERE id = $new_id AND category_id = $category_id")->execute();
        return true;
    }

    public static function getImagesToFront($category, $category_id = null, $class = '', $alt = '', $top = 0) {
        $params = [
            'class' => $class,
            'alt' => $alt,
        ];
        if (!is_null($category_id)) {
            $images = self::find()->where(['category' => $category, 'category_id' => $category_id, 'top' => $top])->asArray()->all();
        } else {
            $images = self::find()->where(['category' => $category])->asArray()->all();
        }

        if (!empty($images[0])) {
            return Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/' . $category . '/' . $category_id . '/' . $images[0]['filename'], $params);
        } else {
            return Html::img(Yii::$app->params['adminUrl'] . 'img/default.png');
        }
    }

    public static function getImagesToThumb($category, $category_id = null, $class = '', $alt = '', $top = 0) {
        $params = [
            'class' => $class,
            'alt' => $alt,
        ];
        if (!is_null($category_id)) {
            $images = self::find()->where(['category' => $category, 'category_id' => $category_id, 'top' => $top])->asArray()->all();
        } else {
            $images = self::find()->where(['category' => $category])->asArray()->all();
        }

        if (!empty($images[0])) {
            return Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/' . $category . '/' . $category_id . '/thumbnail/' . $images[0]['filename'], $params);
        } else {
            return Html::img(Yii::$app->params['adminUrl'] . 'img/default.png');
        }
    }

    public static function getImagesThumb($category, $category_id = null, $class = '', $alt = '', $top = 0) {
        $params = [
            'class' => $class,
            'alt' => $alt,
        ];
        if (!is_null($category_id)) {
            $images = self::find()->where(['category' => $category, 'category_id' => $category_id, 'top' => $top])->asArray()->all();
        } else {
            $images = self::find()->where(['category' => $category])->asArray()->all();
        }
        if (!empty($images[0])) {
            return Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/' . $category . '/' . $category_id . '/thumbnail/' . $images[0]['filename'], $params);
        } else {
            return Html::img(Yii::$app->params['adminUrl'] . 'img/default.png');
        }
    }

    public static function slider() {
        return self::find()->where(['category' => 'slider'])->asArray()->all();
    }

}
