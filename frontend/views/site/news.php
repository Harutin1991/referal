<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Files;

$this->title = Yii::t('app', 'Our News');
?>
<div class="container">
    <div class="news-page col-xs-12">
        <?php foreach ($news as $new): ?>
            <div class="box col-xs-12">
                <div class="left-sidebar col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <?php echo Files::getImagesToFront('news', $new['news_id'], 'img-responsive', $new['name'], 1) ?>
                </div>
                <div class="right-sidebar col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="title"><?= $new['name'] ?><span class="date"><?php echo date('d/m/Y', strtotime($new['created_at'])) ?></span>
                    </div>
                    <div class="txt"><?= $new['short_description'] ?> </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
