<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    
    
    public $basePath = '@webroot';
    public $css = [
        'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'vendor/animate/animate.min.css',
        'vendor/simple-line-icons/css/simple-line-icons.min.css',
        'vendor/owl.carousel/assets/owl.carousel.min.css',
        'vendor/owl.carousel/assets/owl.theme.default.min.css',
        'vendor/magnific-popup/magnific-popup.min.css',
        'css/theme.css',
        'css/theme-elements.css',
        'css/theme-blog.css',
        'css/theme-shop.css',
        'vendor/rs-plugin/css/settings.css',
        'vendor/rs-plugin/css/layers.css',
        'vendor/rs-plugin/css/navigation.css',
        'css/skins/skin-digital-agency.css',
        'css/demos/demo-digital-agency.css',
        'css/custom.css',
//        'css/custom.css',
//        'css/tabbular.css',
//        'css/jquery.circliful.css',
//        'vendors/owl-carousel/owl.carousel.css',
//        'vendors/owl-carousel/owl.theme.css',
      //  'css/carousel/owl.carousel.min.css',
       // 'css/carousel/owl.theme.default.min.css',
    ];
    public $baseUrl = '@web';
    public $js = [
        "master/style-switcher/style.switcher.localstorage.js",
        "vendor/modernizr/modernizr.min.js",
        "vendor/jquery/jquery.min.js",
        "vendor/jquery.appear/jquery.appear.min.js",
        "vendor/jquery.easing/jquery.easing.min.js",
        "vendor/jquery-cookie/jquery-cookie.min.js",
        "master/style-switcher/style.switcher.js",
        "vendor/bootstrap/js/bootstrap.min.js",
        "vendor/common/common.min.js",
        "vendor/jquery.validation/jquery.validation.min.js",
        "vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js",
        "vendor/jquery.gmap/jquery.gmap.min.js",
        "vendor/jquery.lazyload/jquery.lazyload.min.js",
        "vendor/isotope/jquery.isotope.min.js",
        "vendor/owl.carousel/owl.carousel.min.js",
        "vendor/magnific-popup/jquery.magnific-popup.min.js",
        "vendor/vide/vide.min.js",
        "js/theme.js",
        "js/views/view.contact.js",
        "vendor/rs-plugin/js/jquery.themepunch.tools.min.js",
        "vendor/rs-plugin/js/jquery.themepunch.revolution.min.js",
        "js/custom.js",
        "js/theme.init.js",
//        "js/bootstrap.min.js",
//        "js/raphael.js",
//        "js/livicons-1.4.min.js",
//        "js/josh_frontend.js",
//        "js/jquery.circliful.js",
//        "vendors/owl-carousel/owl.carousel.js",
//        "js/carousel.js",
//        "js/index.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
