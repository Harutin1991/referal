<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Files;

$this->title = Yii::t('app', 'Service') . ' - ' . $service[0]['name'];
$news = $service;
$galery = Files::find()->where(['category' => 'service', 'category_id' => $news[0]['service_id'], 'top' => 0])->asArray()->all();
?>
<div class="container">
    <div class="service-sub col-xs-12">
        <div class="container">	
            <div class="fild col-xs-12">
                <?php echo Files::getImagesToFront('service', $news[0]['service_id'], 'img-responsive banner', $news[0]['name'], 1) ?>
                <div class="title"><?= $news[0]['name'] ?></div>
                <div class="txt"><?= $news[0]['description'] ?></div>
            </div>
            <div class="demo-gallery">
                <ul id="lightgallery" class="list-unstyled row">
                    <?php foreach ($galery as $image): ?>
                        <li class="col-xs-6 col-sm-4 col-md-3 col-lg-2" data-responsive="" data-src="<?= Yii::$app->params['adminUrl'] . 'uploads/images/service/' . $news[0]['service_id'] . '/' . $image['path'] ?>" data-sub-html="">
                            <a href="javascript:void(0)">
                                <img class="img-responsive" src="<?= Yii::$app->params['adminUrl'] . 'uploads/images/service/' . $news[0]['service_id'] . '/' . $image['path'] ?>">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs("   	
    $(document).ready(function(){
	      $('#lightgallery').lightGallery();
	    });
")?>