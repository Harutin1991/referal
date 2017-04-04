<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      //  'css/bootstrap.min.css',
        'css/pages/login.css',
    ];
    public $js = [
        'js/jquery-1.11.3.min.js',
        'js/bootstrap.min.js',
        'vendors/livicons/minified/raphael-min.js',
        'vendors/livicons/minified/livicons-1.4.min.js',
        'js/josh.js',
        'js/metisMenu.js',
        'vendors/holder/holder.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}