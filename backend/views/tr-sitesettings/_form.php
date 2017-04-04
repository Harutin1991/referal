<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrSitesettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr-sitesettings-form">

    <?php
    $form = ActiveForm::begin([
                'action' => ['/tr-sitesettings/update'],
                'id' => 'trsettingsUpdate',
    ]);
    ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false"
         data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <span class="panel-title"><label style="font-size: 25px; color:#0a0e1b">Setting Logo Text: <?= $model->setting->logoText; ?></label></span>
        </div>

        <div class="panel-body" style="display: block;">
            <div class="clearfix"></div>
            <div class="tab-content row">
                <div class="row">
                    <div class="col-md-12">
                        <?=
                                $form->field($model, 'logoText', ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                        {input}<label for="customer-name" class="field-icon"><i class="fa fa-tags"></i></label></label>{error}</div>'])
                                ->textarea(['maxlength' => true, 'placeholder' => Yii::t('app', 'Logo Text')])->label(false);
                        ?>
                    </div>
                </div>
                <?= $form->field($model, 'settings_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'language_id')->hiddenInput()->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php echo $this->registerJs("
            CKEDITOR.replace('trsitesettings-logotext');
            CKEDITOR.replace('trsitesettings-logodescription');
"); ?>
