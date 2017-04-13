<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CalculatorProfit */

$this->title = Yii::t('app', 'Create Calculator Profit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calculator Profits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calculator-profit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
