<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $page['title'];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="content">
    <div class="container box blog-page">

        <div class="row blog-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="blog-body"><?=$page['content'] ?></div> 
    </div>
</section>
