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
        'css/bootstrap.min.css',
        'css/custom.css',
        'css/tabbular.css',
        'css/jquery.circliful.css',
        'vendors/owl-carousel/owl.carousel.css',
        'vendors/owl-carousel/owl.theme.css',
      //  'css/carousel/owl.carousel.min.css',
       // 'css/carousel/owl.theme.default.min.css',
    ];
    public $baseUrl = '@web';
    public $js = [
        "js/jquery.min.js",
        "js/bootstrap.min.js",
        "js/raphael.js",
        "js/livicons-1.4.min.js",
        "js/josh_frontend.js",
        "js/jquery.circliful.js",
        "vendors/owl-carousel/owl.carousel.js",
        "js/carousel.js",
        "js/index.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
