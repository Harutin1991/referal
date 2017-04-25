<?php
/* @var $this \yii\web\View */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\authclient\widgets\AuthChoice;
use kartik\growl\Growl;
use kartik\date\DatePicker;

$this->title = Yii::t('app', 'Registration');
?>
<div class="main-section">
    <div class="container">
        <?php
        $mess = Yii::$app->session->getFlash('notvalid');
        if (isset($mess) && $mess) {
            echo Growl::widget([
                'type' => Growl::TYPE_SUCCESS,
                'title' => '',
                'icon' => 'fa fa-check-square-o',
                'body' => $mess,
                'showSeparator' => true,
                'delay' => 0,
                'pluginOptions' => [
                    'showProgressbar' => false,
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ]
                ]
            ]);
        }
        ?>
        <?php
        $error = Yii::$app->session->getFlash('error');

        if (isset($error) && $error) {
            echo Growl::widget([
                'type' => Growl::TYPE_DANGER,
                'title' => '',
                'icon' => 'fa fa-exclamation-triangle',
                'body' => $error,
                'showSeparator' => true,
                'delay' => 1000,
                'pluginOptions' => [
                    'showProgressbar' => false,
                    'placement' => [
                        'from' => 'top',
                        'align' => 'right',
                    ]
                ]
            ]);
        }
        ?>
        <div class="registration col-xs-12">
            <div class="paragraph">
                Registration
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <div class="main-login main-center">
                    <?php $formSignup = ActiveForm::begin(['action' => '/' . Yii::$app->language . '/site/signup']) ?>
                    <input type="hidden"  value="<?php echo $modelSignup->verifyToken ?>" name="verifyToken" />
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'first_name', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "First Name"), 'id' => 'inputFName', "class" => "form-control", 'required' => true])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'last_name', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "Last Name"), 'id' => 'inputLName', "class" => "form-control", 'required' => true])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'email', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "Enter email"), 'type' => 'email', 'id' => 'inputEmail', "class" => "form-control"])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'username', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "Enter username"), "class" => "form-control"])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'password', ['template' => '{input}{error}'])
                                            ->passwordInput(["placeholder" => Yii::t('app', "Password"), "class" => "form-control ex-input", 'required' => true])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'confirm_password', ['template' => '{input}{error}'])
                                            ->passwordInput(["placeholder" => Yii::t('app', "Confirm Password"), "class" => "form-control", 'required' => true])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="paragraph">
                        <?= Yii::t('app', 'Personal Data') ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon" style="width: 7% !important;"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'address', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "Enter Address"), "class" => "form-control"])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'country', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "Country"), "class" => "form-control",'id'=>'country'])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'city', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "City"), "class" => "form-control",'id'=>'city'])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'postal', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "Zip Code"), "class" => "form-control",'id'=>'postal'])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    <?=
                                            $formSignup->field($modelSignup, 'phone', ['template' => '{input}{error}'])
                                            ->textInput(["placeholder" => Yii::t('app', "Phone"), "class" => "form-control"])
                                            ->label(false)
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <?=
                                    $formSignup->field($modelSignup, 'gender', ['template' => '{input}{error}'])->widget(Select2::className(), [
                                        'data' => [Yii::t('app', "Male"), Yii::t('app', "Female")],
                                        'language' => Yii::$app->language,
                                        'options' => ['placeholder' => Yii::t('app', "Select Gender") . '...', 'id' => 'gender'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'multiple' => false
                                        ],
                                    ])->label(Yii::t('app', 'Select Gender'))
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="cols-sm-10">
                                    <?=
                                    $formSignup->field($modelSignup, 'dob', ['template' => '{input}{error}'])->widget(DatePicker::className(), [
                                        'options' => ['placeholder' => Yii::t('app', 'Birth Date'),'class'=>''],
                                        'language' => Yii::$app->language,
                                        'pluginOptions' => [
                                            'format' => 'dd-M-yyyy',
                                            'todayHighlight' => true
                                        ]
                                    ])->label(Yii::t('app', 'Birth Date'));
                                    ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group pact">
                            <input type="checkbox" id="pact" name="pact">
                            <!-- registration/pact -->
                            <a href="/" target="_blank" id="catCan">Ознакомился с публичной Офертой и согласен с правилами</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group sendform">
                            <input type="submit" name="" value="далее">
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <?php
                $authAuthChoice = AuthChoice::begin([
                            'baseAuthUrl' => ['site/auth'],
                            'options' => [
                                'class' => ['reg-social']
                            ]
                ]);
                ?>
                <?php foreach ($authAuthChoice->getClients() as $key => $client): ?>
                    <?php if ($key == "facebook"): ?>
                        <div class="fb-reg col-xs-12">
                            <?php echo $authAuthChoice->clientLink($client, '<i class="fa fa-' . $key . '" aria-hidden="true"></i>' . ucfirst($key)) ?>
                        </div> 
                    <?php else: ?>
                        <div class="gplus-reg col-xs-12">
                            <?php echo $authAuthChoice->clientLink($client, '<i class="fa fa-' . $key . '-plus" aria-hidden="true"></i>' . ucfirst($key)) ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="clear"></div>
                <?php AuthChoice::end(); ?>
            </div>
            <!--div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="reg-social">
                    <div class="fb-reg col-xs-12">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        <span>Sign in with Facebook</span>
                    </div>
                    <div class="gplus-reg col-xs-12">
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                        <span>Sign in with Google</span>
                    </div>
                </div>
            </div -->
        </div>
    </div>

    <?php
    $this->registerJsFile(
            'https://maps.googleapis.com/maps/api/js?key=AIzaSyB69lYrWggKfgrW_XlsCojuMUyBoZ8bpk0&libraries=places&language=' . Yii::$app->language
    );
    $this->registerJsFile(
            '@web/js/registration.js', ['depends' => [\yii\web\JqueryAsset::className()]]
    );
    ?>


