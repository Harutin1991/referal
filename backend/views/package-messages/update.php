<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PackageMessages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Package Messages',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Package Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="package-messages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
