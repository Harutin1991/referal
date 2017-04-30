<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use kartik\growl\Growl;
use common\models\Language;
use yii\helpers\Url;
use backend\models\Files;
use backend\models\Pages;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;

$languages = Language::find()->asArray()->all();

$action = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;
$model = new LoginForm();
$modelResetPass = new PasswordResetRequestForm();
$currentUrl = trim(substr($_SERVER['REQUEST_URI'], 3));

$com = strcmp($currentUrl, "/site/index");
$session = Yii::$app->session;
$pages = Pages::findList();
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
$languege = Language::find()->where(['short_code' => Yii::$app->language])->asArray()->all();
$isDefaultLanguage = $languege[0]['is_default'];
if (isset($this->title)) {
    $this->title = Yii::t('app', 'Make Coin') . ' | ' . $this->title;
} else {
    $this->title = Yii::t('app', 'Make Coin | Home');
}
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" data-style-switcher-options="{'changeLogo': false,'borderRadius': 0, 'colorPrimary': '#89b837', 'colorSecondary': '#78A330', 'colorTertiary': '#DFE5EA', 'colorQuaternary': '#444'}">

    <head>	
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <title>
            <?= Html::encode($this->title) ?>
        </title>
        <link rel="icon" href="/image/favicon.ico" type="image/gif" sizes="16x16">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>
        <?php
        $mess = Yii::$app->session->getFlash('success');
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
        <header>
            <div class="modal fade modal-forget-password" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div class="modal-title" id="myModalLabel">Забыли пароль?</div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="question-pass hidden">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <div class="input-group">
                                        <?=
                                                $form->field($modelResetPass, 'email')
                                                ->textInput(['autofocus' => true, "placeholder" => Yii::t('app', 'Enter email'), 'aria-describedby' => 'basic-addon1', "class" => "form-control"])
                                                ->label(false)
                                        ?>
                                        <span class="input-group-addon" id="basic-addon1">
                                            <?= Html::submitButton(Yii::t('app', 'Send')) ?>
                                        </span>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                                <div class="pass-answer hidden">
                                    Спасибо, заявка отправлена!
                                </div>
                                <div class="change-pass">
                                    <form action="" method="">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 text-right">Password <span>*</span></label>
                                            <div class="input-group col-xs-12 col-sm-9">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-key" aria-hidden="true"></i>
                                                </span>
                                                <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-3 text-right">Confirm Password <span>*</span></label>
                                            <div class="input-group col-xs-12 col-sm-9">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-key" aria-hidden="true"></i>
                                                </span>
                                                <input type="password" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group send-form">
                                                <div class="pull-right">
                                                    <button type="submit">Save</button>
                                                    <button type="reset" class="hidden-xs">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!$currentUrl): ?>
                <div class="header-wrapper col-xs-12"  >
                    <div class="container">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="logo-header">
                                <a href="/<?= Yii::$app->language ?>">
                                    <?= Html::img('@web/image/logo-header.png'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="earn">
                                <a href="#">Хочу заработать</a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                            <div class="reg-lang col-xs-12">
                                <ul>
                                    <li>
                                        <?php if (!Yii::$app->user->identity): ?>
                                            <div class="registration" id="registration">
                                                <a href=" javascript:void(0);" id="registrationModela"><?= Yii::t('app', 'Login/Registration') ?></a>
                                            </div>
                                            <div id="login" class="login">
                                                <?php $form = ActiveForm::begin(['action' => '/' . Yii::$app->language . '/site/login', 'options' => ['accept-charset' => 'utf-8']]) ?>
                                                <div class="form">
                                                    <div class="form-group">
                                                        <div class="people">
                                                            <div class="input-group">
                                                                <span class="input-group-addon icon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                                <?=
                                                                        $form->field($model, 'username', ['template' => '{input}{error}'])
                                                                        ->textInput(["placeholder" => Yii::t('app', 'Login'), "class" => "form-control", 'required' => true])
                                                                        ->label(false)
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="people">
                                                            <div class="input-group">
                                                                <span class="input-group-addon icon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                                <?=
                                                                        $form->field($model, 'password', ['template' => '{input}{error}'])
                                                                        ->passwordInput(["placeholder" => Yii::t('app', 'Password'), "class" => "form-control", 'required' => true])
                                                                        ->label(false)
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" value="Войти" id="loginBtn">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="reg">
                                                            <a href="/<?= Yii::$app->language ?>/signup"><?= Yii::t('app', 'Registration') ?></a>
                                                        </div>
                                                        <div class="forget">
                                                            <button type="button" data-toggle="modal" data-target="#myModal"><?= Yii::t('app', 'Forgot Password') ?>?</button>
                                                            <a href="/<?= Yii::$app->language ?>/site/request-password-reset" class="hidden"><?= Yii::t('app', 'Forgot Password') ?>?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php ActiveForm::end() ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="registration" id="registration">
                                                <a href="javascript:void(0)" id="registrationModela"><?= Yii::$app->user->identity->customer->first_name . ' ' . Yii::$app->user->identity->customer->last_name ?></a>
                                            </div>
                                            <div id="login" class="login">
                                                <div class="login-form">
                                                    <ul>
                                                        <li><a href=""><a href="/<?= Yii::$app->language ?>/user/profile"><?= Yii::t('app', 'Profile') ?></a></a></li>
                                                        <li><a href="/<?= Yii::$app->language ?>/site/logout"><?= Yii::t('app', 'Logout') ?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <div class="language">
                                            <div class="dropdown">
                                                <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?= $languege[0]['name'] ?>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <?php foreach ($languages as $language): ?>
                                                        <?php if ($currentUrl != "" && $language['short_code'] != $languege[0]['short_code']): ?>
                                                            <li><a href="/<?= $language['short_code'] ?><?= $currentUrl ?>"  ><?= $language['name'] ?></a></li>
                                                        <?php elseif ($language['short_code'] != $languege[0]['short_code']): ?>
                                                            <li><a href="/<?= $language['short_code'] ?>" ><?= $language['name'] ?></a></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="menua hidden">
                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                            <ul>
                                                <li>
                                                </li>
                                            </ul>
                                        </div>
                                        <nav class="menu-opener">
                                            <div class="menu-opener-inner"></div>
                                        </nav>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="header-menu col-xs-12">
                            <nav class="menu">
                                <ul class="menu-inner">
                                    <a href="#" class="menu-link">
                                        <li>О проекте</li>
                                    </a>
                                    <a href="#" class="menu-link">
                                        <li>Блог</li>
                                    </a>
                                    <a href="#" class="menu-link">
                                        <li>Пакеты и цены</li>
                                    </a>
                                    <a href="#" class="menu-link">
                                        <li>Конфиденциальность</li>
                                    </a>
                                    <a href="#" class="menu-link">
                                        <li>Контакты</li>
                                    </a>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="header-wrapper-secound col-xs-12">
                    <div class="container">
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <div class="logo-header">
                                <a href="/<?= Yii::$app->language ?>">
                                    <?= Html::img('@web/image/logo-header.png'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="earn">
                                <a href="#">Хочу заработать</a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="reg-lang col-xs-12">
                                <ul>
                                    <li>
                                        <?php if (!Yii::$app->user->identity): ?>
                                            <div class="registration" id="registration">
                                                <a href=" javascript:void(0);" id="registrationModela"><?= Yii::t('app', 'Login/Registration') ?></a>
                                            </div>
                                            <div id="login" class="login">
                                                <?php $form = ActiveForm::begin(['action' => '/' . Yii::$app->language . '/site/login', 'options' => ['accept-charset' => 'utf-8']]) ?>
                                                <div class="form">
                                                    <div class="form-group">
                                                        <div class="people">
                                                            <div class="input-group">
                                                                <span class="input-group-addon icon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                                <?=
                                                                        $form->field($model, 'username', ['template' => '{input}{error}'])
                                                                        ->textInput(["placeholder" => Yii::t('app', 'Login'), "class" => "form-control", 'required' => true])
                                                                        ->label(false)
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="people">
                                                            <div class="input-group">
                                                                <span class="input-group-addon icon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                                <?=
                                                                        $form->field($model, 'password', ['template' => '{input}{error}'])
                                                                        ->passwordInput(["placeholder" => Yii::t('app', 'Password'), "class" => "form-control", 'id' => 'inputPassword', 'required' => true])
                                                                        ->label(false)
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" value="Войти" id="loginBtn">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="reg">
                                                            <a href="/<?= Yii::$app->language ?>/signup"><?= Yii::t('app', 'Registration') ?></a>
                                                        </div>
                                                        <div class="forget">
                                                            <button type="button" data-toggle="modal" data-target="#myModal"><?= Yii::t('app', 'Forgot Password') ?>?</button>
                                                            <a href="/<?= Yii::$app->language ?>/site/request-password-reset" class="hidden"><?= Yii::t('app', 'Forgot Password') ?>?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php ActiveForm::end() ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="registration">
                                                <a href="javascript:void(0)" id="registrationModela"><?= Yii::$app->user->identity->customer->first_name . ' ' . Yii::$app->user->identity->customer->last_name ?></a>
                                            </div>
                                            <div id="login" class="login">
                                                <div class="login-form">
                                                    <ul>
                                                        <li><a href=""><a href="/<?= Yii::$app->language ?>/user/profile"><?= Yii::t('app', 'Profile') ?></a></a></li>
                                                        <li><a href="/<?= Yii::$app->language ?>/site/logout"><?= Yii::t('app', 'Logout') ?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                    <li>
                                        <div class="language">
                                            <div class="dropdown">
                                                <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?= $languege[0]['name'] ?>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <?php foreach ($languages as $language): ?>
                                                        <?php if ($currentUrl != "" && $language['short_code'] != $languege[0]['short_code']): ?>
                                                            <li><a href="/<?= $language['short_code'] ?><?= $currentUrl ?>"  ><?= $language['name'] ?></a></li>
                                                        <?php elseif ($language['short_code'] != $languege[0]['short_code']): ?>
                                                            <li><a href="/<?= $language['short_code'] ?>" ><?= $language['name'] ?></a></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </header>
        <div class="main-section">
            <?php echo $content ?>
        </div>
                <!-- <?php if (!$currentUrl): ?> style="bottom:-295px;" <?php else: ?> style="bottom: 0px;" <?php endif; ?> -->
        <footer id="footer">
            <div class="top-banner col-xs-12">
                <div class="container">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 menu">
                        <ul>
                            <?php foreach ($pages as $page): ?>
                                <li><a href="/<?= Yii::$app->language ?>/page/<?= $page['pages_id'] ?>"><?= $page['title'] ?></a></li>
                            <?php endforeach; ?>
                            <li><a href="/<?= Yii::$app->language ?>/blog"><?= Yii::t('app', 'Blog') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/contact"><?= Yii::t('app', 'Support') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/faq"><?= Yii::t('app', 'F.A.Q') ?></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="scrollTop">
                            <span><i class="fa fa-chevron-up" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-banner col-xs-12">
                <div class="container">
                    <div class="logo col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <a href="/<?= Yii::$app->language ?>">
                            <?= Html::img('@web/image/logo-footer.png', ['class' => 'img-responsive']); ?>
                        </a>
                    </div>
                    <div class="company col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <a href="http://studionomad.kz/" target="_blank"><?= Yii::t('app', 'design and developmant by') ?></a> <span>Studio Nomad</span>	
                    </div>
                </div>
            </div>
        </footer>
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>