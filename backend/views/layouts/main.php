<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\Language;
use backend\models\Pages;

AppAsset::register($this);
$currentUrl = trim(substr($_SERVER['REQUEST_URI'], 3));
$languages = Language::find()->asArray()->all();
$pages = Pages::find()->asArray()->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="keywords" content="HTML5 Bootstrap 3 Admin Template UI Theme"/>
        <meta name="description" content="AdminDesigns - A Responsive HTML5 Admin UI Framework">
        <meta name="author" content="AdminDesigns">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head(); ?>

        <link rel="shortcut icon" href="/img/favicon.png">
    </head>
    <body class="skin-josh">
        <?php $this->beginBody() ?>

        <header class="header">
            <a href="index.html" class="logo">
                <?= Html::img('@web/img/logo.png', ['class' => 'img-responsive message-image']); ?>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <div>
                    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                        <div class="responsive_nav"></div>
                    </a>
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="livicon" data-name="message-flag" data-loop="true" data-color="#42aaca" data-hovercolor="#42aaca" data-size="28"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages pull-right">
                                <li class="dropdown-title">4 New Messages</li>
                                <li class="unread message">
                                    <a href="javascript:;" class="message"> <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read"><span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span></i>
                                        <?= Html::img('@web/img/authors/avatar.jpg', ['class' => 'img-responsive message-image']); ?>
                                        <div class="message-body">
                                            <strong>Riot Zeast</strong>
                                            <br>Hello, You there?
                                            <br>
                                            <small>8 minutes ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li class="unread message">
                                    <a href="javascript:;" class="message">
                                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read"><span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span></i>
                                        <?= Html::img('@web/img/authors/avatar1.jpg', ['class' => 'img-responsive message-image']); ?>
                                        <div class="message-body">
                                            <strong>John Kerry</strong>
                                            <br>Can we Meet ?
                                            <br>
                                            <small>45 minutes ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li class="unread message">
                                    <a href="javascript:;" class="message">
                                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                                            <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                                        </i>
                                        <?= Html::img('@web/img/authors/avatar5.jpg', ['class' => 'img-responsive message-image']); ?>
                                        <div class="message-body">
                                            <strong>Jenny Kerry</strong>
                                            <br>Dont forgot to call...
                                            <br>
                                            <small>An hour ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li class="unread message">
                                    <a href="javascript:;" class="message">
                                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                                            <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                                        </i>
                                        <img src="img/authors/avatar4.jpg" class="img-responsive message-image" alt="icon" />
                                        <div class="message-body">
                                            <strong>Ronny</strong>
                                            <br>Hey! sup Dude?
                                            <br>
                                            <small>3 Hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li class="footer">
                                    <a href="#">View all</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f" data-hovercolor="#e9573f" data-size="28"></i>
                                <span class="label label-warning">7</span>
                            </a>
                            <ul class=" notifications dropdown-menu">
                                <?php foreach ($languages as $language): ?>
                                    <?php if (Yii::$app->language == $language['short_code']): ?>
                                        <li class="dropdown-title"><?= $language['name'] ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php foreach ($languages as $language): ?>
                                            <?php if (Yii::$app->language != $language['short_code']): ?>
                                                <li>
                                                    <a href="<?= $url = Url::to(['/' . $currentUrl, 'language' => $language['short_code']]) ?>">
                                                        <span class="flag-xs flag-<?php echo $language['short_code'] ?> mr10"></span> <?php echo $language['name'] ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f" data-hovercolor="#e9573f" data-size="28"></i>
                                <span class="label label-warning">7</span>
                            </a>
                            <ul class=" notifications dropdown-menu">
                                <li class="dropdown-title">You have 7 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <i class="livicon danger" data-n="timer" data-s="20" data-c="white" data-hc="white"></i>
                                            <a href="#">after a long time</a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                                Just Now
                                            </small>
                                        </li>
                                        <li>
                                            <i class="livicon success" data-n="gift" data-s="20" data-c="white" data-hc="white"></i>
                                            <a href="#">Jef's Birthday today</a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                                Few seconds ago
                                            </small>
                                        </li>
                                        <li>
                                            <i class="livicon warning" data-n="dashboard" data-s="20" data-c="white" data-hc="white"></i>
                                            <a href="#">out of space</a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                                8 minutes ago
                                            </small>
                                        </li>
                                        <li>
                                            <i class="livicon bg-aqua" data-n="hand-right" data-s="20" data-c="white" data-hc="white"></i>
                                            <a href="#">New friend request</a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                                An hour ago
                                            </small>
                                        </li>
                                        <li>
                                            <i class="livicon danger" data-n="shopping-cart-in" data-s="20" data-c="white" data-hc="white"></i>
                                            <a href="#">On sale 2 products</a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                                3 Hours ago
                                            </small>
                                        </li>
                                        <li>
                                            <i class="livicon success" data-n="image" data-s="20" data-c="white" data-hc="white"></i>
                                            <a href="#">Lee Shared your photo</a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                                Yesterday
                                            </small>
                                        </li>
                                        <li>
                                            <i class="livicon warning" data-n="thumbs-up" data-s="20" data-c="white" data-hc="white"></i>
                                            <a href="#">David liked your photo</a>
                                            <small class="pull-right">
                                                <span class="livicon paddingright_10" data-n="timer" data-s="10"></span>
                                                2 July 2014
                                            </small>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?= Html::img('@web/img/authors/avatar3.jpg', ['class' => 'img-circle img-responsive pull-left', 'width' => '35', 'height' => '35']); ?>
                                <div class="riot">
                                    <div>
                                        Riot
                                        <span>
                                            <i class="caret"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <?= Html::img('@web/img/authors/avatar3.jpg', ['class' => 'img-responsive img-circle']); ?>
                                    <p class="topprofiletext">Riot Zeast</p>
                                </li>
                                <!-- Menu Body -->
                                <li>
                                    <a href="#">
                                        <i class="livicon" data-name="user" data-s="18"></i> My Profile
                                    </a>
                                </li>
                                <li role="presentation"></li>
                                <li>
                                    <a href="#">
                                        <i class="livicon" data-name="gears" data-s="18"></i> Account Settings
                                    </a>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                    </div>
                                    <div class="pull-right">
                                        <?= Html::a('<i class="livicon" data-name="sign-out" data-s="18"></i>' . Yii::t('app', 'Logout') . '(' . Yii::$app->user->identity->username . ')', ['/site/logout']) ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar ">
                    <div class="page-sidebar  sidebar-nav">
                        <div class="nav_icons">
                            <ul class="sidebar_threeicons">
                                <li>
                                    <a href="form_builder.html">
                                        <i class="livicon" data-name="hammer" title="Form Builder 1" data-loop="true" data-color="#42aaca" data-hc="#42aaca" data-s="25"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="form_builder2.html">
                                        <i class="livicon" data-name="list-ul" title="Form Builder 2" data-loop="true" data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="buttonbuilder.html">
                                        <i class="livicon" data-name="vector-square" title="Button Builder" data-loop="true" data-color="#f6bb42" data-hc="#f6bb42" data-s="25"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="page_builder.html">
                                        <i class="livicon" data-name="new-window" title="Page Builder" data-loop="true" data-color="#37bc9b" data-hc="#37bc9b" data-s="25"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <!-- BEGIN SIDEBAR MENU -->
                        <ul id="menu" class="page-sidebar-menu">
                            <li <?php if ($currentUrl == "/site/index"): ?>class="active"<?php endif ?>>
                                <a href="/">
                                    <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                    <span class="title"><?= Yii::t('app', 'Dashboard') ?></span>
                                </a>
                            </li>
                            <li <?php if ($currentUrl == "/blog/index" || $currentUrl == "/blog/create" || $currentUrl == '/blog-categories/index' || $currentUrl == '/blog-categories/create'): ?>class="active"<?php endif ?>>
                                <a href="javascript:void(0)">
                                    <i class="livicon" data-name="comment" data-c="#F89A14" data-hc="#F89A14" data-size="18" data-loop="true"></i>
                                    <span class="title"><?= Yii::t('app', 'Blog') ?></span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if ($currentUrl == "/blog/index"): ?>class="active"<?php endif ?> >
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Blog List'), Url::to(['blog/index'])) ?>
                                    </li>
                                    <li <?php if ($currentUrl == "/blog-categories/index"): ?>class="active"<?php endif ?> >
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Blog Categories'), Url::to(['blog-categories/index'])) ?>
                                    </li>
                                    <li <?php if ($currentUrl == "/blog/create"): ?>class="active"<?php endif ?> >
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Add New Blog'), Url::to(['blog/create'])) ?>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if ($currentUrl == "/user/index" || $currentUrl == "/user/create"): ?>class="active"<?php endif ?>>
                                <a href="#">
                                    <i class="livicon" data-name="users" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                                    <span class="title">Users</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Users List'), Url::to(['user/index'])) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Add New User'), Url::to(['user/create'])) ?>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if ($currentUrl == '/news/index' || $currentUrl == '/news/create'): ?>class="active"<?php endif ?>>
                                <a href="#">
                                    <i class="livicon" data-name="move" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                                    <span class="title"><?= Yii::t('app', 'News') ?></span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if ($currentUrl == "/news/index"): ?>class="active"<?php endif ?> >
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'News List'), Url::to(['news/index'])) ?>
                                    </li>
                                    <li <?php if ($currentUrl == "/news/create"): ?>class="active"<?php endif ?> >
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Add News'), Url::to(['news/create'])) ?>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if ($currentUrl == '/pages/index' || $currentUrl == '/pages/create'): ?>class="active"<?php endif ?>>
                                <a href="javascript:void(0)">
                                    <i class="livicon" data-name="flag" data-c="#418bca" data-hc="#418bca" data-size="18" data-loop="true"></i>
                                    <span class="title"><?= Yii::t('app', 'Pages') ?></span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if ($currentUrl == "/pages/index"): ?>class="active"<?php endif ?> >
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'List of Pages'), Url::to(['pages/index'])) ?>
                                    </li>
                                    <li <?php if ($currentUrl == "/pages/create"): ?>class="active"<?php endif ?> >
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Add New Page'), Url::to(['pages/create'])) ?>
                                    </li>
                                    <?php foreach ($pages as $page): ?>
                                        <li>
                                            <a href="<?= Url::to(['pages/update', 'id' => $page['id']]) ?>">
                                                <i class="fa fa-angle-double-right"></i> <?= $page['title'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    <li>
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Calculator'), Url::to(['calculator/index'])) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'About Us'), Url::to(['aboutus/index'])) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('<i class="fa fa-angle-double-right"></i>' . Yii::t('app', 'Contact Us'), Url::to(['contactus/index'])) ?>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?= Url::to('/content/index') ?>">
                                    <i class="livicon" data-name="brush" data-c="#F89A14" data-hc="#F89A14" data-size="18" data-loop="true"></i>
                                    <?= Yii::t('app', 'Content') ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?= Url::to('/faq/index') ?>">
                                    <i class="livicon" data-name="medal" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                                    <?= Yii::t('app', 'Faq') ?>
                                </a>
                            </li>
							<li>
                                <a href="<?= Url::to('/source-message/index') ?>">
                                    <i class="livicon" data-c="#EF6F6C" data-hc="#EF6F6C" data-name="list-ul" data-size="18" data-loop="true"></i>
                                    <?= Yii::t('app', 'Language Managment') ?>
                                </a>
                            </li>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>
                </section>
                <!-- /.sidebar -->
            </aside>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!--div class="alert alert-success alert-dismissable margin5">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Success:</strong> You have successfully logged in.
                </div -->
                <!-- Main content -->
                <section class="content-header">
                    <h1><?= $this->title ?></h1>
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?php
                    /* Breadcrumbs::widget([
                      'itemTemplate' => "<li>{link}</li>\n",
                      'links' => [
                      [
                      'label' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                      'url' => ['post-category/view', 'id' => 10],
                      'template' => "<li><b>{link}</b></li>\n", // template for this link only
                      ],
                      ['label' => 'Sample Post', 'url' => ['post/edit', 'id' => 1]],
                      'Edit',
                      ],
                      ]);

                      echo Breadcrumbs::widget([
                      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                      ]); */
                    ?>
                </section>
                <section class="content">
                    <?= $content ?>
                </section>
            </aside>
            <!-- right-side -->
        </div>
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
            <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
        </a>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
