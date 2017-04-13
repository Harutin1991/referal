<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\InvsetorPackages */

$this->title = Yii::t('app', 'Create Invsetor Packages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Invsetor Packages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invsetor-packages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
