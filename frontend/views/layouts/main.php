<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use kartik\growl\Growl;
use frontend\models\Category;
use frontend\models\Service;
use frontend\models\Product;
use common\models\Language;
use yii\helpers\Url;
use backend\models\Files;
use backend\models\Slider;
use backend\models\Contactus;
use backend\models\Sitesettings;

$languages = Language::find()->asArray()->all();
$sliders = Slider::find()->asArray()->all();
$category_left = Category::findList('left');
$category_right = Category::findList('right');
$categories = Category::findList('', true);
$action = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;
$contacts = Contactus::find()->asArray()->one();
$currentUrl = trim(substr($_SERVER['REQUEST_URI'], 3));
$com = strcmp($currentUrl, "/site/index");
$session = Yii::$app->session;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
$languege = Language::find()->where(['short_code' => Yii::$app->language])->asArray()->all();
$isDefaultLanguage = $languege[0]['is_default'];
$settings = Sitesettings::find_One();
$this->title = Yii::t('app', 'PROFMONT | HOME');
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, initial-scale=1.0, user-scalable=no">
        <?= Html::csrfMetaTags() ?>
        <title>
            <?= Html::encode($this->title) ?>
        </title>
        <link rel="icon" href="/image/favicon.png" type="image/gif" sizes="16x16">
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
            <div class="header-wrapper hidden-xs hidden-sm">
                <div class="container">
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                        <ul class="menu col-xs-12">
                            <li><a href="/<?= Yii::$app->language ?>" class="<?php echo ($currentUrl == '') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'HOME') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/about" class="<?php echo ($currentUrl == '/about') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'ABOUT US') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/page/news" class="<?php echo ($currentUrl == '/page/news') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'NEWS') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/page/partners" class="<?php echo ($currentUrl == '/page/partners') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'PARTNERS') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/page/service" class="<?php echo ($currentUrl == '/page/service') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'SERVICES') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/contact" class="<?php echo ($currentUrl == '/contact') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'CONTACTS') ?></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="search">
                            <form action="" method="">
                                <label>
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <input type="submit" name="" value="">
                                </label>
                                <input type="search" name="" placeholder="WELCOME TO OUR SHOP">
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
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
                    </div>
                </div>		
            </div>
            <div class="social hidden-xs hidden-sm col-md-12 col-lg-12">
                <div class="container">
                    <div class="ph col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="phone">
                            <div class="number">
                                <a href="tel:<?= $contacts['phone'] ?>"><?= $contacts['phone'] ?></a>
                            </div>
                            <div class="work-time"><?= $settings[0]['logoText'] ?></div>
                        </div>
                    </div>
                    <div class="lg col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="logo">
                            <a href="/<?= Yii::$app->language ?>">
                                <?= Html::img('@web/image/logo.png', ['class' => 'img-responsive']); ?>
                            </a>
                        </div>
                    </div>
                    <div class="sc col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="social-networks">
                            <ul>
                                <li>
                                    <a href="<?= $settings[0]['facebook'] ?>">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $settings[0]['twitter'] ?>" target="_blank">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>		
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $settings[0]['google'] ?>">
                                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $settings[0]['youtube'] ?>">
                                        <i class="fa fa-youtube" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-mobile col-xs-12 col-sm-12 hidden-md hidden-lg">
                <div class="container">
                    <div class="left-sidebar col-xs-8 col-sm-8">
                        <div class="logo">
                            <a href="/<?= Yii::$app->language ?>">
                                <?= Html::img('@web/image/logo.png', ['class' => 'img-responsive']); ?>
                            </a>
                        </div>
                    </div>
                    <div class="right-sidebar col-xs-4 col-sm-4">
                        <div class="menu-m-btn">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="language-m col-xs-12">
                        <ul>
                            <?php foreach ($languages as $language): ?>
                                <?php if ($currentUrl != ""): ?>
                                    <li><a href="/<?= $language['short_code'] ?><?= $currentUrl ?>" <?php if (Yii::$app->language == $language['short_code']): ?>class="active-header"<?php endif; ?> ><?= $language['mobile_name'] ?></a></li>
                                <?php else: ?>
                                    <li><a href="/<?= $language['short_code'] ?>" <?php if (Yii::$app->language == $language['short_code']): ?>class="active-header"<?php endif; ?> ><?= $language['mobile_name'] ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>				
                        </ul>
                    </div>
                    <div class="menu-m col-xs-12">
                        <ul class="">

                            <li><a href="/<?= Yii::$app->language ?>" class="<?php echo ($currentUrl == '') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'HOME') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/about" class="<?php echo ($currentUrl == '/about') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'ABOUT US') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/page/news" class="<?php echo ($currentUrl == '/page/news') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'NEWS') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/page/partners" class="<?php echo ($currentUrl == '/page/partners') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'PARTNERS') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/page/service" class="<?php echo ($currentUrl == '/page/service') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'SERVICES') ?></a></li>
                            <li><a href="/<?= Yii::$app->language ?>/contact" class="<?php echo ($currentUrl == '/contact') ? 'active-menu' : ''; ?>"><?= Yii::t('app', 'CONTACTS') ?></a></li>
                            <li>
                                <div class="search-m">
                                    <form action="" method="">
                                        <label>
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                            <input type="submit" name="" value="">
                                        </label>
                                        <input type="search" name="" placeholder="WELCOME TO OUR SHOP">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <section class="main-section">
            <?php echo $content ?>
        </section>


        <footer>
            <div class="footer-wrapper">
                <div class="container">
                    <div class="col-xs-4 col-sm-4 col-md-6 col-lg-6">
                        <div class="logo">
                            <a href="/<?= Yii::$app->language ?>">
                                <?= Html::img('@web/image/logo.png', ['class' => 'img-responsive']); ?>
                            </a>
                        </div>
                    </div>
                    <div class="resp-social col-xs-8 col-sm-8 hidden-md hidden-lg">
                        <ul class="social-m">
                            <li>
                                <a href="<?= $settings[0]['facebook'] ?>">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $settings[0]['twitter'] ?>" target="_blank">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>		
                                </a>
                            </li>
                            <li>
                                <a href="<?= $settings[0]['google'] ?>">
                                    <i class="fa fa-google-plus" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $settings[0]['youtube'] ?>">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                </a>
                            </li>				
                        </ul>
                        <div class="scrollTop">
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="col-xs-12 hidden-xs hidden-sm">
                            <div class="scrollTop">
                                <i class="fa fa-chevron-up" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="company">
                                <span><a href="http://astudio.am/" title="design and developmant" target="_blank">design and developmant by</a> ASTUDIO</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</div>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>