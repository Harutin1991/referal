<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Files;
$this->title = Yii::t('app','Materials');
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
                <?php foreach($materials as $new):?>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="box">
                        <a href="/<?=Yii::$app->language?>/page/materials/<?=$new['url']?>">
                            <?php echo Files::getImagesToFront('materials', $new['materials_id'],'',$new['name'],1)?>
                            <div class="title"><?=$new['name']?></div>
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>