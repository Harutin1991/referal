<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Language;

/* @var $this yii\web\View */
/* @var $model backend\models\Sitesettings */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if (!$model->isNewRecord) {
    $formId = 'sitesettingsUpdate';
    $action = '/sitesettings/update?id=' . $model->id;
} else {
    $formId = 'sitesettingsCreate';
    $action = '/sitesettings/create';
}
$languages = Language::find()->asArray()->all();
?>
<div class="categoyr-form">
    <?= Html::a('Back to settings page', ['/site/index'], ['class' => 'btn btn-primary mb15']) ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false" data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <span class="panel-title"><?php echo Yii::t('app', 'Add New Settings') ?></span>
            <span style="float: left;" class="panel-controls"><a href="#" class="panel-control-loader"></a><a href="#" style="margin-left: 5px" class="panel-control-collapse"></a></span>
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
                            <a href="#tab_<?php echo $value['id'] ?>"  data-toggle="tab" onclick="editSettingsTr(<?php echo $value['id']; ?>,<?php echo $model->id; ?>,<?php echo $value['is_default']; ?>)" disabled="disabled">
                                <span class="flag-xs flag-<?php echo $value['short_code'] ?>"></span>
                            </a>
                        </li>
                        <?php
                    endforeach;
                }
                ?>
            </ul>
        </div>
        <div class="panel-body"  style="display: block;">
            <div class="tab-content pn br-n admin-form">
                <div class="tab-pane" id="tr_settings"></div>
                <div class="tab-pane active" id="setting_default">
                    <?php
                    $form = ActiveForm::begin([
                                'action' => [$action],
                                'id' => $formId,
                    ]);
                    ?>
                    <div class="tab-content row">
                        <div class="col-md-12">
                            <?=
                                    $form->field($model, 'logoText', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Logo Text')])->label(Yii::t('app', 'Logo Bottom Text'))
                            ?>
                        </div>
                    </div>
                    <div class="section row">

                        <div class="col-md-12">
                            <?=
                                    $form->field($model, 'facebook', ['template' => '{label}<div class="">{input}{error}</div>'])
                                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Facebook Link')])->label(Yii::t('app', 'Facebook Link'))
                            ?>
                        </div>
                    </div>
                    <div class="section row">

                        <div class="col-md-12">
                            <?=
                                    $form->field($model, 'google', ['template' => '{label}<div class="">{input}{error}</div>'])
                                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Google Link')])->label(Yii::t('app', 'Google Link'))
                            ?>
                        </div>
                    </div>
                    <div class="section row">

                        <div class="col-md-12">
                            <?=
                                    $form->field($model, 'youtube', ['template' => '{label}<div class="">{input}{error}</div>'])
                                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Youtube Link')])->label(Yii::t('app', 'Youtube Link'))
                            ?>
                        </div>
                    </div>
                    <div class="section row">

                        <div class="col-md-12">
                            <?=
                                    $form->field($model, 'twitter', ['template' => '{label}<div class="">{input}{error}</div>'])
                                    ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Twitter Link')])->label(Yii::t('app', 'Twitter Link'))
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
                            echo Html::a(Yii::t('app', 'Reset'), Url::to('/' . Yii::$app->language . '/category/index', true), ['class' => 'btn btn-default btn-sm ph25 reste-button pull-right']);
                        }
                        ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->registerJs("
            CKEDITOR.replace('sitesettings-logotext');
"); ?>