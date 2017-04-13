<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HowToEarn */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'How To Earn',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'How To Earns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="how-to-earn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
