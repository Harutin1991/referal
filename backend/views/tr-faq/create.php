<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrFaq */

$this->title = Yii::t('app', 'Create Tr Faq');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-faq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
