<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrFaq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr-faq-form">

    <?php
    $form = ActiveForm::begin([
                'action' => ['/tr-faq/update'],
                'id' => 'trfaqUpdate',
    ]);
    ?>

    <label style="font-size: 25px; color:#0a0e1b">Faq Title:<?= $model->faq->title; ?></label>
    <div class="clearfix"></div>
    <div class="tab-content row">
        <div class="col-md-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>

        <?= $form->field($model, 'faq_id')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'language_id')->hiddenInput()->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
