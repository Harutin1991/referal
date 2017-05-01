<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Calculator */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Calculator',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calculators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="calculator-update">
    <?= $this->render('_form', [
       'model' => $model,
        'imagePaths' => $imagePaths,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
