<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserAvatars */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Avatars',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Avatars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-avatars-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
