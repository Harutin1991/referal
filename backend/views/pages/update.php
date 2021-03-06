<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pages',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pages-update">
    <?= $this->render('_form', [
        'model' => $model,
        'subpagesCount' => $subpagesCount,
        'imagePaths' => $images,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
