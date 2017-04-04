<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\ServiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="section row">
    <?php //echo $form->field($model, 'id') ?>

        <div class="col-md-12">
            <?= $form->field($model, 'name',
                ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-lat" class="field prepend-icon">
                    {input}<label for="repairer-lat" class="field-icon"><i class="fa fa-tags"></i></label></label>{error}</div>'])
                ->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label(false) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'short_description',
                ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-lat" class="field prepend-icon">
               {input}<label for="repairer-lat" class="field-icon"><i class="fa fa-comment-o"></i></label></label>{error}</div>'])
                ->textInput(['maxlength' => true, 'placeholder' => 'Short Description'])->label(false) ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'status')->widget(Select2::className(), [
                'data' => ["Pasive", "Active"],
                'language' => Yii::$app->language,
                'options' => ['placeholder' => 'Filter By Status ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => false
                ],
            ])->label(false) ?>
        </div>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    </div>
    <hr class="short">
    <div class="section">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-default btn-sm ph25']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default btn-sm ph25']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
