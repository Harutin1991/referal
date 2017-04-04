<?php
/* @var $this \yii\web\View */
/* @var $model \common\models\LoginForm */

use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="shortcut icon" href="img/fave.png">
    </head>
    <body>
        <?php $this->beginBody() ?>
        <!-- Start: Main -->
        <div class="container">
            <div class="row vertical-offset-100">
                <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
                    <div id="container_demo">
                        <a class="hiddenanchor" id="toregister"></a>
                        <a class="hiddenanchor" id="tologin"></a>
                        <a class="hiddenanchor" id="toforgot"></a>
                        <div id="wrapper">
                            <div id="login" class="animate form">
                                <?php $form = ActiveForm::begin(["id" => "contact", 'options' => ['autocomplete' => 'on']]) ?>
                                <h3 class="black_bg">
                                    <br>Log in</h3>

                                <?=
                                        $form->field($model, 'username', ['template' => '<p><label style="margin-bottom:0px;" for="username" class="uname"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> E- mail or Username</label>
                                    {input}{error}</p>'])
                                        ->textInput(['maxlength' => true,'class'=>false, 'placeholder' => 'username or e-mail'])->label(false)
                                ?>
                                <?=
                                        $form->field($model, 'password', ['template' => '<p><label style="margin-bottom:0px;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>Password</label>
                                    {input}{error}</p>'])
                                        ->textInput(['maxlength' => true,'class'=>false, 'placeholder' => 'eg. X8df!90EO'])->label(false)
                                ?>
                                <p class="keeplogin">
                                    <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
                                    <label for="loginkeeping">Keep me logged in</label>
                                </p>
                                <p class="login button">
                                    <input type="submit" value="Login" class="btn btn-success" />
                                </p>
                                <p class="change_link">
                                    <a href="#toforgot">
                                        <button type="button" class="btn btn-responsive botton-alignment btn-warning btn-sm">Forgot password</button>
                                    </a>
                                </p>
                                <?php ActiveForm::end(); ?>
                            </div>
                            <div id="forgot" class="animate form">
                                <form action="index.html" autocomplete="on" method="post">
                                    <h3 class="black_bg">
                                        <img src="img/logo.png" alt="josh logo">Password</h3>
                                    <p>
                                        Enter your email address below and we'll send a special reset password link to your inbox.
                                    </p>
                                    <p>
                                        <label style="margin-bottom:0px;" for="emailsignup1" class="youmai">
                                            <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                                            Your email
                                        </label>
                                        <input id="emailsignup1" name="emailsignup" required type="email" placeholder="your@mail.com" />
                                    </p>
                                    <p class="login button">
                                        <input type="submit" value="Login" class="btn btn-success" />
                                    </p>
                                    <p class="change_link">
                                        <a href="#tologin" class="to_register">
                                            <button type="button" class="btn btn-responsive botton-alignment btn-warning btn-sm">Back</button>
                                        </a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
    