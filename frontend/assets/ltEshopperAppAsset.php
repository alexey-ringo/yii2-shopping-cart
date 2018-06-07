<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ltEshopperAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
   
    public $js = [
        'eshopper/js/html5shiv.js',
        'eshopper/js/respond.min.js',
    ];
    public $jsOptions = [
        'condition' => 'lte IE9',
        'position' => \yii\web\View::POS_HEAD
    ];
}
