<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Contactus */
/* @var $form yii\widgets\ActiveForm */
if (!$model->isNewRecord) {
    $formId = 'contactusUpdate';
    $action = '/contactus/update?id=' . $model->id;
 
} else {
    $formId = 'contactusCreate';
    $action = '/contactus/create';
}
?>

<?php $form = ActiveForm::begin([
    'action' => [$action],
    'id' => $formId,
]); ?>
    <div class="panel mb25">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"><?php echo Yii::t('app','Add New Contact US')?></span>
            <ul class="nav panel-tabs-border panel-tabs">
                <li class="active">
                    <a href="#tab1_1" data-toggle="tab"><?php echo Yii::t('app','Contact US')?></a>
                </li>
            </ul>
        </div>
        <div class="panel-body p20 pb10">
            <div class="tab-content pn br-n admin-form">
                <div id="tab1_1" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-4">
                             <div class="section">
                                <?= $form->field($model, 'phone',
                                    ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                            {input}<label for="customer-name" class="field-icon"><i class="fa fa-phone"></i></label></label>{error}</div>'
                                    ])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app','Phone')])->label(false) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <?= $form->field($model, 'mobile_phone',
                                    ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                            {input}<label for="customer-name" class="field-icon"><i class="fa fa-phone"></i></label></label>{error}</div>'
                                    ])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app','Mobile Phone')])->label(false) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <?= $form->field($model, 'email',
                                    ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                                {input}<label for="customer-name" class="field-icon"><i class="fa fa-envelope"></i></label></label>{error}</div>'
                                    ])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app','Email')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="section">
                                <?= $form->field($model, 'fax',
                                    ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                                {input}<label for="customer-name" class="field-icon"><i class="fa fa-envelope"></i></label></label>{error}</div>'
                                    ])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app','Fax')])->label(false) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <?= $form->field($model, 'coordinate',
                                    ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                                {input}<label for="customer-name" class="field-icon"><i class="fa fa-envelope"></i></label></label>{error}</div>'
                                    ])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app','Coordinate longitude')])->label(false) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <?= $form->field($model, 'coordinate',
                                    ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                                {input}<label for="customer-name" class="field-icon"><i class="fa fa-envelope"></i></label></label>{error}</div>'
                                    ])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app','Coordinate latitude')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <div class="form-group col-md-12">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-sm btn-primary pull-right ' : 'btn btn-sm btn-success pull-right ']) ?>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end() ?>
<?php
echo $this->registerJs("
jQuery(document).ready(function () {
$('#contactus-phone').mask('99-99-9999-9999');
$('#contactus-mobile_phone').mask('+33 9 99 99 99 99');
})
") ?>

