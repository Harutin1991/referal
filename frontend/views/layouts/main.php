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
        <!-- Header Start -->
        <header>
            <!-- Icon Section Start -->
            <!--div class="icon-section">
                <div class="container">
                    <ul class="list-inline">
                        <li>
                            <a href="#"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="twitter" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="google-plus" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="linkedin" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="rss" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li class="pull-right">
                            <ul class="list-inline icon-position">
                                <li>
                                    <a href="mailto:"><i class="livicon" data-name="mail" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                    <label class="hidden-xs"><a href="mailto:" class="text-white">info@joshadmin.com</a></label>
                                </li>
                                <li>
                                    <a href="tel:"><i class="livicon" data-name="phone" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                    <label class="hidden-xs"><a href="tel:"class="text-white">(703) 717-4200</a></label>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div -->
            <!-- //Icon Section End -->
            <!-- Nav bar Start -->
            <nav class="navbar navbar-default container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                        <span><a href="#"> <i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true" data-c="#757b87" data-hc="#ccc"></i>
                            </a></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <?= Html::img('@web/images/logo_ref.png', ['class' => 'logo_position']); ?>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="index.html"> Home</a>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Features</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="typography.html">Typography</a>
                                </li>
                                <li><a href="advancedfeatures.html">Advanced Features</a>
                                </li>
                                <li><a href="grid.html">Grid System</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Pages</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="aboutus.html">About Us</a>
                                </li>
                                <li><a href="timeline.html">Timeline</a></li>
                                <li><a href="price.html">Price</a>
                                </li>
                                <li><a href="404.html">404 Error</a>
                                </li>
                                <li><a href="500.html">500 Error</a>
                                </li>
                                <li><a href="faq.html">FAQ</a>
                                </li>
                                <li><a href="blank_page.html"> Blank</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Shop</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="products.html">Products</a>
                                </li>
                                <li><a href="single_product.html">Single_Product</a>
                                </li>
                                <li><a href="compareproducts.html">Compare Products</a>
                                </li>
                                <li><a href="category.html">Categories</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Portfolio</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="portfolio.html">Portfolio</a>
                                </li>
                                <li><a href="portfolioitem.html">Portfolio Item</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> News</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="news.html">News</a>
                                </li>
                                <li><a href="news_item.html">News Item</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Blog</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="blog.html">Blog</a>
                                </li>
                                <li><a href="blogitem.html">Blog Item</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Nav bar End -->
        </header>
        <?php echo $content ?>
        <footer>
            <!-- Footer Container Start -->
            <div class="container footer-text">
                <!-- About Us Section Start -->
                <div class="col-sm-4">
                    <h4>About Us</h4>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                    <h4>Follow Us</h4>
                    <ul class="list-inline">
                        <li>
                            <a href="#"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="twitter" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="google-plus" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="linkedin" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- //About Us Section End-->
                <!-- Contact Section Start -->
                <div class="col-sm-4">
                    <h4>Contact Us</h4>
                    <ul class="list-unstyled">
                        <li>35,Lorem Lis Street, Park Ave</li>
                        <li>Lis Street, India.</li>
                        <li><i class="livicon icon4 icon3" data-name="cellphone" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>Phone:9140 123 4588</li>
                        <li><i class="livicon icon4 icon3" data-name="printer" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Fax:400 423 1456</li>
                        <li><i class="livicon icon3" data-name="mail-alt" data-size="20" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Email:<span class="success">
                                <a href="mailto:">info@joshadmin.com</a></span>
                        </li>
                        <li><i class="livicon icon4 icon3" data-name="skype" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Skype:
                            <span class="success">Joshadmin</span>
                        </li>
                    </ul>
                    <div class="news">
                        <h4>News letter</h4>
                        <p>subscribe to our newsletter and stay up to date with the latest news and deals</p>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="yourmail@mail.com" aria-describedby="basic-addon2">
                            <a href="#" class="btn btn-primary text-white" role="button">Subscribe</a>
                        </div>
                    </div>
                </div>
                <!-- //Contact Section End -->
                <!-- Recent post Section Start -->
                <div class="col-sm-4">
                    <h4>Recent Posts</h4>
                    <div class="media">
                        <div class="media-left media-top">
                            <a href="#">
                                <img class="media-object" src="images/image_14.jpg" alt="image">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="media-heading">Lorem Ipsum is simply dummy text of the printing and type setting industry dummy.
                                <br />
                            <div class="pull-right"><i>John Doe</i></div>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left media-top">
                            <a href="#">
                                <img class="media-object" src="images/image_15.jpg" alt="image">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="media-heading">Lorem Ipsum is simply dummy text of the printing and type setting industry dummy.
                                <br />
                            <div class="pull-right"><i>John Doe</i></div>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left media-top">
                            <a href="#">
                                <img class="media-object" src="images/image_13.jpg" alt="image">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="media-heading">Lorem Ipsum is simply dummy text of the printing and type setting industry dummy.
                                <br />
                            <div class="pull-right"><i>John Doe</i></div>
                            </p>
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-left media-top">
                            <a href="#">
                                <img class="media-object" src="images/c1.jpg" alt="image">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="media-heading">Lorem Ipsum is simply dummy text of the printing and type setting industry dummy.
                                <br />
                            <div class="pull-right"><i>John Doe</i></div>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- //Recent Post Section End -->
            </div>
            <!-- Footer Container Section End -->
        </footer>
        <!-- //Footer Section End -->
        <!-- Copy right Section Start -->
        <div class="copyright">
            <div class="container">
                <p>Copyright &copy; Josh Admin Template, 2015</p>
            </div>
        </div>
        <!-- Copy right Section End -->
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
            <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
        </a>

    </div>
</div>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>