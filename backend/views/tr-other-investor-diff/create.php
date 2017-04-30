<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrOtherInvestorDiff */

$this->title = Yii::t('app', 'Create Tr Other Investor Diff');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Other Investor Diffs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-other-investor-diff-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
