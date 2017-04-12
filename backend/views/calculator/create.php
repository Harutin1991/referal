<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Calculator */

$this->title = Yii::t('app', 'Create Calculator');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calculators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calculator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
