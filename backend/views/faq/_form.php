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
    $formId = 'faqUpdate';
    $action = '/faq/update?id=' . $model->id;
} else {
    $formId = 'faqCreate';
    $action = '/faq/create';
}
$this->registerCssFile("@web/vendors/bootstrap3-wysiwyg/bootstrap3-wysihtml5.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/pages/editor.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
?>
<div class="pages-form">
    <?= Html::a('Back to faq list', ['/faq/index'], ['class' => 'btn btn-primary mb15']) ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false"
         data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <span
                class="panel-title"><?php echo ($model->isNewRecord) ? Yii::t('app', 'Add New Faq') : Yii::t('app', 'Update Faq') ?></span>
            <span style="float: left;" class="panel-controls"><a href="#" class="panel-control-loader"></a><a href="#"
                                                                                                              style="margin-left: 5px"
                                                                                                              class="panel-control-collapse"></a></span>
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
                               onclick="editFaqTr(<?php echo $value['id']; ?>,<?php echo $model->id; ?>,<?php echo $value['is_default']; ?>)">
                                <span class="flag-xs flag-<?php echo $value['short_code'] ?>"><?=$value['name']?></span>
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
                <div class="tab-pane" id="tr_faq"></div>

                <div class="tab-pane active" id="tab_<?php echo $defoultId; ?>">
                    <?php
                    $form = ActiveForm::begin([
                                'action' => [$action],
                                'id' => $formId,
                    ]);
                    ?>
                    <div class="tab-content row">
                        <div class="col-md-12">
                            <?=
                                    $form->field($model, 'title', ['template' => '{label}<div class="">{input}{error}</div>'])
                                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Faq Question')])->label(Yii::t('app', 'Faq Question'))
                            ?>
                        </div>
                        <div class="col-md-12">
                            <label><?= Yii::t('app', 'Faq Answer') ?></label>
                            <?=
                                    $form->field($model, 'description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => 'Faq Answer'])->label(false)
                            ?>
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
