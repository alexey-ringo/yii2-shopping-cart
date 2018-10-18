<?php

namespace frontend\assets;

use yii\web\AssetBundle;
//use yii\bootstrap4\BootstrapAsset;


/**
 * Main frontend application asset bundle.
 */
class Bootstrap4EcommerceAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
        'fonts/iconic/css/material-design-iconic-font.min.css',
        'fonts/linearicons-v1.0.0/icon-font.min.css',
        'vendor/animate/animate.css',
        'vendor/css-hamburgers/hamburgers.min.css',
        'vendor/animsition/css/animsition.min.css',
        'vendor/select2/select2.min.css',
        'vendor/daterangepicker/daterangepicker.css',
        'vendor/slick/slick.css',
        'vendor/MagnificPopup/magnific-popup.css',
        'vendor/perfect-scrollbar/perfect-scrollbar.css',
        'css/util.css',
        'css/main.css',
        'css/custom.css',
    ];
    public $js = [
        //'vendor/jquery/jquery-3.2.1.min.js',
        'vendor/animsition/js/animsition.min.js',
        //'vendor/bootstrap/js/popper.js',
        //'vendor/bootstrap/js/bootstrap.min.js',
        'vendor/select2/select2.min.js',
        'js/select2-custom.js',
        'vendor/daterangepicker/moment.min.js',
        'vendor/daterangepicker/daterangepicker.js',
        'vendor/slick/slick.min.js',
        'js/slick-custom.js',
        'vendor/parallax100/parallax100.js',
        'js/parallax100-custom.js',
        'vendor/MagnificPopup/jquery.magnific-popup.min.js',
        'js/magnific-popup-custom.js',
        'vendor/isotope/isotope.pkgd.min.js',
        'vendor/sweetalert/sweetalert.min.js',
        'js/sweetalert-custom.js',
        'vendor/perfect-scrollbar/perfect-scrollbar.min.js',
        'js/perfect-scrollbar-custom.js',
        'js/main.js',
        'js/ecommerce-custom.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        
    ];
    
}
