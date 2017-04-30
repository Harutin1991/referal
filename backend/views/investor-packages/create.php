<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InvestorPackages */

$this->title = Yii::t('app', 'Create Investor Packages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Investor Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="investor-packages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
