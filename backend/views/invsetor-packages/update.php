<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InvsetorPackages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Invsetor Packages',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invsetor Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="invsetor-packages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
