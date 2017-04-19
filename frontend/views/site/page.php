<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Files;
$this->title = $page[0]['title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if(empty($subPage)):?>
<div class="container-fluid">
    <div class="content-page col-xs-12">
        <div class="title"><?= Html::encode($this->title) ?></div>
        <?php $file = Files::find()->where(['category'=>'pages','category_id'=>$page[0]['pages_id']])->count(); if($file){ echo Files::getImagesToFront('pages',$page[0]['pages_id'], 'img-responsive', $page[0]['title'], 1);} ?>
        <!-- img src="image/banner.jpg" class="img-responsive hidden" -->
        <div class="txt"><?= $page[0]['content'] ?></div>
    </div>
</div>
<?php else:?>
 <div class="container-fluid">
            <div class="row">
<h1 class="text-center"><?= Html::encode($this->title) ?></h1>   
<?php foreach($subPage as $pages):?>             
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="col-parent" data="center">
<div class="text-container">
<h2 class="text-center no-margin">
<a href="/terms-of-use/pravila-torgovoy-ploschadki/"><?=$pages['title']?></a>
</h2>
<?=$pages['short_description']?>
</div>
<div class="clearfix"></div>
</div> 
                    <div class="clearfix"></div>
                </div>
				<?php endforeach;?>
            </div>
        </div>
<?php endif;?>
