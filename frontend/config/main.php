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
    ],
    'params' => $params,
];
