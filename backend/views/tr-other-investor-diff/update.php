<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrOtherInvestorDiff */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tr Other Investor Diff',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Other Investor Diffs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr-other-investor-diff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
