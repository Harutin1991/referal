<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrEvents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr-works-form">

    <?php
    $form = ActiveForm::begin([
                'action' => ['/tr-news/update'],
                'id' => 'trnewsUpdate',
    ]);
    ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false"
         data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <span class="panel-title"><label style="font-size: 25px; color:#0a0e1b">News Name: <?= $model->news->title; ?></label></span>
        </div>

        <div class="panel-body" style="display: block;">
            <div class="clearfix"></div>
            <div class="tab-content row">
                <div class="row">
                    <div class="col-md-6">
                        <?=
                                $form->field($model, 'name', ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                        {input}<label for="customer-name" class="field-icon"><i class="fa fa-tags"></i></label></label>{error}</div>'])
                                ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'News Name')])->label(false);
                        ?>
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
                <?= $form->field($model, 'news_id')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'language_id')->hiddenInput()->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php echo $this->registerJs("
            CKEDITOR.replace('trnews-short_description');
            CKEDITOR.replace('trnews-description');
"); ?>
        </div>
    </div>
</div>
