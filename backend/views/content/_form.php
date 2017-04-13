<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slider')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'how_to_earn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'investor_pakage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_investor_diff')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'most_active_users')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calculator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'articles')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ordering')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
