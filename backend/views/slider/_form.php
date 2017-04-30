

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Language;
use kartik\select2\Select2;
use backend\models\Files;

$languages = Language::find()->asArray()->all();


/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/vendors/bootstrap3-wysiwyg/bootstrap3-wysihtml5.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/pages/editor.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/pages/blog.css", [
    'depends' => [backend\assets\AppAsset::className()]]);

/* * *Image Upload* */
$this->registerCssFile("@web/css/pages/blueimp-gallery.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/vendors/jQuery-File-Upload/css/jquery.fileupload.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/vendors/jQuery-File-Upload/css/jquery.fileupload-ui.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/vendors/jQuery-File-Upload/css/jquery.fileupload-noscript.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/vendors/jQuery-File-Upload/css/jquery.fileupload-ui-noscript.css", [
    'depends' => [backend\assets\AppAsset::className()]]);

$this->registerCssFile("@web/css/admin-forms.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/filInput.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
?>
<?php
if (!$model->isNewRecord) {
    $formId = 'sliderUpdate';
    $action = '/slider/update?id=' . $model->id;

    $defaultImage = Files::getDefaultImageIdByProductId($model->id, 'materials');
} else {
    $formId = 'sliderCreate';
    $action = '/slider/create';
}
?>
<div class="categoyr-form">
    <?= Html::a('Back to slider list', ['/slider/index'], ['class' => 'btn btn-primary mb15']) ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false" data-panel-remove="false" data-panel-title="false">
        <div class="panel-body"  style="display: block;">
            <div class="tab-content pn br-n admin-form">
                <div class="tab-pane active">
                    <?php
                    $form = ActiveForm::begin([
                                'action' => [$action],
                                'id' => $formId,
                                'options' => ['enctype' => 'multipart/form-data']
                    ]);
                    ?>
                    <div class="tab-content row">
                        <div class="col-md-6">
                            <?=
                                    $form->field($model, 'title', ['template' => '{label}<div class="">{input}{error}</div>'])
                                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Slider Title')])->label(false)
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?=
                                    $form->field($model, 'link', ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                    {input}<label for="customer-name" class="field-icon"><i class="fa fa-euro"></i></label></label>{error}</div>'])
                                    ->textInput(['placeholder' => Yii::t('app', 'Slider Link')])->label(false)
                            ?>

                        </div>
                    </div>
                    <div class="section row">
                        <div class="col-md-12">
                            <labe><?= Yii::t('app', 'Short Description') ?></labe>
                            <?=
                            $form->field($model, 'short_description')->textarea(['rows' => 6])->label(false)
                            ?>
                        </div>
                    </div>
                    <div class="section row">
                        <div class="col-md-6 pt15">
                            <label><?= Yii::t('app', 'Image Size'); ?>:(1350x570)</label>
                            <?=
                                    $form->field($modelFiles, 'path[]', ['template' => '<div><div class="box">{input}{label}{error}</div></div>'])
                                    ->fileInput(
                                            [
                                                'multiple' => false,
                                                'accept' => 'image/*',
                                                'onchange' => 'showMyImage(this, -1)',
                                                'class' => 'inputfile inputfile-6',
                                                'data-multiple-caption' => "{count} files selected",
                                    ])->label('<span></span> <strong class="btn btn-primary btn-file"><i class="glyphicon glyphicon-folder-open"></i>&ensp;Brows…</strong>', ['class' => ''])
                            ?>

                        </div>
                    </div>

                    <div class="section row">
                        <div class="hidden" id="defaultimg">
                            <input type="radio" id="def_img_part_-1" name="defaultImage" value=""
                                   class="hidden"/>
                        </div>
                        <div class="col-md-12 pt15" id="selectedFiles_-1">

                        </div>
                    </div>
                    <?php if (!$model->isNewRecord): ?>
                        <div class="col-md-6 pl15 pull-right">
                            <div class="gallery-page sb-l-o sb-r-c onload-check">
                                <div class="">
                                    <div id="mix-container">
                                        <div class="fail-message">
                                            <span><?php echo Yii::t('app', 'No images were found for the selected product') ?></span>
                                        </div>

                                        <?php if (!empty($imagePaths)) : ?>
                                            <?php foreach ($imagePaths as $key => $imagePath): ?>
                                                <div style="display: inline-block;"
                                                     class="mix label1 folder1 <?php
                                                     if ($imagePath['top']) {
                                                         echo 'default-view';
                                                     } else {
                                                         echo '';
                                                     }
                                                     ?>"
                                                     id="image_<?php echo $imagePath['id'] ?>">
                                                    <span class="close remove">
                                                        <i class="fa fa-close icon-close-slider"></i>
                                                    </span>
                                                    <div class="panel p6 pbn">
                                                        <div class="of-h">
                                                            <?php
                                                            echo Html::img('/uploads/images/slider/' . $model->id . '/' . $imagePath['path'], [
                                                                'class' => 'img-responsive',
                                                                'title' => $model->title,
                                                                'alt' => '',
                                                            ])
                                                            ?>
                                                            <div class="row table-layout change_image"
                                                                 data-key="<?php echo $imagePath['id'] ?>" product-id="<?= $model->id ?>">
                                                                <input type="hidden" value="slider" id="category">
                                                                <div class="col-xs-8 va-m pln">
                                                                    <h6><?= $model->title . '.jpg' ?></h6>
                                                                </div>
                                                                <div
                                                                    class="col-xs-4 text-right va-m prn">
                                                                    <span
                                                                        class="fa fa-eye-slash fs12 text-muted"></span>
                                                                    <span
                                                                        class="fa fa-circle fs10 text-info ml10"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <div class="gap"></div>
                                        <div class="gap"></div>
                                        <div class="gap"></div>
                                        <div class="gap"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                    <div class="form-group col-md-12">
                        <?=
                        Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
                            'class' => $model->isNewRecord ? 'btn btn-sm btn-primary pull-right ' : 'btn btn-sm btn-success pull-right',
                            'id' => $formId,
                            'type' => 'button'
                        ])
                        ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJsFile(
        '@web/js/tinymce/js/tinymce/tinymce.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/pages/editor1.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>