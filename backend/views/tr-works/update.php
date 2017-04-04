<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrWorks */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tr Works',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tr-works-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
