<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrNews */

$this->title = Yii::t('app', 'Create Tr News');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
