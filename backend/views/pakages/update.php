<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pakages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pakages',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pakages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pakages-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
