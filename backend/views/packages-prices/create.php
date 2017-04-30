<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PackagesPrices */

$this->title = Yii::t('app', 'Create Packages Prices');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packages Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packages-prices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
