<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_parts".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $in_stock
 * @property integer $product_id
 *
 * @property Product $product
 */
class ProductParts extends ActiveRecord
{

    public $parts_imageFiles;
    const UPLOAD_MAX_COUNT = 10;
    public static $Extensions = ['jpg', 'png'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'product_id'], 'required'],
            [['description'], 'string'],
            [['price', 'in_stock', 'product_id'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['parts_imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => implode(", ", self::$Extensions), 'maxFiles' => 4],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'in_stock' => Yii::t('app', 'Stock'),
            'product_id' => Yii::t('app', 'Product ID'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function batchInsert($data, $product_id)
    {
        $rows = [];
        $columns = [
            'name',
            'price',
            'in_stock',
            'description',
            'product_id',
        ];

        foreach ($data as $item => $value) {
            $value['product_id'] = $product_id;
            $rows[$item] = $value;
        }
        $result = Yii::$app->db->createCommand()->batchInsert(self::tableName(), $columns, $rows)->execute();
        return $result;
    }

    /**
     * @param $ProducAttrs array of product parts attributes
     * @param $ProductImg array of product parts images paths
     * @param $product_id integer,  id of product
     * @param $defImgs array of product parts default image key in $ProductImg
     * @return array|bool true
     */
    public function saveData($ProducAttrs, $ProductImg, $product_id, $defImgs)
    {
        if(isset($ProducAttrs)) {
            foreach ($ProducAttrs as $key => $ProducAttr) {
                $obj = new ProductParts();
                $img_key = "defaultImagePart_" . $key;
                $obj->name = $ProducAttr['name'];
                $obj->price = $ProducAttr['price'];
                $obj->in_stock = $ProducAttr['in_stock'];
                $obj->description = $ProducAttr['description'];
                $obj->product_id = $product_id;
                if (!$obj->save()) {
                    var_dump($obj->errors);
                    die;
                } else {
                    $ProductImage = new ProductImage();
                    $ProductImage->multiSave($ProductImg[$key], $obj->id, $defImgs[$img_key], 0);
                }
            }
        }
        return true;
    }


    /**
     * @param $data
     * @param $customer_id
     * @return bool
     */
    public function batchUpdate($ProducAttrs, $ProductImg, $product_id, $defImgs)
    {
        $DataProductParts = self::find()->where(['product_id' => $product_id])
            ->asArray()->all();
        if (empty($DataProductParts)) {
            return $this->saveData($ProducAttrs, $ProductImg, $product_id, $defImgs);
        } else {
           $ProductPartsOldIds =ArrayHelper::map($DataProductParts,'id','id');
            foreach ($ProducAttrs as $key =>$producAttr){
                $img_key = "defaultImagePart_".$key;
                $ProductImage = new ProductImage();
                if($producAttr['id'] == 0){

                    $obj = new ProductParts();
                    $obj->name = $producAttr['name'];
                    $obj->price = $producAttr['price'];
                    $obj->in_stock = $producAttr['in_stock'];
                    $obj->description = $producAttr['description'];
                    $obj->product_id = $product_id;
                    $obj->save();
                    if(!$obj->save()){
                        var_dump($this->errors) ; die;
                    }else{
                        $ProductImage->multiSave($ProductImg[$key], $obj->id, $defImgs[$img_key], 0);
                    }
                }
                elseif(in_array($producAttr['id'],$ProductPartsOldIds)){

                    $model = self::findOne($producAttr['id']);
                    $model->name = $producAttr['name'];
                    $model->price = $producAttr['price'];
                    $model->in_stock = $producAttr['in_stock'];
                    $model->description = $producAttr['description'];
                    $model->product_id = $product_id;
                    $model->update();
                    if(!$model->save()){
                        var_dump($model->errors) ; die;
                    }
                    unset($ProductPartsOldIds[$producAttr['id']]);
                    $ProductImage->multiSave($ProductImg[$key], $model->id, 0, 0);
                }
            }
            if(!empty($ProductPartsOldIds)){
                $wherein = implode(', ', $ProductPartsOldIds);
                self::deleteAll('id in(:ids)',[':ids'=>$wherein]);
                foreach ($ProductPartsOldIds as $oldId){
                    $Images = ProductImage::find()->where(['product_id' => $oldId, 'type'=>0])->asArray()->all();
                    $ImgPaths =ArrayHelper::map($Images, 'id', 'name');
                    foreach ($ImgPaths as $item => $imgPath){
                        ProductImage:self::findOne($item)->delete();
                        if(file_exists(Yii::$app->basePath.'/web/'.$imgPath)){
                            unlink(Yii::$app->basePath.'/web/'.$imgPath);
                        }
                    }

                }
            }
            return true;
        }
    }

    /**
     * @param $product_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getProductParts($product_id)
    {
        $result = self::find()->where(['product_id' => $product_id])->asArray()->all();
        return $result;
    }

    /**
     * @param $product_part_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getImageByPartId($product_part_id)
    {
       return ProductImage::find()
           ->where(['product_id'=>$product_part_id, 'type'=>0])
           ->asArray()->all();
    }
}
