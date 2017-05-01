<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Language;
use backend\models\TrPakages;

/* @var $this yii\web\View */
/* @var $model backend\models\Pakages */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$languages = Language::find()->asArray()->all();
if (!$model->isNewRecord) {
    $formId = 'packageUpdate';
    $tr_formId = 'TrpackageUpdate';
    $action = '/packages/update?id=' . $model->id;
    $tr_action = '/tr-pakages/update?id=' . $model->id;
} else {
    $formId = 'packageCreate';
    $tr_formId = 'TrpackageCreate';
    $action = '/packages/create';
    $tr_action = '/tr-pakages/create';
}

$this->registerCssFile("@web/vendors/tags/dist/bootstrap-tagsinput.css", [
    'depends' => [backend\assets\AppAsset::className()]]);

$this->registerCssFile("@web/css/pages/todolist.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
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
                                    <div class="panel-heading">
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        $form = ActiveForm::begin([
                                                    'action' => [$action],
                                                    'id' => $formId,
                                                    'options' => ['role' => 'form']
                                        ]);
                                        ?>
                                        <input type="hidden" value="<?= $model->id ?>" id="package_id">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <?=
                                                        $form->field($model, 'title')
                                                        ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => Yii::t('app', 'Package title')])->label(false)
                                                ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <?=
                                                        $form->field($model, 'percent')
                                                        ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => Yii::t('app', 'Package percent')])->label(false)
                                                ?>
                                            </div>
                                            <div class="col-sm-12">
                                                <?=
                                                        $form->field($model, 'price')
                                                        ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => Yii::t('app', 'Package Level Prices'), 'data-role' => "tagsinput"])->label(false)
                                                ?>
                                            </div>
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
                    <?php if (!$model->isNewRecord) { ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="row list_of_items">
                                    <div class="todolist_list showactions">
                                        <div class="col-md-8 col-sm-8 col-xs-12 nopadmar custom_textbox1">
                                            <div class="todotext todoitem"><?= Yii::t('app', 'Package Messages') ?></div>
                                        </div>
                                    </div>
                                    <?php foreach ($packageMessages as $key => $messages): ?>
                                        <div class="todolist_list showactions list<?= $key + 1 ?>" id="todolist_list_<?= $messages['id'] ?>">  
                                            <div class="col-md-8 col-sm-8 col-xs-8 nopadmar custom_textbox1"> 
                                                <div class='todotext todoitemjs'><?= $messages['message'] ?></div> 
                                            </div>
                                            <div class='col-md-4 col-sm-4 col-xs-4  pull-right showbtns todoitembtns'>
                                                <a href='javascript:void(0)' onclick="editMessage('<?=$messages['id']?>')" id="edit_button_<?= $messages['id'] ?>" class='todoedit'><span class='glyphicon glyphicon-pencil'></span></a> | 
                                                <a href='javascript:void(0)' onclick="deleteMessage('<?=$messages['id']?>')" class='tododelete redcolor'><span class='glyphicon glyphicon-trash'></span></a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </form>
                                <div class="todolist_list adds">
                                    <form role="form" id="main_input_box">
                                        <input type="hidden" value="<?= count($packageMessages) ?>" id="message_count">
                                        <div class="col-md-6 col-xs-6">
                                            <input id="custom_textbox" name="Item" type="text" required placeholder="<?=Yii::t('app','Add new message here')?>" class="form-control" />
                                        </div>
                                        <div class="col-md-4 col-xs-4">
                                            <input type="submit" value="<?=Yii::t('app','Add Message')?>" class="btn btn-primary add_button" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php else: ?>
                    <?php
                    $trmodel = TrPakages::findOne(['pakage_id' => $model->id, 'language_id' => $value['id']]);
                    if (!$trmodel) {
                        $trmodel = new TrBlog();
                        $trmodel->language_id = $value['id'];
                        $trmodel->pakage_id = $model->id;
                    }
                    ?>
                    <div id="tab_<?php echo $value['id'] ?>" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <i class="livicon" data-name="doc-portrait" data-c="#fff" data-hc="#fff" data-size="18" data-loop="true"></i>
                                            <?php echo Yii::t('app', 'Translation for') . ' ' . $model->title ?>
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
                                        <?php echo $trform->field($trmodel, 'pakage_id')->hiddenInput(['value' => $model->id])->label(false); ?>
                                        <div class="row">
                                            <?=
                                                    $trform->field($trmodel, 'title')
                                                    ->textInput(['maxlength' => true, 'class' => 'form-control input-lg', 'placeholder' => Yii::t('app', 'Package title') . '...'])->label(false)
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
                                                                $trform->field($trmodel, 'short_description')
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
                                                                $trform->field($trmodel, 'description')
                                                                ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Description')])->label(false)
                                                        ?>
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
        '@web/vendors/tags/dist/bootstrap-tagsinput.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/tinymce/js/tinymce/tinymce.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/pages/editor1.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/todolist.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
