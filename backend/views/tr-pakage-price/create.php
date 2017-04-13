<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrPakagePrice */

$this->title = Yii::t('app', 'Create Tr Pakage Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Pakage Prices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-pakage-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
