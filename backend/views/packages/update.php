<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pakages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Packages',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pakages-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
