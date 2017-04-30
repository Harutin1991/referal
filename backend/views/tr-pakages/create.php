<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrPakages */

$this->title = Yii::t('app', 'Create Tr Pakages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Pakages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-pakages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
