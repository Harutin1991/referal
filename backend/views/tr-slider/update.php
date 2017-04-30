<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrSlider */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tr Slider',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr-slider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
