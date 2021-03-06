<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OtherInvestorDiff */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Other Investor Diff',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Other Investor Diffs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="other-investor-diff-update">

    <?= $this->render('_form', [
         'model' => $model,
        'imagePaths' => $imagePaths,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
