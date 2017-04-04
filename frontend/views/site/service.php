<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Files;

$this->title = Yii::t('app', 'Service');
?>

<div class="container">
    <div class="service-page col-xs-12">
        <?php foreach ($service as $serv): ?>
        <div class="fild col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <figure class="box">
                <?php echo Files::getImagesToFront('service', $serv['service_id'], '', $serv['name'], 1) ?>
                <figcaption>
                    <div class="title1"><?= $serv['name'] ?></div>
                </figcaption><a href="/<?=Yii::$app->language?>/page/service/<?= $serv['route_name'] ?>"></a>
            </figure>
        </div>
        <?php endforeach; ?>
    </div>
</div>