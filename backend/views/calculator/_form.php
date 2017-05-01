<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Language;
use backend\models\Files;
use backend\models\TrCalculator;

$languages = Language::find()->asArray()->all();
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
    $formId = 'calculatorUpdate';
    $action = '/calculator/update?id=' . $model->id;
    $tr_action = 'tr-calculator/update' . $model->id;
    $tr_formId = 'TrCalculatorUpdate';
    $defaultImage = Files::getDefaultImageIdByProductId($model->id, 'calculator');
} else {
    $formId = 'calculatorCreate';
    $action = '/calculator/create';
    $tr_action = 'tr-calculator/create';
    $tr_formId = 'TrCalculatorCreate';
}
?>
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs" style='margin-left: 17px;'>
            <?php if (!$model->isNewRecord) { ?>
                <?php foreach ($languages as $value): ?>
                    <li class="<?php
                    if ($value['is_default']) {
                        $defoultId = $value['id'];
                        echo 'active';
                    }
                    ?>">
                        <a href="#tab_<?php echo $value['id'] ?>"  data-toggle="tab" >
                            <span class="flag-xs flag-<?php echo $value['short_code'] ?>"><?php echo $value['name'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php } ?>
        </ul>
        <div  class="tab-content mar-top">
            <?php foreach ($languages as $value): ?>
                <?php if ($value['is_default']): ?>
                    <div id="tab_<?php echo $value['id'] ?>" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                    <div class="panel-body">
                                        <?php
                                        $form = ActiveForm::begin([
                                                    'action' => [$action],
                                                    'id' => $formId,
                                                    'options' => ['role' => 'form']
                                        ]);
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?=
                                                        $form->field($model, 'title')
                                                        ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => Yii::t('app', 'Calculator Paragraph')])->label(false)
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="panel panel-success">
                                                <div class="panel-heading">
                                                    <div class="text-muted bootstrap-admin-box-title editor-clr">
                                                        <h3 class="panel-title"><i class="livicon" data-name="thermo-down" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                                            <?= Yii::t('app', 'Short Description') ?></h3>
                                                    </div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <?=
                                                            $form->field($model, 'short_description')
                                                            ->textarea(['maxlength' => true, 'placeholder' => Yii::t('app', 'Short Description')])->label(false)
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 pt15" style="margin-left: -14px;">
                                                    <label><?= Yii::t('app', 'Upload image') ?>(285x165)</label>
                                                    <?=
                                                            $form->field($modelFiles, 'path[]', ['template' => '<div><div class="box">{input}{label}{error}</div></div>'])
                                                            ->fileInput(
                                                                    [
                                                                        'multiple' => false,
                                                                        'accept' => 'image/*',
                                                                        'onchange' => 'showMyImage(this, -1)',
                                                                        'class' => 'inputfile inputfile-6',
                                                                        'data-multiple-caption' => "{count} files selected",
                                                            ])->label('<span></span> <strong class="btn btn-primary btn-file"><i class="glyphicon glyphicon-folder-open"></i>&ensp;Brows…</strong>', ['class' => false])
                                                    ?>
                                                    <div class="hidden" id="defaultimg">
                                                        <input type="radio" id="def_img_part_-1" name="defaultImage" value=""
                                                               class="hidden"/>
                                                    </div>
                                                    <div class="col-md-12 pt15" id="selectedFiles_-1">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
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
                                                                                <i class="fa fa-close icon-close-materials icon-close-earn"></i>
                                                                            </span>
                                                                            <div class="panel p6 pbn">
                                                                                <div class="of-h">
                                                                                    <?php
                                                                                    echo Html::img('/uploads/images/calculator/' . $model->id . '/' . $imagePath['path'], [
                                                                                        'class' => 'img-responsive',
                                                                                        'title' => $model->id,
                                                                                        'alt' => '',
                                                                                    ])
                                                                                    ?>
                                                                                    <div class="row table-layout change_image"
                                                                                         data-key="<?php echo $imagePath['id'] ?>" product-id="<?= $model->id ?>">
                                                                                        <input type="hidden" value="how-to-earn" id="category">
                                                                                        <div class="col-xs-8 va-m pln">
                                                                                            <h6><?= $model->id . '.jpg' ?></h6>
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

                                        </div>
                                        <!-- /.col-sm-4 -->
                                        <div class="form-group col-md-12">
                                            <?=
                                            Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), [
                                                'class' => $model->isNewRecord ? 'btn btn-success pull-left ' : 'btn btn-success pull-left',
                                                'id' => "button_" . $formId,
                                                'type' => 'button'
                                            ])
                                            ?>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php
                    $trmodel = TrCalculator::findOne(['calculator_id' => $model->id, 'language_id' => $value['id']]);
                    if (!$trmodel) {
                        $trmodel = new TrCalculator();
                        $trmodel->language_id = $value['id'];
                        $trmodel->calculator_id = $model->id;
                    }
                    ?>
                    <div id="tab_<?php echo $value['id'] ?>" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i>
                                            <?php echo Yii::t('app', 'Translation') ?>
                                        </h3>
                                        <span class="pull-right">
                                            <i class="fa fa-fw fa-chevron-up clickable"></i>
                                            <i class="fa fa-fw fa-times removepanel clickable"></i>
                                        </span>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        $trform = ActiveForm::begin([
                                                    'action' => [$tr_action],
                                                    'id' => $tr_formId,
                                                    'options' => ['role' => 'form']
                                        ]);
                                        ?>
                                        <?php echo $trform->field($trmodel, 'language_id')->hiddenInput(['value' => $value['id']])->label(false); ?>
                                        <?php echo $trform->field($trmodel, 'calculator_id')->hiddenInput(['value' => $model->id])->label(false); ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?=
                                                        $form->field($model, 'title')
                                                        ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => Yii::t('app', 'Calculator Paragraph')])->label(false)
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading">
                                                            <div class="text-muted bootstrap-admin-box-title editor-clr">
                                                                <h3 class="panel-title"><i class="livicon" data-name="thermo-down" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                                                    <?= Yii::t('app', 'Short Description') ?></h3>
                                                            </div>
                                                        </div>
                                                        <div class="bootstrap-admin-panel-content">
                                                            <?=
                                                                    $trform->field($trmodel, 'short_description')
                                                                    ->textarea(['maxlength' => true, 'placeholder' => Yii::t('app', 'Short Description')])->label(false)
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- /.col-sm-8 -->

                                            <!-- /.col-sm-4 -->
                                            <div class="form-group col-md-12">
                                                <?=
                                                Html::submitButton($trmodel->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), [
                                                    'class' => $trmodel->isNewRecord ? 'btn btn-success pull-left ' : 'btn btn-success pull-left',
                                                    'id' => $formId,
                                                    'type' => 'button'
                                                ])
                                                ?>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
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