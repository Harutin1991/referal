<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrService */

$this->title = Yii::t('app', 'Create Tr Service');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
