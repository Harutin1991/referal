<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrEvents */

$this->title = Yii::t('app', 'Create Tr Events');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
