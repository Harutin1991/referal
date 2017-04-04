<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Zones */
/* @var $form yii\widgets\ActiveForm */
?>

<?= Html::a('Back to zones list', ['/zones/index'], ['class'=>'btn btn-primary mb15']) ?>
<div class="zones-form panel">

    <div class="panel-heading">
        <ul class="nav panel-tabs-border panel-tabs">
            <li class="active">
                <a href="#tab1_1" data-toggle="tab" aria-expanded="true">  Zone</a>
            </li>
            <?php  if(!$model->isNewRecord){ ?>
            <li class="">
                <a href="#tab1_2" data-toggle="tab" aria-expanded="false"> Countries</a>
            </li>
            <li class="">
                <a href="#tab1_3" data-toggle="tab" aria-expanded="false"> Prices</a>
            </li>
               <?php
                }
            ?>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content pn br-n">
            <div id="tab1_1" class="tab-pane active">
                <div class="row">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <div class="col-md-4">
                        <?= $form->field($model, 'type')->dropDownList(array('Post','UPS Standard','UPS Express')) ?>
                    </div>
                    <div class="clearfix"></div>
                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div id="tab1_2" class="tab-pane">
                <div class="row">
                    <?= $countryForm ?>
                </div>
            </div>
            <div id="tab1_3" class="tab-pane" >
                <div class="row" id="zone_prices">
                    <?= $priceForm ?>
                </div>
            </div>
        </div>
    </div>
</div>
