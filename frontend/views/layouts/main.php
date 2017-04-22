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
use backend\models\Pages;

$languages = Language::find()->asArray()->all();

$action = Yii::$app->controller->action->id;
$controller = Yii::$app->controller->id;

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
                                        <div class="registration">
                                            <a href="#">Регистрация</a>
                                        </div>
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
                                        <div class="registration">
                                            <a href="#">Регистрация</a>
                                        </div>
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
						<a href="http://studionomad.kz/" target="_blank"><?=Yii::t('app','design and developmant by')?></a> <span>Studio Nomad</span>	
					</div>
                </div>
            </div>
        </footer>
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>