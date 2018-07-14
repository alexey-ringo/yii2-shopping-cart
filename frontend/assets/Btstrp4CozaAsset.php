<?php

namespace frontend\assets;

use yii\web\AssetBundle;
//use yii\bootstrap4\BootstrapAsset;


/**
 * Main frontend application asset bundle.
 */
class Btstrp4CozaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    //    'estore/css/bootstrap.min.css',
        'estore/css/font-awesome.min.css',
        'estore/css/prettyPhoto.css',
        'estore/css/price-range.css',
        'estore/css/animate.css',
        'estore/css/main.css',
        'estore/css/responsive.css',
    ];
    public $js = [
    //    'estore/js/jquery.js',
    //    'estore/js/bootstrap.min.js',
        'estore/js/jquery.scrollUp.min.js',
        'estore/js/price-range.js',
        'estore/js/jquery.prettyPhoto.js',
        'estore/js/jquery.cookie.js',
        'estore/js/jquery.accordion.js',
        'estore/js/main.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        
    ];
    
}
