<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use common\models\Language;
use yii\widgets\Pjax;
use backend\models\Files;
$languages = Language::find()->asArray()->all();
/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>
<?php if (!$model->isNewRecord) {
    $formId = 'brandUpdate';
    $action = '/brand/update?id=' . $model->id;
    $defaultImage = Files::getDefaultImageIdByProductId($model->id,'brand');

} else {
    $formId = 'brandCreate';
    $action = '/brand/create';
}
?>
<div class="repairs-form">
    <?= Html::a('Back to brand list', ['/brand/index'], ['class'=>'btn btn-primary mb15']) ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false" data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <span class="panel-title"><?php echo ($model->isNewRecord)?Yii::t('app', 'Add New Brand'):Yii::t('app', 'Update Brand')?></span>
            <span style="float: left;" class="panel-controls"><a href="#" class="panel-control-loader"></a><a href="#" style="margin-left: 5px" class="panel-control-collapse"></a></span>
            <ul class="nav panel-tabs-border panel-tabs">

                <?php  if(!$model->isNewRecord){
                    foreach($languages as $value): ?>
                        <li class="<?php if($value['is_default']){$defoultId =$value['id']; echo 'active';}?>">
                            <a href="#tab_<?php echo $value['id']?>"  data-toggle="tab" onclick="editBrandTr(<?php echo $value['id'];?>,<?php echo $model->id; ?>,<?php echo $value['is_default']; ?>)" >
                                <span class="flag-xs flag-<?php echo $value['short_code']?>"></span>
                            </a>
                        </li>
                    <?php endforeach;
                }
                ?>
            </ul>
        </div>
        <div class="panel-body"  style="display: block;">
            <div class="tab-content pn br-n admin-form">
                <div class="tab-pane" id="tr_brand"></div>
                <div class="tab-pane active" id="tab_<?php echo $defoultId;?>">
                    <?php $form = ActiveForm::begin([
                        'action' => [$action],
                        'id' => $formId,
                        'options' => ['enctype' => 'multipart/form-data']
                    ]); ?>
                    <div class="tab-content row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'name', ['template' => '{label}<div class="">{input}{error}</div>'])
                                ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Brand Name')])->label(false) ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?php $model->status = 1; ?>
                            <?= $form->field($model, 'status')->widget(Select2::className(), [
                                'data' => [Yii::t('app', "Pasive"), Yii::t('app', "Active")],
                                'language' => Yii::$app->language,
                                'options' => ['placeholder' => Yii::t('app', 'Select Status ...')],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'multiple' => false,
                                    'selected' => ['1'],
                                ],
                                'pluginLoading'=>false,
                            ])->label(false) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'website_link', ['template' => '{label}<div class="">{input}{error}</div>'])
                                ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Brand\'s website')])->label(false) ?>
                        </div>

                    </div>
                    <div class="section row">
                        <div class="col-md-6">
                            <?=
                                    $form->field($model, 'short_description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Short Description')])->label(false)
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?=
                                    $form->field($model, 'description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                    ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Description')])->label(false)
                            ?>
                        </div>
                    </div>
                    <div class="section row">
                        <div class="col-md-6 pt15">
                            <?=
                                    $form->field($modelFiles, 'path', ['template' => '<div><div class="box">{input}{label}{error}</div></div>'])
                                    ->fileInput(
                                            [
                                                'multiple' => false,
                                                'accept' => 'image/*',
                                                'onchange' => 'showMyImage(this, -1)',
                                                'class' => 'inputfile inputfile-6',
                                                'data-multiple-caption' => "{count} files selected",
                                    ])->label('<span></span> <strong class="btn btn-primary btn-file"><i class="glyphicon glyphicon-folder-open"></i>&ensp;Brows…</strong>', ['class' => ''])
                            ?>
                            <div class="hidden" id="defaultimg">
                                <input type="radio" id="def_img_part_-1" name="defaultImage" value=""
                                       class="hidden"/>
                            </div>
                            <div class="col-md-12 pt15" id="selectedFiles_-1">

                            </div>
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

                                        <?php  if (!empty($imagePaths)) : ?>
                                            <?php foreach ($imagePaths as $key => $imagePath): ?>
                                                <div style="display: inline-block;"
                                                     class="mix label1 folder1 default-view"
                                                     id="image_<?php echo $imagePath['id'] ?>">
                                                    <span class="close remove">
                                                        <i class="fa fa-close icon-close-brand"></i>
                                                    </span>
                                                    <div class="panel p6 pbn">
                                                        <div class="of-h">
                                                            <?php
                                                            echo Html::img('/uploads/images/brand/' .$model->id.'/'. $imagePath['path'], [
                                                                'class' => 'img-responsive',
                                                                'title' => $model->name,
                                                                'alt' => '',
                                                            ])
                                                            ?>
                                                            <div class="row table-layout change_image"
                                                                 data-key="<?php echo $imagePath['id'] ?>">
                                                                <div class="col-xs-8 va-m pln">
                                                                    <h6><?= $model->name . '.jpg' ?></h6>
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
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
                            [
                                'class' => $model->isNewRecord ? 'btn btn-sm btn-primary pull-right ' : 'btn btn-sm btn-success pull-right',
                                'id' => $formId,
                                'type' => 'button'
                            ]) ?>
                        <?php if (!$model->isNewRecord) {
                            echo Html::a(Yii::t('app', 'Reset'), Url::to('/' . Yii::$app->language . '/brand/index', true), ['class' => 'btn btn-default btn-sm ph25 reste-button pull-right']);
                        } ?>
                    </div>
                        <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>

</div>
<?php echo $this->registerJs("
            CKEDITOR.replace('brand-short_description');
            CKEDITOR.replace('brand-description');
"); ?>
