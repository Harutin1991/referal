<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Blog',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="blog-update">

    <?= $this->render('_form', [
       'model' => $model,
        'imagePaths' => $imagePaths,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
