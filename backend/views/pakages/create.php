<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pakages */

$this->title = Yii::t('app', 'Create Pakages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pakages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pakages-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
