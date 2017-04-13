<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrHowToEarn */

$this->title = Yii::t('app', 'Create Tr How To Earn');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr How To Earns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-how-to-earn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
