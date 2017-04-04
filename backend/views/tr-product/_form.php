<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tr-product-form">

    <?php
    $form = ActiveForm::begin([
                'action' => ['/tr-product/update'],
                'id' => 'trproductUpdate',
    ]);
    ?>
    <div class="panel sort-disable mb50" id="p2" data-panel-color="false" data-panel-fullscreen="false"
         data-panel-remove="false" data-panel-title="false">
        <div class="panel-heading">
            <span class="panel-title"><label style="font-size: 25px; color:#0a0e1b">Product Name: <?= $model->product->name; ?></label></span>
        </div>

        <div class="panel-body" style="display: block;">
            <div class="clearfix"></div>
            <div class="tab-content row">
                <div class="col-md-12">
                    <?=
                            $form->field($model, 'name', ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                        {input}<label for="customer-name" class="field-icon"><i class="fa fa-tags"></i></label></label>{error}</div>'])
                            ->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Product Name')])->label(false);
                    ?>
                </div>

            </div>
            <div class="section row " id="category_attributes">
                <?php if (!empty($product_attributes)): ?>
                    <?php foreach ($product_attributes as $attribute): ?>
                        <input type="hidden" value="<?= $attribute['id'] ?>" name="ProductAttribute[attribute_id][]">
                        <div class="col-md-4">
                            <div class="option-group field">
                                <label class="block mt15 option option-primary" for="attribute_<?= $attribute['id'] ?>">
                                    <input type="checkbox" checked="checked" onclick="attributeChecked('<?= $attribute['id'] ?>', this.checked)" name="attribute_checked" id="attribute_<?= $attribute['id'] ?>">
                                    <span class="checkbox"></span> <?= $attribute['name'] ?></label>
                                <div class="form-group">
                                    <input type="text" name="ProductAttribute[value][]" class="form-control" value="<?= $modelProductAttr['value'] ?>" id="attribute_value_<?= $attribute['id'] ?>" placeholder="Attribute Value">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="tab-content row">
                <div class="col-md-6">
                    <?=
                            $form->field($model, 'short_description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                    {input}<label for="customer-name" class="field-icon"><i class="fa fa-comment"></i></label></label>{error}</div>'])
                            ->textarea(['maxlength' => true, 'placeholder' => Yii::t('app', 'Short Description')])->label(false)
                    ?>
                </div>
                <div class="col-md-6">
                    <?=
                            $form->field($model, 'description', ['template' => '<div class="col-md-12" style="padding: 0"><label for="customer-name" class="field prepend-icon">
                                    {input}<label for="customer-name" class="field-icon"><i class="fa fa-comments"></i></label></label>{error}</div>'])
                            ->textarea(['rows' => 6, 'class' => 'form-control', 'placeholder' => Yii::t('app', 'Description')])->label(false)
                    ?>
                </div>
            </div>
            <div class="tab-content row">
                <?= $form->field($model, 'product_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'language_id')->hiddenInput()->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
<?php echo $this->registerJs("
            CKEDITOR.replace('trproduct-short_description');
            CKEDITOR.replace('trproduct-description');
"); ?>
