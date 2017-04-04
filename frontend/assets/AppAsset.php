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
        'fonts/css/font-awesome.min.css',
        'css/style.css',
        'css/bootstrap.css',
        'css/lightgallery/lightgallery.css',
      //  'css/carousel/owl.carousel.min.css',
       // 'css/carousel/owl.theme.default.min.css',
    ];
    public $baseUrl = '@web';
    public $js = [
        "js/jquery.js",
        "js/bootstrap.js",
      //  "js/carousel/owl.carousel.js",
        "js/script.js",
        "js/slick/slick.js",
        "js/lightgallery/lightgallery.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
