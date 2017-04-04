<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Zones */

$this->title = Yii::t('app', 'Create Zones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'countryForm'=>$countryForm,
        'priceForm'=>$priceForm
    ]) ?>

</div>
