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
use backend\models\Sitesettings;

$languages = Language::find()->asArray()->all();
$categories = Category::findList('', true);

$action = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;

$session = Yii::$app->session;
AppAsset::register($this);
$this->title = Yii::t('app', 'Product');
?>
<?php $this->beginPage() ?>
<?php
$languege = Language::find()->where(['short_code' => Yii::$app->language])->asArray()->all();
$isDefaultLanguage = $languege[0]['is_default'];
$settings = Sitesettings::find_One();
$currentUrl = trim(substr($_SERVER['REQUEST_URI'], 3));
$cat_array = explode('/', $currentUrl);
$cat = end($cat_array);

$session = Yii::$app->session;
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
        <link rel="icon" href="/image/fave.png" type="image/gif" sizes="16x16">
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
            <div class="header-banner-secound hidden-xs hidden-sm hidden-md">
                <div class="header">
                    <div class="container">	
                        <div class="left-sidebar col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="logo col-xs-12">
                                <a href="/<?= Yii::$app->language ?>">
                                    <?= Html::img('@web/image/sitefile/logo-pages.png'); ?>
                                </a>
                            </div>
                            <div class="logo-txt hidden"><?= $settings[0]['logoText'] ?></div>
                        </div>
                        <div class="right-sidebar col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <div class="social-language col-xs-12">
                                <div class="search col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                    <form action="" method="">
                                        <div class="search-type">
                                            <input type="search" name="search" placeholder="search...">
                                            <input type="submit" name="" value="">
                                        </div>	
                                    </form>
                                </div>
                                <div class="social col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                    <ul>
                                        <li>
                                            <a href="<?= $settings[0]['facebook'] ?>">
                                                <i class="fa fa-facebook" aria-hidden="true"></i>
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
                                        <li>
                                            <a href="">
                                                <i class="fa fa-rss" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="language col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                    <ul>
                                        <?php foreach ($languages as $language): ?>
                                            <li><a href="/<?= $language['short_code'] ?><?= $currentUrl ?>" <?php if (Yii::$app->language == $language['short_code']): ?>class="active-border"<?php endif; ?>><?= $language['name'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="menu col-xs-12">
                                <ul>
                                    <li><a href="/" class="<?php echo ($currentUrl == '') ? 'active' : ''; ?>">Home</a></li>
                                    <li> 
                                        <a href="/<?= Yii::$app->language ?>/about" data-subcategories="1" class="<?php echo ($currentUrl == '/about') ? 'active' : ''; ?>">
                                            About us</a></li>
                                    <li><a href="/<?= Yii::$app->language ?>/product/" class="<?php echo ($currentUrl == '/product' || strcmp($currentUrl, "/product/") != -1) ? 'active' : ''; ?>"><?= Yii::t('app', 'Products') ?></a></li>
                                    <li><a href="/<?= Yii::$app->language ?>/page/news" class="<?php echo ($currentUrl == '/news') ? 'active' : ''; ?>"><?= Yii::t('app', 'Our News') ?></a></li>
                                    <li><a href="/<?= Yii::$app->language ?>/page/service" class="<?php echo ($currentUrl == '/service') ? 'active' : ''; ?>"><?= Yii::t('app', 'Servces') ?></a></li>
                                    <li><a href="javascript:void(0)" class="contact"><?= Yii::t('app', 'Contacts') ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-banner-secound col-xs-12 hidden-lg">
                <div class="header">
                    <div class="container">	
                        <div class="left-sidebar col-xs-3 col-sm-4 col-md-4 col-lg-4">
                            <div class="logo col-xs-12">
                                <a href="/<?= Yii::$app->language ?>">
                                    <?= Html::img('@web/image/logo-mobile.png'); ?>
                                </a>
                            </div>
                            <div class="logo-txt hidden"><?= $settings[0]['logoText'] ?></div>
                        </div>
                        <div class="right-sidebar col-xs-9 col-sm-8 col-md-8 col-lg-8">
                            <div class="social-language col-xs-10 col-md-12 col-lg-12">
                                <div class="search hidden-xs hidden-sm col-md-6 col-lg-7">
                                    <form action="" method="">
                                        <div class="search-type">
                                            <input type="search" name="search" placeholder="search...">
                                            <input type="submit" name="" value="">
                                        </div>	
                                    </form>
                                </div>
                                <div class="social col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                    <ul>
                                        <li>
                                            <a href="<?= $settings[0]['facebook'] ?>">
                                                <i class="fa fa-facebook" aria-hidden="true"></i>
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
                                        <li>
                                            <a href="">
                                                <i class="fa fa-rss" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="language col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <ul>
                                        <?php foreach ($languages as $language): ?>
                                            <li><a href="/<?= $language['short_code'] ?><?= $currentUrl ?>" <?php if (Yii::$app->language == $language['short_code']): ?>class="active-border"<?php endif; ?>><?= $language['name'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-2 mobile-m hidden-md hidden-lg">
                                <span class="btn-m">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="menu col-xs-6 col-md-12 col-lg-12">
                                <ul>
                                    <li><a href="/" class="<?php echo ($currentUrl == '') ? 'active' : ''; ?>"><?= Yii::t('app', 'Home') ?></a></li>
                                    <li> 
                                        <a href="/<?= Yii::$app->language ?>/about" data-subcategories="1" class="<?php echo ($currentUrl == '/about') ? 'active' : ''; ?>">
                                            <?= Yii::t('app', 'About us') ?></a>
                                    </li>
                                    <li><a href="/<?= Yii::$app->language ?>/product/" class="<?php echo ($currentUrl == '/product' || strcmp($currentUrl, "/product/") != -1) ? 'active' : ''; ?>"><?= Yii::t('app', 'Products') ?></a></li>
                                    <li><a href="/<?= Yii::$app->language ?>/page/news" class="<?php echo ($currentUrl == '/news') ? 'active' : ''; ?>"><?= Yii::t('app', 'Our News') ?></a></li>
                                    <li><a href="/<?= Yii::$app->language ?>/page/service" class="<?php echo ($currentUrl == '/service') ? 'active' : ''; ?>"><?= Yii::t('app', 'Servces') ?></a></li>
                                    <li><a href="javascript:void(0)" class="contact"><?= Yii::t('app', 'Contacts') ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="menu-m col-xs-12 hidden-md hidden-lg">
                            <ul>
                                <li><a href="/" class="<?php echo ($currentUrl == '') ? 'active' : ''; ?>"><?= Yii::t('app', 'Home') ?></a></li>
                                <li> 
                                    <a href="/<?= Yii::$app->language ?>/about" data-subcategories="1" class="<?php echo ($currentUrl == '/about') ? 'active' : ''; ?>">
                                        <?= Yii::t('app', 'About us') ?></a>
                                </li>
                                <li>
                                    <a href="/<?= Yii::$app->language ?>/product/" >
                                        <?= Yii::t('app', 'Products') ?> 
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </a>
                                    <ul class="sub-menu-m">
                                        <?php foreach ($categories as $category): ?>
                                            <li>
                                                <?php echo Files::getImagesToFront('category', $category['id'], '', $category['name']) ?>
                                                <a href="/product/<?= $category['route_name'] ?>"><?= $category['name'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                                <li><a href="/<?= Yii::$app->language ?>/page/news" class="<?php echo ($currentUrl == '/news') ? 'active' : ''; ?>"><?= Yii::t('app', 'Our News') ?></a></li>
                                <li><a href="/<?= Yii::$app->language ?>/page/service" class="<?php echo ($currentUrl == '/service') ? 'active' : ''; ?>"><?= Yii::t('app', 'Servces') ?></a></li>
                                <li><a href="javascript:void(0)" class="contact"><?= Yii::t('app', 'Contacts') ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="main-section">
            <div class="products-page">
                <div class="products-menu">
                    <div class="container">
                        <div class="products">
                            <?php foreach ($categories as $category): ?>
                                <div class="box <?php if ($category['route_name'] == $cat): ?>activefild<?php endif; ?> col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                    <a href="/product/<?= $category['route_name'] ?>">
                                        <?php echo Files::getImagesToFront('category', $category['id'], '', $category['name']) ?>
                                        <span class="title"><?= $category['name'] ?></span>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php echo $content ?>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="contact-info col-xs-12">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="information">
                            <div class="title">
                                OUR CONTACTS
                            </div>
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    Lorem Ipsum Lorem Ipsum
                                </li>
                                <li>
                                    <a href="tel:+1234567890">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        +7 (495)  205 - 90 - 66
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:astudio@live.ru" target="_blank">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        astudio@live.ru
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="email">
                            <form action="" method="">
                                <textarea name=""></textarea>
                                <input type="email" name="" placeholder="your email" required>
                                <input type="submit" name="" value="SEND">
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d97584.07285752922!2d44.41852746766333!3d40.1533693010793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406aa2dab8fc8b5b%3A0x3d1479ae87da526a!2z0JXRgNC10LLQsNC9LCDQkNGA0LzQtdC90LjRjw!5e0!3m2!1sru!2s!4v1487163893758" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
                        <div class="scrollTop">
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="copyright col-xs-12">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="logo">
                            <a href="index.html">
                                <img src="/image/logo.png" alt="">
                            </a>
                        </div>	
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="company">
                            <span><a href="http://astudio.am/" title="design and developmant" target="_blank">design and developmant by</a> ASTUDIO</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
