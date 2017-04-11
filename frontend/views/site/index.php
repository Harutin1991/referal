<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use backend\models\Files;

$this->title = Yii::t('app', 'Home');
?>
<div role="main" class="main">
    <div class="slider-container rev_slider_wrapper" style="height: 600px;">
        <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 800, 'gridheight': 600}">
            <ul>
                <li data-transition="fade">
                    <?=
                    Html::img('@web/img/slides/slide-corporate-6.jpg', ['alt' => 'slider-image',
                        'data-bgposition' => "center center",
                        'data-bgfit' => "cover",
                        'data-bgrepeat' => "no-repeat",
                        'data-kenburns' => "on",
                        'data-duration' => "9000",
                        'data-ease' => "Linear.easeNone",
                        'data-scalestart' => "115",
                        'data-scaleend' => "100",
                        'data-rotatestart' => "0",
                        'data-rotateend' => "0",
                        'data-offsetstart' => "0 -200",
                        'data-offsetend' => "0 200",
                        'data-bgparallax' => "0",
                        'class' => "rev-slidebg"]);
                    ?>

                    <div class="tp-caption tp-caption-overlay tp-caption-overlay-primary main-label"
                         data-x="center"
                         data-y="264"
                         data-start="1200"
                         data-whitespace="nowrap">WELCOME TO Lorem Ispum</div>

                    <div class="tp-caption tp-caption-overlay-opacity bottom-label"
                         data-x="center"
                         data-y="358"
                         data-start="2000"
                         data-transform_in="y:[100%];opacity:0;s:500;">The #1 Lorem ispum is dolar</div>
						 <a href="#">View More</a>

                </li>
                <li data-transition="fade">
                    <?=
                    Html::img('@web/img/demos/digital-agency/slides/slide-digital-agency-1.jpg', ['alt' => 'slider-image',
                        'data-bgposition' => "center center",
                        'data-bgfit' => "cover",
                        'data-bgrepeat' => "no-repeat",
                        'data-kenburns' => "on",
                        'data-duration' => "9000",
                        'data-ease' => "Linear.easeNone",
                        'data-scalestart' => "115",
                        'data-scaleend' => "100",
                        'data-rotatestart' => "0",
                        'data-rotateend' => "0",
                        'data-offsetstart' => "0 -200",
                        'data-offsetend' => "0 200",
                        'data-bgparallax' => "0",
                        'class' => "rev-slidebg"]);
                    ?>

                    <div class="tp-caption tp-caption-overlay tp-caption-overlay-primary main-label"
                         data-x="center"
                         data-y="264"
                         data-start="1200"
                         data-whitespace="nowrap"						 
                         data-transform_in="s:500;">Second carusel lorem</div>

                    <div class="tp-caption tp-caption-overlay-opacity bottom-label"
                         data-x="center"
                         data-y="358"
                         data-start="2000"
                         data-transform_in="y:[100%];opacity:0;s:500;">The #2 Lorem ispum is dolar</div>
						 <a href="#">View More</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row mt-xl">
            <div class="col-md-10 col-md-offset-1">

                <div class="tabs tabs-bottom tabs-center tabs-simple mt-sm mb-xl">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tabsNavigationSimpleIcons1" data-toggle="tab">
                                <span class="featured-boxes featured-boxes-style-6 p-none m-none">
                                    <span class="featured-box featured-box-primary featured-box-effect-6 p-none m-none">
                                        <span class="box-content p-none m-none">
                                            <i class="icon-featured icon-bulb icons"></i>
                                        </span>
                                    </span>
                                </span>									
                                <p class="mb-none pb-none">Strategy</p>
                            </a>
                        </li>
                        <li>
                            <a href="#tabsNavigationSimpleIcons2" data-toggle="tab">
                                <span class="featured-boxes featured-boxes-style-6 p-none m-none">
                                    <span class="featured-box featured-box-primary featured-box-effect-6 p-none m-none">
                                        <span class="box-content p-none m-none">
                                            <i class="icon-featured icon-mustache icons"></i>
                                        </span>
                                    </span>
                                </span>									
                                <p class="mb-none pb-none">Creative</p>
                            </a>
                        </li>
                        <li>
                            <a href="#tabsNavigationSimpleIcons3" data-toggle="tab">
                                <span class="featured-boxes featured-boxes-style-6 p-none m-none">
                                    <span class="featured-box featured-box-primary featured-box-effect-6 p-none m-none">
                                        <span class="box-content p-none m-none">
                                            <i class="icon-featured icon-puzzle icons"></i>
                                        </span>
                                    </span>
                                </span>									
                                <p class="mb-none pb-none">Development</p>
                            </a>
                        </li>
                        <li>
                            <a href="#tabsNavigationSimpleIcons4" data-toggle="tab">
                                <span class="featured-boxes featured-boxes-style-6 p-none m-none">
                                    <span class="featured-box featured-box-primary featured-box-effect-6 p-none m-none">
                                        <span class="box-content p-none m-none">
                                            <i class="icon-featured icon-rocket icons"></i>
                                        </span>
                                    </span>
                                </span>									
                                <p class="mb-none pb-none">Marketing</p>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabsNavigationSimpleIcons1">
                            <div class="center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabsNavigationSimpleIcons2">
                            <div class="center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabsNavigationSimpleIcons3">
                            <div class="center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus.Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabsNavigationSimpleIcons4">
                            <div class="center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="center">
                    <a class="btn btn-default mt-md" href="demo-digital-agency-services.html">Learn More <i class="fa fa-angle-right pl-xs"></i></a>
                </p>
            </div>
        </div>

    </div>
    <section class="section section-default section-default-scale-8">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="mb-none mt-none font-weight-semibold text-light">Who We Are:</h2>
                    <p class="lead mb-xlg">Pellentesque pellentesque eget tempor tellus. </p>
                    <div class="divider divider-primary divider-small divider-small-center mb-xl">
                        <hr>
                    </div>
                    <p class="mb-none text-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula. Fusce eget metus lorem, ac viverra leo. Nullam convallis, arcu vel pellentesque sodales, nisi est varius diam, ac ultrices sem ante quis sem. Proin ultricies volutpat sapien, nec scelerisque ligula mollis lobortis.</p>

                    <a class="btn btn-primary mt-xl mb-sm" href="demo-digital-agency-about.html">Learn More <i class="fa fa-angle-right pl-xs"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-xl mb-none pb-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="mb-none mt-xl font-weight-semibold">Recent Work:</h2>
                    <p class="lead mb-xlg">Pellentesque pellentesque eget tempor tellus. </p>
                    <div class="divider divider-primary divider-small divider-small-center mb-xl">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="carousel-areas mt-xl mb-none">
                        <div class="owl-carousel owl-theme m-none" data-plugin-options="{'autoHeight': true, 'items': 1, 'margin': 10, 'nav': true, 'dots': false, 'stagePadding': 0}">
                            <div>
                                <a href="demo-digital-agency-work-detail.html">
                                    <img alt="" class="img-responsive" src="img/previews/areas/content-7.png">
                                </a>
                            </div>
                            <div>
                                <a href="demo-digital-agency-work-detail.html">
                                    <img alt="" class="img-responsive" src="img/previews/areas/content-5.png">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-tertiary section-front mt-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12 center">
                    <div class="row">
                        <div class="col-md-12 center">
                            <h2 class="mb-none mt-xl font-weight-semibold text-dark">Who Loves Us</h2>
                            <p class="lead mb-xlg">Pellentesque pellentesque eget tempor tellus. </p>
                            <div class="divider divider-primary divider-small divider-small-center mb-xl">
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="testimonial testimonial-style-2 appear-animation" data-appear-animation="fadeInLeft" data-appear-animation-delay="300">
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.</p>
                                </blockquote>
                                <div class="testimonial-arrow-down"></div>
                                <div class="testimonial-author">
                                    <img src="img/clients/client-1.jpg" class="img-responsive img-circle" alt="">
                                    <p><strong>John Smith</strong><span>CEO & Founder - Okler</span></p>
                                </div>
                            </div>
                        </div>								
                        <div class="col-md-4">
                            <div class="testimonial testimonial-style-2 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="600">
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.</p>
                                </blockquote>
                                <div class="testimonial-arrow-down"></div>
                                <div class="testimonial-author">
                                    <img src="img/clients/client-2.jpg" class="img-responsive img-circle" alt="">
                                    <p><strong>Jessica Doe</strong><span>Marketing - Okler</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="testimonial testimonial-style-2 appear-animation" data-appear-animation="fadeInRight" data-appear-animation-delay="700">
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.</p>
                                </blockquote>
                                <div class="testimonial-arrow-down"></div>
                                <div class="testimonial-author">
                                    <img src="img/clients/client-3.jpg" class="img-responsive img-circle" alt="">
                                    <p><strong>Bob Smith</strong><span>CEO & Founder - Okler</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">

        <div class="row mt-xl">
            <div class="counters counters-text-dark">
                <div class="col-md-3 col-sm-6">
                    <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
                        <i class="fa fa-user"></i>
                        <strong data-to="25000" data-append="+">0</strong>
                        <label>Happy Clients</label>
                        <p class="text-color-primary mb-xl">They can’t be wrong</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="600">
                        <i class="fa fa-desktop"></i>
                        <strong data-to="19">0</strong>
                        <label>Premade HomePages</label>
                        <p class="text-color-primary mb-xl">Many more to come</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="900">
                        <i class="fa fa-ticket"></i>
                        <strong data-to="2500" data-append="+">0</strong>
                        <label>Answered Tickets</label>
                        <p class="text-color-primary mb-xl">Satisfaction guaranteed</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="1200">
                        <i class="fa fa-clock-o"></i>
                        <strong data-to="3000" data-append="+">0</strong>
                        <label>Development Hours</label>
                        <p class="text-color-primary mb-xl">Available to you for only $17</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
