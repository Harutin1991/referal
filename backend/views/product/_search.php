<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$templatePrice = '<div class="">{label}<div class=""><div class="input-group">
{input}<span class="input-group-addon"><i class="fa fa-euro"></i></span></div>{error}</div></div>';
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id'=>'product-search'
    ]); ?>

    <?= $form->field($model, 'name',
        ['template' => '<label for="productsearch-price" class="field prepend-icon">{input}{label}{error}</label>'])
        ->textInput(['placeholder'=>'Product Name'])->label('<i class="fa fa-tags"></i>', ['class' => 'field-icon']) ?>

    <?= $form->field($model, 'product_sku',
        ['template' => '<label for="productsearch-price" class="field prepend-icon">{input}{label}{error}</label>'])
        ->textInput(['placeholder'=>'Product SKU'])->label('<i class="fa fa-tags"></i>', ['class' => 'field-icon']) ?>

    <div class="section row">
        <div class="col-md-12">
            <?php echo $form->field($model, 'created_date',
                ['template' => '<label for="productsearch-price" class="field prepend-icon">{input}{label}{error}</label>'])
                ->textInput(['class' => 'gui-input','placeholder'=>'0000-00-00'])
                ->label('<i class="fa fa-calendar" aria-hidden="true"></i>', ['class' => 'field-icon']) ?>
        </div>
    </div>
    <?php // echo $form->field($model, 'updated_date') ?>
    <hr class="short">
    <div class="section">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-default btn-sm ph25']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default btn-sm ph25']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
