<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Works */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Works',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="works-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'imagePaths' => $images,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
