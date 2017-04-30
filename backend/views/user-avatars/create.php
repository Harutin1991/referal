<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserAvatars */

$this->title = Yii::t('app', 'Create User Avatars');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Avatars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-avatars-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
