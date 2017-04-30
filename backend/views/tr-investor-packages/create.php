<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrInvestorPackages */

$this->title = Yii::t('app', 'Create Tr Investor Packages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Investor Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-investor-packages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
