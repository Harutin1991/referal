<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrPakagePrice */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tr Pakage Price',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Pakage Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr-pakage-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
