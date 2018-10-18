<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    //Роут по умолчанию
    'defaultRoute' => 'category/index',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        /* компонент приложения (yii\web\User), ответственный за авторизацию и аутентификацию пользователей */
        'user' => [
            //Указали класс User (ActiveRecord!!), работающий с таблицей пользователей
            //Данный класс обязательно должен иметь реализацию IdentityInterface
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
            'class' => 'yii\web\DbSession',
            //'class' => 'frontend\components\FrontDbSession',
           //'timeout' => '31536000',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'как должна выглядеть реальный URL в браузере' => 'controller/action'
                //Конкретные правила всегда раньше, чем общие правила!
                //более конкретное частное правило для отображения красивого url при пагинации (без get-парам)
                'category/<id:\d+>/page/<page:\d+>' => 'category/view',
                //это более общее правило - после категории по маске только цифровые значения
                'category/<id:\d+>' => 'category/view',
                'product/<id:\d+>' => 'product/view',
                'search' => 'category/search',
            ],
        ],
        //Компонент корзины
        'ecart' => [
            'class' => 'frontend\components\Ecart'
        ],
        
        //Helper для конвертирования перевернутых массивов об отношениях Продуктов, Атрибутов, и их комбинаций
        'arrayProdHelper' => [
            'class' => 'frontend\components\helpers\ArrayProdHelper',
        ],
        /*
        'assetManager' => [
            // override bundles to use CDN :
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1',
                    'css' => [
                        'css/bootstrap.min.css'
                    ],
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1',
                    'js' => [
                        'js/bootstrap.min.js'
                    ],
                ],
                'yii\bootstrap4\BootstrapThemeAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => null,
                    'css' => []
                ],
            ],
        ],
        */
        
        /*
        'assetManager' => [
            // override bundles to use CDN :
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        'vendor/jquery/jquery-3.2.1.min.js',
                    ],
                ],
                
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => [
                        'vendor/bootstrap/css/bootstrap.min.css',
                    ],
                ],
                
                
                
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'js' => [
                        'vendor/bootstrap/js/bootstrap.min.js',
                    ],
                ],
                
               
            ],
        ],
        
        */
        
       
        
        
        
    ],
    'params' => $params,
];
