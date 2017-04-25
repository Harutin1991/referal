<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use common\models\Language;
use yii\widgets\Pjax;
use backend\models\Pages;
$languages = Language::find()->asArray()->all();

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$subPage = [];
if (!$model->isNewRecord) {
    $formId = 'pagesUpdate';
    $action = '/pages/update?id=' . $model->id;
	$subId = Yii::$app->request->get('id');
	$subPage = Pages::find()->where(['id'=>$subId])->asArray()->all();
} else {
    $formId = 'pagesCreate';
    $action = '/pages/create';
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
<div class="pages-form">
    <?= Html::a(Yii::t('app', 'Back to page list'), ['/pages/index'], ['class' => 'btn btn-primary mb15']) ?>
    <?php if (!$model->isNewRecord): ?>
        <?= Html::a('<span class="fa fa-plus-circle"></span>' . Yii::t('app', 'Create Sub Page'), ['/pages/create-subpage?id=' . $model->id], ['class' => 'btn btn-success mb15 pull-right']) ?>
        <?php
        if (isset($subpagesCount) && $subpagesCount > 0) {
            echo Html::a('<span class="fa fa-eye-slash"></span>' . Yii::t('app', 'Show Sub Pages'), ['/pages/sub-pages?id=' . $model->id], ['class' => 'btn btn-primary mb15 pull-right', 'style' => 'margin-right: 5px;']);
        }
        ?>
    <?php endif; ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false"
         data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <ul class="nav panel-tabs-border panel-tabs">
                <?php
                if (!$model->isNewRecord) {
                    foreach ($languages as $value):
                        ?>
                        <li class="<?php
                        if ($value['is_default']) {
                            $defoultId = $value['id'];
                            echo 'active';
                        }
                        ?>">
                            <a href="#tab_<?php echo $value['id'] ?>" data-toggle="tab"
                               onclick="editPagesTr(<?php echo $value['id']; ?>,<?php echo $model->id; ?>,<?php echo $value['is_default']; ?>)">
                                <span class="flag-xs flag-<?php echo $value['short_code'] ?>"><?php echo $value['name'] ?></span>
                            </a>
                        </li>
                        <?php
                    endforeach;
                }
                ?>
            </ul>
        </div>

        <div class="panel-body" style="display: block;">
            <div class="tab-content pn br-n admin-form">
                <div class="tab-pane" id="tr_pages"></div>
                <div class="tab-pane active" id="tab_<?php echo $defoultId; ?>">
                    <?php
                    $form = ActiveForm::begin([
                                'action' => [$action],
                                'id' => $formId,
                    ]);
                    ?>
                    <?= $form->field($model, 'parent_id')->hiddenInput(['value' => $model->parent_id])->label(false); ?>
                    <div class="tab-content row">
                        <div class="col-md-12">
                            <?=
                                    $form->field($model, 'title', ['template' => '{label}<div class="">{input}{error}</div>'])
                                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Page Title')])->label(false)
                            ?>
                        </div> 
						<?php if(!empty($subPage) && !is_null($subPage[0]['parent_id'])):?>
						<div class="col-md-12">
                            <label><?= Yii::t('app', 'Short Description') ?></label>
                            <?=
                                    $form->field($model, 'short_description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => 'Short Description'])->label(false)
                            ?>
                        </div>
						<?php endif;?>
                        <div class="col-md-12">
                            <label><?= Yii::t('app', 'Page Content') ?></label>
                            <?=
                                    $form->field($model, 'content', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => 'Page Content'])->label(false)
                            ?>
                        </div>
                        <div class="form-group">

                            <div class="col-md-6 pt15">
                                <label><?= Yii::t('app', 'Upload Image') ?></label>
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
                                                                <i class="fa fa-close icon-close-materials icon-close-page"></i>
                                                            </span>
                                                            <div class="panel p6 pbn">
                                                                <div class="of-h">
                                                                    <?php
                                                                    echo Html::img('/uploads/images/pages/' . $model->id . '/' . $imagePath['path'], [
                                                                        'class' => 'img-responsive',
                                                                        'title' => $model->title,
                                                                        'alt' => '',
                                                                    ])
                                                                    ?>
                                                                    <div class="row table-layout change_image"
                                                                         data-key="<?php echo $imagePath['id'] ?>" product-id="<?= $model->id ?>">
                                                                        <input type="hidden" value="blog" id="category">
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

                        </div>
                    </div>

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
$this->registerJs("
$('#pages-title').on('focusout',function(){
   var rout_name = $(this).val();
   rout_name = rout_name.replace(/[^\w\s\-\d]/gi, '')
   var splBy = rout_name.split('-');
        splBy = splBy.filter(String);
      rout_name = splBy.join(' ');
   var rout_nameArray = rout_name.match(/[A-Z]*[^A-Z]+/g);
   for(var i = 0; i < rout_nameArray.length; i++){
        var splByspace = rout_nameArray[i].split(' ');
        splByspace = splByspace.filter(String);
        var str = splByspace.join('-'),
        str = str.replace(/^\-{1,}|\-{1,}$/,'');
        rout_nameArray[i]= str;
   }
   rout_name = rout_nameArray.join('-').toLowerCase()
   
   $('#pages-route_name').val(rout_name);
})
")
?>
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


