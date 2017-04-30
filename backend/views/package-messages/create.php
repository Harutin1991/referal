<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PackageMessages */

$this->title = Yii::t('app', 'Create Package Messages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Package Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-messages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
