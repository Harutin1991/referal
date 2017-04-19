<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

$this->title = Yii::t('app', 'Create Blog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">

    <?= $this->render('_form', [
        'model' => $model,
        'trmodel' => $trmodel,
        'defoultId' => $defoultId,
        'modelFiles' => $modelFiles,
    ]) ?>

</div>
