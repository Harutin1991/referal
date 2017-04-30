<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InvestorPackages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Investor Packages',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Investor Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="investor-packages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
