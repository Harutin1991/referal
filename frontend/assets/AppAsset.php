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
        'css/bootstrap.css',
        'fonts/css/font-awesome.min.css',
        'css/style.css'
    ];
    public $baseUrl = '@web';
    public $js = [
        "js/jquery.js",
        "js/bootstrap.js",
        "js/script.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
