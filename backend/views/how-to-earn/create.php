<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\HowToEarn */

$this->title = Yii::t('app', 'Create How To Earn');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'How To Earns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="how-to-earn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
