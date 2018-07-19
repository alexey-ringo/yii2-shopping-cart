<?php

namespace frontend\assets;

use yii\web\AssetBundle;
//use yii\bootstrap4\BootstrapAsset;


/**
 * Main frontend application asset bundle.
 */
class Btstrp4EssenceAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    //    'estore/css/bootstrap.min.css',
        'css/classy-nav.min.css',
        'css/owl.carousel.css',
        'css/animate.css',
        'css/coza-select2.css',
        'css/magnific-popup.css',
        'css/jquery-ui.min.css',
        'css/nice-select.css',
        'css/font-awesome.min.css',
        'css/coza-util.css',
        //'css/coza-main.css',
        'css/core-style.css',
        
        
        
    ];
    public $js = [
    //    'estore/js/jquery.js',
    //    'estore/js/bootstrap.min.js',
    //    'js/popper.min.js',
        'js/plugins.js',
        'js/coza-select2.js',
        'js/classy-nav.min.js',
        'js/jquery.cookie.js',
        'js/jquery.accordion.js',
        'js/active.js',
        
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        
    ];
    
}
