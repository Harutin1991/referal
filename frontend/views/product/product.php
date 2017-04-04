<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\TrAttribute;
use backend\models\ProductImage;
use common\models\Language;
use yii\helpers\Url;

$product_id = array_keys($products);

$languages = Language::find()->asArray()->all();
$imagePaths = ProductImage::getImageByProductId($product_id[0]);
$defaultImage = ProductImage::getDefaultImageIdByProductId($product_id[0]);
?>
<?php $this->registerCssFile('@web/css/lightgallery/lightgallery.css',['depends' => [\frontend\assets\AppAsset::className()]]);?>
<div class="product-sub-page col-xs-12">
    <div class="container">
        <div class="information">
            <div class="title">
                <span><?= $products[$product_id[0]]['name'] ?></span>
            </div>
            <div class="txt"><?= $products[$product_id[0]]['description'] ?></div>
        </div>	
        <div class="demo-gallery">
            <ul id="lightgallery" class="list-unstyled row">
                <?php foreach ($imagePaths as $key => $path): ?>
                <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="" data-src="<?=Yii::$app->params['adminUrl'] . 'uploads/images/product/' .$product_id[0] . '/' . $path?>" data-sub-html="">
                        <a href="">
                            <?php echo backend\models\Product::getImagesHTML($key, 'img-responsive', '', false, $product_id[0]) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>	
    </div>
</div>
<?php $this->registerJsFile('@web/js/lightgallery/lightgallery.js', ['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJs("$('#lightgallery').lightGallery();",View::POS_READY);
?>