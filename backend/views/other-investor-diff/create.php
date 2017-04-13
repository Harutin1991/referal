<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OtherInvestorDiff */

$this->title = Yii::t('app', 'Create Other Investor Diff');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Other Investor Diffs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="other-investor-diff-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
