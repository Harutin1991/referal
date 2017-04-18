<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = Yii::t('app', 'Create Sub Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-create">
    <?= $this->render('sub_form', [
        'model' => $model,
        'parentPage'=>$parentPage,
        'defoultId' => $defoultId,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
