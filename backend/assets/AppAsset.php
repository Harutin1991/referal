<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/theme.css',
        'vendors/font-awesome/css/font-awesome.min.css',
        'css/styles/black.css',
        'css/panel.css',
        'css/metisMenu.css'
    ];
    public $js = [
        'vendors/fullcalendar/jquery-ui.min.js',
        'js/bootstrap.min.js',
        'vendors/livicons/minified/raphael-min.js',
        'vendors/livicons/minified/livicons-1.4.min.js',
        'js/josh.js',
        'js/metisMenu.js',
        'vendors/holder/holder.js',
        'js/todolist.js',
        'vendors/charts/easypiechart.min.js',
        'vendors/charts/jquery.easypiechart.min.js',
        'vendors/charts/jquery.easingpie.js',
        'vendors/fullcalendar/moment.min.js',
        'vendors/fullcalendar/fullcalendar.min.js',
        'vendors/charts/jquery.flot.min.js',
        'vendors/charts/jquery.flot.resize.min.js',
        'vendors/charts/jquery.sparkline.js',
        'vendors/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'vendors/jvectormap/jquery-jvectormap-world-mill-en.js',
        'vendors/jscharts/Chart.js',
        'js/forms-editing.js',
        //'js/noConflict.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}