<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrMaterials */

$this->title = Yii::t('app', 'Create Tr Materials');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-materials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
