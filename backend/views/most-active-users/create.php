<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MostActiveUsers */

$this->title = Yii::t('app', 'Create Most Active Users');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Most Active Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="most-active-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
