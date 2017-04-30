<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile("@web/vendors/jasny-bootstrap/jasny-bootstrap.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/vendors/validation/css/bootstrapValidator.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/pages/wizard.css", [
    'depends' => [backend\assets\AppAsset::className()]]);

if (!$model->isNewRecord) {
    $formId = 'user-update';
    $formClass = 'validation-form';
    $action = '/user/update?id=' . $model->id;
} else {
    $formId = 'user-create';
    $formClass = 'validation-form';
    $action = '/user/create';
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                    <?php if (!$model->isNewRecord) { echo Yii::t('app','Edit User'); }else{ echo Yii::t('app','Add New User');}?>
                </h3>
                <span class="pull-right clickable">
                    <i class="glyphicon glyphicon-chevron-up"></i>
                </span>
            </div>
            <div class="panel-body">
                <!--main content-->
                <?php
                $form = ActiveForm::begin([
                            'action' => [$action],
                            'id' => $formId,
                            'options' => ['class' => $formClass]
                ]);
                ?>
                <div id="rootwizard">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab">User Profile</a></li>
                        <li><a href="#tab2" data-toggle="tab">Bio</a></li>
                        <li><a href="#tab3" data-toggle="tab">Address</a></li>
                        <li><a href="#tab4" data-toggle="tab">Contact Details</a></li>
                        <?php if (!$model->isNewRecord): ?><li><a href="#tab5" data-toggle="tab">Profile Settings</a></li><?php endif; ?>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <h2 class="hidden">&nbsp;</h2>
                            <?= $form->field($model, 'username', ['labelOptions' => ['class' => 'control-label']])->textInput(['maxlength' => true, 'id' => 'username', 'data-bv-field' => 'username', 'placeholder' => Yii::t('app', 'Enter username'), 'class' => 'form-control required'])->label(Yii::t('app', 'Username') . '*'); ?>
                            <!--div class="form-group">
                                <label for="userName" class="control-label">User name *</label>
                                <input id="userName" name="username" type="text" placeholder="Enter your name" class="form-control required">
                            </div -->
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'id' => 'email', 'placeholder' => Yii::t('app', 'Enter Email'), 'class' => 'form-control required email'])->label(Yii::t('app', 'Email') . '*'); ?>
                            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'id' => 'password', 'placeholder' => Yii::t('app', 'Enter Password'), 'class' => 'form-control required'])->label(Yii::t('app', 'Password') . '*'); ?>
                            <?=
                            $form->field($model, 'role')->widget(Select2::className(), [
                                'value'=>$model->role,
                                'data' => [Yii::t('app', "Admin"), Yii::t('app', "Content Manager"), Yii::t('app', "User")],
                                'language' => Yii::$app->language,
                                'options' => ['placeholder' => Yii::t('app', "Select an account type") . '...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'multiple' => false
                                ],
                            ])->label(Yii::t('app', 'Select an account type'))
                            ?>
                            <?php //$form->field($model, 'confirm')->textInput(['maxlength' => true,'id'=>'confirm','placeholder'=>Yii::t('app','Confirm Password'),'class'=>'form-control required'])->label(Yii::t('app', 'Confirm Password').'*');  ?>
                            <!--div class="form-group">
                                <label for="email">Email *</label>
                                <input id="email" name="email" placeholder="Enter your Email" type="text" class="form-control required email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input id="password" name="password" type="password" placeholder="Enter your password" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label for="confirm">Confirm Password *</label>
                                <input id="confirm" name="confirm" type="password" placeholder="Confirm your password " class="form-control required">
                            </div -->
                        </div>
                        <div class="tab-pane" id="tab2" disabled="disabled">
                            <h2 class="hidden">&nbsp;</h2>
                            <?= $form->field($customermodel, 'first_name')->textInput(['maxlength' => true, 'id' => 'first_name', 'placeholder' => Yii::t('app', 'Enter First name'), 'class' => 'form-control required'])->label(Yii::t('app', 'First Name') . '*'); ?>
                            <?= $form->field($customermodel, 'last_name')->textInput(['maxlength' => true, 'id' => 'last_name', 'placeholder' => Yii::t('app', 'Enter Last name'), 'class' => 'form-control required'])->label(Yii::t('app', 'Last Name') . '*'); ?>
                            <?=
                            $form->field($customermodel, 'gender')->widget(Select2::className(), [
                                'data' => [Yii::t('app', "Male"), Yii::t('app', "Female")],
                                'language' => Yii::$app->language,
                                'options' => ['placeholder' => Yii::t('app', "Select Gender") . '...', 'id' => 'gender'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'multiple' => false
                                ],
                            ])->label(Yii::t('app', 'Select Gender'))
                            ?>
                            <?=
                            $form->field($customermodel, 'dob')->widget(DatePicker::className(), [
                                'value' => $customermodel->dob,
                                'options' => ['placeholder' => Yii::t('app', 'Enter User Date of Birth')],
                                'language' => Yii::$app->language,
                                'pluginOptions' => [
                                    'format' => 'dd-M-yyyy',
                                    'todayHighlight' => true
                                ]
                            ])->label(Yii::t('app', 'User Date of Birth'));
                            ?>
                            <?= $form->field($customermodel, 'bio')->textarea(['rows' => 6]) ?>
                        </div>
                        <div class="tab-pane" id="tab3" disabled="disabled">
                            <?= $form->field($customermodelAddress, 'address')->textInput(['maxlength' => true, 'id' => 'address', 'placeholder' => Yii::t('app', 'Enter Address'), 'class' => 'form-control'])->label(Yii::t('app', 'User Address')); ?>
                            <?= $form->field($customermodelAddress, 'country')->textInput(['maxlength' => true, 'id' => 'country', 'placeholder' => Yii::t('app', 'Enter Country'), 'class' => 'form-control']) ?>

                            <?= $form->field($customermodelAddress, 'state')->textInput(['maxlength' => true, 'id' => 'state', 'placeholder' => Yii::t('app', 'Enter State'), 'class' => 'form-control']) ?>

                            <?= $form->field($customermodelAddress, 'city')->textInput(['maxlength' => true, 'id' => 'city', 'placeholder' => Yii::t('app', 'Enter City'), 'class' => 'form-control']) ?>

                            <?= $form->field($customermodelAddress, 'postal')->textInput(['maxlength' => true, 'id' => 'postal', 'placeholder' => Yii::t('app', 'Enter Postal Code'), 'class' => 'form-control']) ?>

                        </div>
                        <div class="tab-pane" id="tab4" disabled="disabled">
                            <?= $form->field($customermodel, 'phone')->textInput(['maxlength' => true, 'id' => 'phone', 'placeholder' => Yii::t('app', 'Enter Personal Number'), 'class' => 'form-control']) ?>
                            <?= $form->field($customermodel, 'mobile_phone')->textInput(['maxlength' => true, 'id' => 'mobile_phone', 'placeholder' => Yii::t('app', 'Enter Home Number'), 'class' => 'form-control']) ?>
                            <?= $form->field($customermodel, 'other_phone')->textInput(['maxlength' => true, 'id' => 'other_phone', 'placeholder' => Yii::t('app', 'Enter Alternate Number'), 'class' => 'form-control']) ?>

                        </div>
                        <?php if (!$model->isNewRecord): ?>
                            <div class="tab-pane" id="tab5" disabled="disabled">

                            </div>
                        <?php endif; ?>
                        <ul class="pager wizard">
                                <?php if ($model->isNewRecord): ?> 
                                    <li class="previous">
                                        <a href="#"><?= Yii::t('app', 'Previous') ?></a>
                                    </li>
                                    <li class="next">
                                        <a href="#"><?= Yii::t('app', 'Next') ?></a>
                                    </li>
                                <?php endif; ?>
                                <?=
                                Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
                                    'class' => $model->isNewRecord ? 'btn btn-sm btn-primary pull-right ' : 'btn btn-sm btn-success pull-right',
                                    'id' => 'submit_'.$formId,
                                    'type' => 'button',
                                    'style'=>$model->isNewRecord ? 'display:none' : '',
                                ])
                                ?>
                        </ul>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <!--main content end--> 
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJsFile(
        '@web/js/tinymce/js/tinymce/tinymce.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/pages/editor1.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<?php
$this->registerJsFile(
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyB69lYrWggKfgrW_XlsCojuMUyBoZ8bpk0&libraries=places&language=' . Yii::$app->language
);
$this->registerJsFile(
        '@web/js/searchaddress.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

