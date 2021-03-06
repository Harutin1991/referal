<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrBrand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr-brand-form">

    <?php
    $form = ActiveForm::begin([
                'action' => ['/tr-brand/update'],
                'id' => 'trbrandupdate',
    ]);
    ?>

    <label style="font-size: 25px; color:#0a0e1b"> <?= $model->brand->name; ?></label>
    <div class="clearfix"></div>
    <div class="form-group">
        <div class="section row">
            <div class="col-md-12">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
            </div>
        </div>
        <div class="section row">
            <div class="col-md-6">
                <?=
                        $form->field($model, 'short_description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                        ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Short Description')])->label(false)
                ?>
            </div>
            <div class="col-md-6">
                <?=
                        $form->field($model, 'description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                        ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Description')])->label(false)
                ?>
            </div>
        </div>
        <?= $form->field($model, 'language_id')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'brand_id')->hiddenInput()->label(false) ?>

        <div class="col-md-6">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'type' => 'button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php echo $this->registerJs("
            CKEDITOR.replace('trbrand-short_description');
            CKEDITOR.replace('trbrand-description');
"); ?>
</div>

