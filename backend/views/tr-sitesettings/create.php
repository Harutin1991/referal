<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrSitesettings */

$this->title = Yii::t('app', 'Create Tr Sitesettings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Sitesettings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-sitesettings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
