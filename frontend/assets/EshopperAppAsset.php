<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class EshopperAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    //    'eshopper/css/bootstrap.min.css',
        'eshopper/css/font-awesome.min.css',
        'eshopper/css/prettyPhoto.css',
        'eshopper/css/price-range.css',
        'eshopper/css/animate.css',
        'eshopper/css/main.css',
        'eshopper/css/responsive.css',
    ];
    public $js = [
    //    'eshopper/js/jquery.js',
    //    'eshopper/js/bootstrap.min.js',
        'eshopper/js/jquery.scrollUp.min.js',
        'eshopper/js/price-range.js',
        'eshopper/js/jquery.prettyPhoto.js',
        'eshopper/js/jquery.cookie.js',
        'eshopper/js/jquery.accordion.js',
        'eshopper/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
