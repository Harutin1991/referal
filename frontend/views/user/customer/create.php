<?php

use yii\bootstrap\ActiveForm;

//var_dump($countries); die;
?>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
<h3>Address</h3>

<?php $form = ActiveForm::begin(['options' => ['class' => 'col-xs-12']]) ?>
<div class="clearfix"></div>
<?=
        $form->field($model, 'country', ['template' => '<div class="col-xs-4">{label}</div><div class="col-xs-8">{input}{error}</div>'])
        ->dropDownList($countries, ['prompt' => 'Choose your country...', "class" => "form-control", 'required' => true])
?>

    <div class="clearfix"></div>
    <?=
            $form->field($model, 'city', ['template' => '<div class="form-group">
                        <fieldset class="form-fieldset ui-input">
                            {input}
                            {label}
                            <div class="input_error">{error}</div>
                        </fieldset>                                    
                     </div>'])
            ->Input(["class" => "form-control", 'required' => true])
    ?>
    <div class="clearfix"></div>
    <?=
            $form->field($model, 'address', ['template' => '<div class="form-group">
                        <fieldset class="form-fieldset ui-input">
                            {input}
                            {label}
                            <div class="input_error">{error}</div>
                        </fieldset>                                    
                     </div>'])
            ->Input([ "class" => "form-control", 'required' => true])
    ?>
    <div class="clearfix"></div>
    <?=
            $form->field($model, 'state', ['template' => '<div class="form-group">
                        <fieldset class="form-fieldset ui-input">
                            {input}
                            {label}
                            <div class="input_error">{error}</div>
                        </fieldset>                                    
                     </div>'])
            ->Input([ "class" => "form-control", 'required' => true])
    ?>
    <div class="clearfix"></div>
    <?=
            $form->field($model, 'zip', ['template' => '<div class="form-group">
                        <fieldset class="form-fieldset ui-input">
                            {input}
                            {label}
                            <div class="input_error">{error}</div>
                        </fieldset>                                    
                     </div>'])
            ->Input([ "class" => "form-control", 'required' => true])
    ?>
    <div class="clearfix"></div>

    <button class="button save pull-right" type="submit">Save Address</button>
    <?php ActiveForm::end() ?>
</div>

