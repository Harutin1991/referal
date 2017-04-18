<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Files;
$this->title = $blog[0]['title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="content-page col-xs-12">
        <div class="title"><?= Html::encode($this->title) ?></div>
        <?php $file = Files::find()->where(['category'=>'blog','category_id'=>$blog[0]['blog_id']])->count(); if($file){ echo Files::getImagesToFront('blog',$blog[0]['blog_id'], 'img-responsive', $blog[0]['title'], 1);} ?>
        <!-- img src="image/banner.jpg" class="img-responsive hidden" -->
        <div class="txt"><?= $blog[0]['description'] ?></div>
    </div>
</div>
