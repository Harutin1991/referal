<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Files;

$this->title = Yii::t('app', 'Our News') . ' - ' . $news[0]['name'];
?>
<div class="main-section">
    <div class="container">
        <div class="service-page col-xs-12">
<?php echo Files::getImagesToFront('news', $news[0]['news_id'], 'img-responsive', $news[0]['name'], 1) ?>
            <div class="title"><?= $news[0]['name'] ?></div>
            <div class="txt"><?= $news[0]['description'] ?></div>
        </div>
    </div>
</div>

<div class="main-section">
    <div class="gallery-page">
        <div class="information">
            <div class="container">
                <div class="description">
                    <div class="title">
                        <a href="gallery.html"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a><?= $news[0]['name'] ?>
                    </div>
                    <div class="txt"><?= $news[0]['description'] ?></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="fild col-xs-12">
                <div class="left-bar col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="carousel">
                        <div class="left-part">
                            <div id="thumbs2">
                                <div class="inner">
                                    <ul id="minSlider">
                                        <li>
                                            <a class="thumb" href="image/product.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product-1.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product-2.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product-1.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product-2.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product-1.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product-2.jpg"></a>
                                        </li>
                                        <li>
                                            <a class="thumb" href="image/product.jpg"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="right-part">
                            <img class="bigImg img-responsive" src="image/product-1.jpg">
                        </div>
                    </div>
                </div>
                <div class="right-bar col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="work-info">
                        <div class="title">
                            WORK NAME
                        </div>
                        <div class="txt">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.	
                        </div>
                        <div class="address">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            Lorem ipsum dolor sit amet.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>