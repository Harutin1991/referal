<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pakages */

$this->title = Yii::t('app', 'Create Packages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pakages-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modelMessage' => $modelMessage,
    ]) ?>

</div>
