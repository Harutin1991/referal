<?php

use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
//var_dump($countries); die;
?>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<h3>Address</h3>
<?php $form = ActiveForm::begin(['options' => ['class' => 'col-xs-12']]) ?>
<div class="clearfix"></div>
<ul>
    <li>Country
        <div class="select-country">
            <?=
                                    $form->field($model, 'country', ['template' => '{input}{error}'])->widget(Select2::className(), [
                                        'data' => $countries,
                                        'language' => Yii::$app->language,
                                        'options' => ['placeholder' => Yii::t('app', "Choose your country") . '...', 'id' => 'gender'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'multiple' => false
                                        ],
                                    ])->label(Yii::t('app', 'Select Gender'))
                                    ?>
        </div>
    </li>

    <li>City <span data-name="city" data-type="adrress"><?= $model->city; ?></span></li>
    <li>Address <span data-name="address" data-type="adrress"><?= $model->address; ?></span></li>
    <li>Zip/Postal Code  <span data-name="postal" data-type="adrress"><?= $model->postal; ?></span></li>

</ul>
<?php ActiveForm::end() ?>
</div>