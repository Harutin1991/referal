<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile("@web/vendors/jasny-bootstrap/jasny-bootstrap.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/vendors/validation/css/bootstrapValidator.min.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/pages/wizard.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'starting_amount')->textInput() ?>

    <?= $form->field($model, 'purse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referal_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'invitation_users_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remember_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'api_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'social_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'social_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'social_user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'activity_status')->textInput() ?>

    <?= $form->field($model, 'referal_link_created')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'created')->textInput() ?>

    <?= $form->field($model, 'updated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                    Add New User
                </h3>
                <span class="pull-right clickable">
                    <i class="glyphicon glyphicon-chevron-up"></i>
                </span>
            </div>
            <div class="panel-body">
                <!--main content-->
                <?php
                $form = ActiveForm::begin([
                            'action' => ['/user/create'],
                            'id' => 'commentForm']);
                ?>
                <div id="rootwizard">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab">User Profile</a></li>
                        <li><a href="#tab2" data-toggle="tab">Bio</a></li>
                        <li><a href="#tab3" data-toggle="tab">Address</a></li>
                        <li><a href="#tab4" data-toggle="tab">Contact Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <h2 class="hidden">&nbsp;</h2>
                            <?= $form->field($model, 'username', ['labelOptions' => ['class' => 'control-label']])->textInput(['maxlength' => true, 'id' => 'userName', 'placeholder' => Yii::t('app', 'Enter username'), 'class' => 'form-control required'])->label(Yii::t('app', 'Username') . '*'); ?>
                            <!--div class="form-group">
                                <label for="userName" class="control-label">User name *</label>
                                <input id="userName" name="username" type="text" placeholder="Enter your name" class="form-control required">
                            </div -->
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'id' => 'email', 'placeholder' => Yii::t('app', 'Enter Email'), 'class' => 'form-control required email'])->label(Yii::t('app', 'Email') . '*'); ?>
                            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'id' => 'password', 'placeholder' => Yii::t('app', 'Enter Password'), 'class' => 'form-control required'])->label(Yii::t('app', 'Password') . '*'); ?>
                            <?=
                            $form->field($model, 'role')->widget(Select2::className(), [
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
                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'id' => 'name', 'placeholder' => Yii::t('app', 'Enter First name'), 'class' => 'form-control required'])->label(Yii::t('app', 'First Name') . '*'); ?>
                            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'id' => 'surname', 'placeholder' => Yii::t('app', 'Enter Last name'), 'class' => 'form-control required'])->label(Yii::t('app', 'Last Name') . '*'); ?>
                            <?=
                            $form->field($model, 'gender')->widget(Select2::className(), [
                                'data' => [Yii::t('app', "Male"), Yii::t('app', "Female")],
                                'language' => Yii::$app->language,
                                'options' => ['placeholder' => Yii::t('app', "Select Gender") . '...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'multiple' => false
                                ],
                            ])->label(Yii::t('app', 'Select Gender'))
                            ?>
                             <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'id' => 'address', 'placeholder' => Yii::t('app', 'Enter Address'), 'class' => 'form-control'])->label(Yii::t('app', 'User Address')); ?>
                                <?= $form->field($model, 'dob')->textInput(['maxlength' => true, 'id' => 'address', 'placeholder' => Yii::t('app', 'Enter Address'), 'class' => 'form-control'])->label(Yii::t('app', 'User Address')); ?>
                            <div class="form-group">
                                <label for="age">Age *</label>
                                <input id="age" name="age" type="text"  maxlength="3" class="form-control required number">
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3" disabled="disabled">
                            <div class="form-group">
                                <label>Home number</label>
                                <input type="text" class="form-control" id="phone1" name="phone1" placeholder="(999)999-9999">
                            </div>
                            <div class="form-group">
                                <label>Personal number</label>
                                <input type="text" class="form-control" id="phone2" name="phone2" placeholder="(999)999-9999">
                            </div>
                            <div class="form-group">
                                <label>Alternate number</label>
                                <input type="text" class="form-control" id="phone3" name="phone3" placeholder="(999)999-9999">
                            </div>
                            <h2 class="hidden">&nbsp;</h2>
                            <div class="form-group">
                                <span>Terms and Conditions</span>

                                <label>
                                    <input id="acceptTerms" name="acceptTerms" type="checkbox">
                                    I agree with the Terms and Conditions.
                                </label>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4" disabled="disabled">
                            <div class="form-group">
                                <label>Home number</label>
                                <input type="text" class="form-control" id="phone1" name="phone1" placeholder="(999)999-9999">
                            </div>
                            <div class="form-group">
                                <label>Personal number</label>
                                <input type="text" class="form-control" id="phone2" name="phone2" placeholder="(999)999-9999">
                            </div>
                            <div class="form-group">
                                <label>Alternate number</label>
                                <input type="text" class="form-control" id="phone3" name="phone3" placeholder="(999)999-9999">
                            </div>
                            <h2 class="hidden">&nbsp;</h2>
                            <div class="form-group">
                                <span>Terms and Conditions</span>

                                <label>
                                    <input id="acceptTerms" name="acceptTerms" type="checkbox">
                                    I agree with the Terms and Conditions.
                                </label>
                            </div>
                        </div>
                        <ul class="pager wizard">
                            <li class="previous"><a href="#">Previous</a></li>
                            <li class="next"><a href="#">Next</a></li>
                            <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                        </ul>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <!--main content end--> </div>
        </div>
    </div>
</div>
<?php
$this->registerJsFile(
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyB69lYrWggKfgrW_XlsCojuMUyBoZ8bpk0&libraries=places&language='.Yii::$app->language
);
$this->registerJsFile(
        '@web/js/searchaddress.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
