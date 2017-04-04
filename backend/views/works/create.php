<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Works */

$this->title = Yii::t('app', 'Create Works');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'defoultId' => $defoultId,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
