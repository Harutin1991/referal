<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use backend\models\BlogCategories;
use dosamigos\fileupload\FileUpload;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */
/* @var $form yii\widgets\ActiveForm */


if (!$model->isNewRecord) {
    $formId = 'blogUpdate';
    $action = '/blog/update?id=' . $model->id;
    $categories = BlogCategories::find()->where(['!=', 'id', $model->id])->select(['title', 'id'])->asArray()->all();
    $categoryDropDown = [];
    foreach ($categories as $category) {
        $categoryDropDown[$category['id']] = $category['title'];
    }
} else {
    $formId = 'blogCreate';
    $action = '/blog/create';
    $categories = BlogCategories::find()->select(['title', 'id'])->asArray()->all();
    $categoryDropDown = [];
    foreach ($categories as $category) {
        $categoryDropDown[$category['id']] = $category['title'];
    }
}
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
<div class="paddingleft_right15">
    <div class="blog-form">
        <div class="the-box no-border">
            <?php
            $form = ActiveForm::begin([
                        'action' => [$action],
                        'id' => $formId,
                        'options' => ['role' => 'form']
            ]);
            ?>
            <?php echo $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false); ?>

            <div class="row">
                <div class="col-sm-12">
                    <?=
                            $form->field($model, 'title')
                            ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => Yii::t('app', 'Post title here') . '...'])->label(false)
                    ?>
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
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title editor-clr">
                                    <h3 class="panel-title"><i class="livicon" data-name="thermo-down" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                        <?= Yii::t('app', 'Description') ?></h3>
                                </div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <?=
                                        $form->field($model, 'description')
                                        ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Description')])->label(false)
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="text-muted bootstrap-admin-box-title editor-clr">
                                    <h3 class="panel-title"><i class="livicon" data-name="thermo-down" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                        <?= Yii::t('app', 'Meta Description') ?></h3>
                                </div>
                            </div>
                            <div class="bootstrap-admin-panel-content">
                                <?=
                                        $form->field($model, 'meta_description')
                                        ->textarea(['maxlength' => true, 'placeholder' => Yii::t('app', 'Meta Description')])->label(false)
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- /.col-sm-8 -->
                <div class="col-sm-12">
                    <div class="form-group">
                        <?=
                        $form->field($model, 'blog_category_id')->widget(Select2::className(), [
                            'data' => $categoryDropDown,
                            'language' => Yii::$app->language,
                            'options' => ['placeholder' => 'Select Category ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => false
                            ],
                        ])->label(Yii::t('app', 'Post Category'))
                        ?>
                    </div>
                    <div class="form-group">
                        <?=
                        $form->field($model, 'status')->widget(Select2::className(), [
                            'data' => ["Pasive", "Active"],
                            'language' => Yii::$app->language,
                            'options' => ['placeholder' => 'Select Status ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'multiple' => false
                            ],
                        ])->label(Yii::t('app', 'Select Status'))
                        ?>
                    </div>
                    <div class="form-group">
                        <?=
                                $form->field($model, 'meta_key')
                                ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Meta Key')])->label(Yii::t('app', 'Meta Key'))
                        ?>
                    </div>
                    <div class="form-group">
                        
                        <div class="col-md-6 pt15">
                            <label>Featured image</label>
                            <?=
                                    $form->field($modelFiles, 'filename[]', ['template' => '<div><div class="box">{input}{label}{error}</div></div>'])
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

                </div>
                <!-- /.col-sm-4 -->
                <div class="form-group col-md-12">
                    <?=
                    Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save and post') : Yii::t('app', 'Update'), [
                        'class' => $model->isNewRecord ? 'btn btn-success pull-left ' : 'btn btn-success pull-left',
                        'id' => $formId,
                        'type' => 'button'
                    ])
                    ?>
                    <?php
                    if (!$model->isNewRecord) {
                        echo Html::a(Yii::t('app', 'Reset'), Url::to('/' . Yii::$app->language . '/blog/index', true), ['class' => 'btn btn-default btn-sm ph25 reste-button pull-left']);
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->
            <?php ActiveForm::end(); ?>
        </div>
    </div>
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