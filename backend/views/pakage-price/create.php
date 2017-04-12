<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PakagePrice */

$this->title = Yii::t('app', 'Create Pakage Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pakage Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pakage-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
