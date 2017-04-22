<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use common\models\Language;
use yii\widgets\Pjax;

$languages = Language::find()->asArray()->all();

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if (!$model->isNewRecord) {
    $formId = 'pagesUpdate';
    $action = '/pages/update?id=' . $model->id;
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
    <h1><?=Yii::t('app','Parent Page')?> : <?=$parentPage[0]['title']?></h1>
    <?= Html::a(Yii::t('app','Back to page list'), ['pages/sub-pages?id='.$parentPage[0]['pages_id']], ['class' => 'btn btn-primary mb15']) ?>
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
                    <?=$form->field($model, 'parent_id')->hiddenInput(['value' => $model->parent_id])->label(false); ?>
                    <div class="tab-content row">
                        <div class="col-md-12">
                            <?=
                                    $form->field($model, 'title', ['template' => '{label}<div class="">{input}{error}</div>'])
                                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Page Title')])->label(false)
                            ?>
                        </div>
                        <div class="col-md-12">
                            <label><?= Yii::t('app', 'Short Description') ?></label>
                            <?=
                                    $form->field($model, 'short_description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => 'Short Description'])->label(false)
                            ?>
                        </div>
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

                    </div>

                    <div class="form-group col-md-12">
                        <?=
                        Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
                            'class' => $model->isNewRecord ? 'btn btn-sm btn-primary pull-right ' : 'btn btn-sm btn-success pull-right',
                            'id' => $formId,
                            'type' => 'button'
                        ])
                        ?>
                        <?php
                        if (!$model->isNewRecord) {
                            echo Html::a(Yii::t('app', 'Reset'), Url::to('/' . Yii::$app->language . '/brand/index', true), ['class' => 'btn btn-default btn-sm ph25 reste-button pull-right']);
                        }
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

