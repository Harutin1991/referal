<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserAvatars */
/* @var $form yii\widgets\ActiveForm */
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
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?=Yii::t('app','Upload User Avatar')?>
            </div>
            <div class="panel-body">

                <?php $form = ActiveForm::begin(); ?>

                <div class="form-group">
                    <div class="col-md-6 pt15" style="margin-left: -14px;">
                        <label><?= Yii::t('app', 'Upload image') ?>(300x300)</label>
                        <?=
                                $form->field($model, 'path[]', ['template' => '<div><div class="box">{input}{label}{error}</div></div>'])
                                ->fileInput(
                                        [
                                            'multiple' => true,
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
                                                     class="mix label1 folder1"
                                                     id="image_<?php echo $imagePath['id'] ?>">
                                                    <span class="close remove">
                                                        <i class="fa fa-close icon-close-materials icon-close-avatars"></i>
                                                    </span>
                                                    <div class="panel p6 pbn">
                                                        <div class="of-h">
                                                            <?php
                                                            echo Html::img('/uploads/images/user_avatars/' . $model->id . '/' . $imagePath['path'], [
                                                                'class' => 'img-responsive',
                                                                'title' => $model->id,
                                                                'alt' => '',
                                                            ])
                                                            ?>
                                                            <div class="row table-layout change_image"
                                                                 data-key="<?php echo $imagePath['id'] ?>" product-id="<?= $model->id ?>">
                                                                <input type="hidden" value="user-avatars" id="category">
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

                <div class="form-group col-md-12">
                    <?=
                    Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), [
                        'class' => $model->isNewRecord ? 'btn btn-success pull-right ' : 'btn btn-success pull-right',
                        'type' => 'button'
                    ])
                    ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
