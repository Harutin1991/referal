<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrPages */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->registerCssFile("@web/vendors/bootstrap3-wysiwyg/bootstrap3-wysihtml5.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/pages/editor.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/admin-forms.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/filInput.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
?>
<div class="tr-pages-form">

     <?php $form = ActiveForm::begin([
        'action' => ['/tr-pages/update'],
        'id' => 'trpagesUpdate',
    ]); ?>
    
    
    <label style="font-size: 25px; color:#0a0e1b">Page Title:<?= $model->pages->title; ?></label>
    <div class="clearfix"></div>
    <div class="tab-content row">
        <div class="col-md-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
        </div>
        
        <?= $form->field($model, 'language_id')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'pages_id')->hiddenInput()->label(false) ?>
    
        <div class="col-md-6">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>
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

