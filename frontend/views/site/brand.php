<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Files;
$this->title = Yii::t('app','Brands');
?>
<div class="main-section">
    <div class="gallery">
        <div class="information">
            <div class="container">
                <div class="description">
                    <div class="title"><?=$this->title?></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="fild col-xs-12">
                <?php foreach($brand as $new):?>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="box">
                        <a href="/<?=Yii::$app->language?>/page/brands/<?=$new['brand_id']?>">
                            <?php echo Files::getImagesToFront('brand', $new['brand_id'],'',$new['name'],1)?>
                            <div class="title"><?=$new['name']?></div>
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>