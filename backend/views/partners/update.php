<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Partners */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Partners',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="partners-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'imagePaths' => $images,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
