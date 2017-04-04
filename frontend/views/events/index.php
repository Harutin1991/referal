<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Files;
$this->title = Yii::t('app','Events').' - '.$event[0]['name'];
?>
<div class="main-section">
    <div class="container">
        <div class="service-page col-xs-12">
            <?php echo Files::getImagesToFront('events', $event[0]['events_id'], 'img-responsive', $event[0]['name'], 1) ?>
            <div class="title"><?=$event[0]['name']?></div>
            <div class="txt"><?=$event[0]['description']?></div>
        </div>
    </div>
</div>