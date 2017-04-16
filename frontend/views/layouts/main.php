<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use kartik\growl\Growl;
use common\models\Language;
use yii\helpers\Url;
use backend\models\Files;

$languages = Language::find()->asArray()->all();

$action = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;

$currentUrl = trim(substr($_SERVER['REQUEST_URI'], 3));
$com = strcmp($currentUrl, "/site/index");
$session = Yii::$app->session;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
$languege = Language::find()->where(['short_code' => Yii::$app->language])->asArray()->all();
$isDefaultLanguage = $languege[0]['is_default'];
$this->title = Yii::t('app', 'Referal | HOME');
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
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
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
        <div class="body">
            <header id="header" class="header-narrow header-semi-transparent" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 1, 'stickySetTop': '0'}">
                <div class="header-body">
                    <div class="header-container container">
                        <div class="header-row">
                            <div class="header-column">
                                <div class="header-logo">
                                    <a href="demo-digital-agency.html">
                                        <?= Html::img('@web/img/logo.png', ['width' => '131', 'height' => '40']); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="header-column">
                                <div class="header-row">
                                    <div class="header-nav header-nav-stripe">
                                        <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                                            <i class="fa fa-bars"></i>
                                        </button>

                                        <ul class="header-social-icons social-icons hidden-xs">
                                            <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                        <div class="dropdown" style="float: right; margin-top: 38px;">
                                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                RUSSIAN                                    <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <li><a href="/en">ENGLISH</a></li>
                                                <li><a href="/am">ARMENIAN</a></li>
                                            </ul>
                                        </div>
                                        <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1 collapse">
                                            <nav>
                                                <ul class="nav nav-pills" id="mainNav">
                                                    <li>
                                                        <a href="demo-digital-agency-contact.html">
                                                            Регистрация
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <a class="btn mt-xl mb-sm want" style="margin-left: 160px;" href="demo-digital-agency-about.html">Хочу заработать</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <?php echo $content ?>
            <footer class="short" id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <a href="demo-digital-agency.html" class="logo">
                                <img alt="Porto Website Template" class="img-responsive" src="img/demos/digital-agency/logo-digital-agency.png">
                            </a>
                        </div>
                        <div class="col-sm-2 col-sm-offset-6 align-right">
                            <h5 class="mb-sm">New York</h5>
                            <span class="phone font-size-sm"><i class="fa fa-phone text-color-primary"></i> (800) 123-4567</span>
                        </div>
                        <div class="col-sm-2 align-right">
                            <h5 class="mb-sm">Los Angeles</h5>
                            <span class="phone font-size-sm"><i class="fa fa-phone text-color-primary"></i> (800) 123-4567</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr class="solid">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>© Copyright 2017. All Rights Reserved.</p>
                                </div>
                                <div class="col-md-6 align-right">
                                    <ul class="social-icons pull-right">
                                        <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                    <span class="footer-email-custom pull-right"><i class="fa fa-envelope text-color-primary"></i> <a href="mailto:mail@example.com">mail@example.com</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>