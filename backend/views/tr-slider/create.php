<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrSlider */

$this->title = Yii::t('app', 'Create Tr Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Sliders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-slider-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
