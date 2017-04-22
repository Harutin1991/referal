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
$this->registerCssFile("@web/vendors/bootstrap3-wysiwyg/bootstrap3-wysihtml5.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/pages/editor.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/admin-forms.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/filInput.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
?>

<?php $form = ActiveForm::begin([
    'action' => [$action],
    'id' => $formId,
]); ?>
    <div class="panel mb25">
        <div class="panel-body p20 pb10">
            <div class="tab-content pn br-n admin-form">
                <div id="tab1_1" class="tab-pane active">
				<div class="row">
                        <div class="col-md-12">
                            <div class="section">
                                <?= $form->field($model, 'title',
                                    ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                                {input}<label for="customer-name" class="field-icon"><i class="fa fa-envelope"></i></label></label>{error}</div>'
                                    ])->textInput(['maxlength' => true, 'placeholder' => Yii::t('app','Title')])->label(false) ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                             <div class="section">
							 <label><?=Yii::t('app','Short Description')?></label>
                                  <?=
                                    $form->field($model, 'short_description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => Yii::t('app','Short Description')])->label(Yii::t('app','Short Description'))
                                     ?>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-12">
                             <div class="section">
							<label><?=Yii::t('app','Description')?></label>
                                  <?=
                                    $form->field($model, 'description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => Yii::t('app','Description')])->label(Yii::t('app','Description'))
                                     ?>
                            </div>
                        </div>
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
$this->registerJsFile(
        '@web/vendors/livicons/minified/raphael-min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/vendors/livicons/minified/livicons-1.4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/vendors/ckeditor/ckeditor.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/vendors/ckeditor/adapters/jquery.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/vendors/ckeditor/config.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/pages/editor1.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

