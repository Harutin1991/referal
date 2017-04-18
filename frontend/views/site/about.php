<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Files;
$this->title = $page[0]['title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="content-page col-xs-12">
        <div class="title"><?= Html::encode($this->title) ?></div>
        <?php $file = Files::find()->where(['category'=>'about','category_id'=>$page[0]['aboutus_id']])->count(); if($file){ echo Files::getImagesToFront('about',$page[0]['aboutus_id'], 'img-responsive', $page[0]['title'], 1);} ?>
        <!-- img src="image/banner.jpg" class="img-responsive hidden" -->
        <div class="txt"><?= $page[0]['description'] ?></div>
    </div>
</div>
