<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use backend\models\TrAttribute;
use backend\models\ProductImage;
use common\models\Language;
use yii\helpers\Url;

$languages = Language::find()->asArray()->all();

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $product_attribute_model backend\models\ProductAttribute */
/* @var $product_parts_model backend\models\ProductParts */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$template = '<div class="">{label}<div class="">{input}{error}</div></div>';
$templatePrice = '<div class="">{label}<div class=""><div class="input-group">
{input}<span class="input-group-addon"><i class="fa fa-euro"></i></span></div>{error}</div></div>';
if (!$model->isNewRecord) {
    $imagePaths = ProductImage::getImageByProductId($model->id);
    $defaultImage = ProductImage::getDefaultImageIdByProductId($model->id);
    $formId = 'productUpdate';
    $action = '/product/update?id=' . $model->id;
    $tabsName = Yii::t('app', 'Update Product');
} else {
    $formId = 'productCreate';
    $action = '/product/create';
    $tabsName = Yii::t('app', 'Add New Product');
}
?>
<div class="product-form">

    <?= Html::a('Back to product list', ['/product/index'], ['class' => 'btn btn-primary mb15']) ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false" data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <span class="panel-title"><?php echo Yii::t('app', 'Add New product') ?></span>
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
                            <a href="#tab_<?php echo $value['id'] ?>"  data-toggle="tab" onclick="editProductTr(<?php echo $value['id']; ?>,<?php echo $model->id; ?>,<?php echo $value['is_default']; ?>,<?= $defoultId ?>)" disabled="disabled">
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
                <div class="tab-pane" id="tr_product"></div>
                <div class="tab-pane active" id="tab_<?php echo $defoultId; ?>">
                    <?php $form = ActiveForm::begin(['action' => [$action], 'id' => $formId, 'options' => ['enctype' => 'multipart/form-data',]]); ?>
                    <div class="panel-body" style="display: block;">
                        <div class="tab-content pn br-n admin-form">
                            <div class="section row">
                                <div class="col-md-4">
                                    <?=
                                            $form->field($model, 'name', ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                        {input}<label for="customer-name" class="field-icon"><i class="fa fa-tags"></i></label></label>{error}</div>'])
                                            ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Product Name')])->label(false)
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                            $form->field($model, 'route_name', ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                    {input}<label for="customer-name" class="field-icon"><i class="fa fa-euro"></i></label></label>{error}</div>'])
                                            ->textInput(['placeholder' => Yii::t('app', 'Name in route')])->label(false)
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'status', ['template' => $template])->widget(Select2::className(), [
                                        'data' => [Yii::t('app', "Pasive"), Yii::t('app', "Active")],
                                        'language' => Yii::$app->language,
                                        'options' => ['placeholder' => Yii::t('app', 'Select Status ...')],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'multiple' => false,
                                        ],
                                        'pluginLoading' => false,
                                    ])->label(false)
                                    ?>
                                </div>
                            </div>
                            <div class="section row">
                                <div class="col-md-6">
                                    <div class="panel-body clearfix p10 ph15">
                                        <label class="switch ib switch-primary pull-left input-align mt10">
                                            <input type="hidden" name="Product[in_slider]" value="0" />
                                            <input type="checkbox" name="Product[in_slider]"
                                                   id="product-in_slider"
                                                   value="1" <?php echo ($model->in_slider == 1) ? 'checked' : '' ?>>
                                            <label for="product-in_slider" data-on="YES"
                                                   data-off="NO"></label>
                                            <span>Show In Slider</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel-body clearfix p10 ph15">
                                        <label class="switch ib switch-primary pull-left input-align mt10">
                                            <input type="hidden" name="Product[best_seller]" value="0" />
                                            <input type="checkbox" name="Product[best_seller]"
                                                   id="product-best_seller"
                                                   value="1" <?php echo ($model->best_seller == 1) ? 'checked' : '' ?>>
                                            <label for="product-best_seller" data-on="YES"
                                                   data-off="NO"></label>
                                            <span>Best Seller</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="section row">
                                <div class="col-md-6">
                                    <label><?= Yii::t('app', 'Short Description') ?></label>
                                    <?=
                                            $form->field($model, 'short_description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                            ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Short Description')])->label(false)
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <label><?= Yii::t('app', 'Description') ?></label>
                                    <?=
                                            $form->field($model, 'description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="repairer-zip" class="field prepend-icon">
                                    {input}<label for="repairer-zip" class="field-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></label></label>{error}</div>'])
                                            ->textarea(['rows' => 6, 'placeholder' => Yii::t('app', 'Description')])->label(false)
                                    ?>
                                </div>
                            </div>
                            <div class="section row">
                                <div class="col-md-6 pt15">
                                    <label><?= Yii::t('app', 'Image Size'); ?>:(800x600)</label>
                                    <?=
                                            $form->field($model, 'imageFiles[]', ['template' => '<div><div class="box">{input}{label}{error}</div></div>'])
                                            ->fileInput(
                                                    [
                                                        'multiple' => true,
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
                                                <?php if (!empty($imagePaths)) : ?>
                                                    <?php foreach ($imagePaths as $key => $imagePath): ?>
                                                        <div style="display: inline-block;"
                                                             class="mix label1 folder1 <?php
                                                             if (isset($defaultImage[$key]) && $defaultImage[$key] == $key) {
                                                                 echo 'default-view';
                                                             } else {
                                                                 echo '';
                                                             }
                                                             ?>"
                                                             id="image_<?php echo $key ?>">
                                                            <span class="close remove">
                                                                <i class="fa fa-close icon-close"></i>
                                                            </span>
                                                            <div class="panel p6 pbn">
                                                                <div class="of-h">
                                                                    <?php
                                                                    echo Html::img('/uploads/images/product/' . $model->id . '/thumbnail/' . $imagePath, [
                                                                        'class' => 'img-responsive',
                                                                        'title' => $model->name,
                                                                        'alt' => '',
                                                                    ])
                                                                    ?>
                                                                    <div class="row table-layout change_image"
                                                                         data-key="<?php echo $key ?>" product-id="<?= $model->id ?>">
                                                                        <input type="hidden" value="product" id="category">
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
                            echo Html::a(Yii::t('app', 'Reset'), Url::to('/' . Yii::$app->language . '/product/index', true), ['class' => 'btn btn-default btn-sm ph25 reste-button pull-right']);
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
            CKEDITOR.replace('product-short_description');
            CKEDITOR.replace('product-description');
"); ?>
<?php
$this->registerJs("
$('#product-name').on('focusout',function(){
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
   
   $('#product-route_name').val(rout_name);
})
")
?>