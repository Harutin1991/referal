<?php

use backend\models\Aboutus;
use backend\models\Files;
$this->title = Yii::t('app', 'About Us');
?>
<div class="container">
    <div class="about-page col-xs-12">
        <?php echo Files::getImagesToFront('about', $about[0]['aboutus_id'], 'img-responsive', $about[0]['title']) ?>
        <div class="title"><?= $about[0]['title'] ?></div>
        <div class="txt"><?= $about[0]['description'] ?></div>
    </div>
</div>