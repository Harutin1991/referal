<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrPartners */

$this->title = Yii::t('app', 'Create Tr Partners');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-partners-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
