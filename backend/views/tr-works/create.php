<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrWorks */

$this->title = Yii::t('app', 'Create Tr Works');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Works'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-works-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
