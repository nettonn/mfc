<?php
date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU');

require(__DIR__.'/defines.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'cms',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'ru-RU',
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'page' => [
            'class' => 'app\modules\page\Module',
        ],
        'yii2demandimg'=>[
            'class'=>'nettonn\yii2demandimg\Module',
        ]
    ],
    'components' => [
        'session' => [
            'class' => 'yii\web\CacheSession',
        ],
        'authManager' => [
            'class' => 'app\modules\main\components\PhpManager',
            'itemFile' => __DIR__.'/rbac/items.php',
            'assignmentFile' => __DIR__.'/rbac/assignments.php',
            'ruleFile' => __DIR__.'/rbac/rules.php',
        ],
        'request' => [
            'cookieValidationKey' => '5xN03URjhVqoxWjNeqIHacMaxMgY4gXD',
            'enableCsrfValidation'=>IS_ADMIN_ROUTE,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
//            'class' => 'yii\caching\MemCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>['/user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath'=>'@app/views/mail',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing'=>true,
            'rules' => require(__DIR__.'/urls.php'),
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['admin'],
            'root' => [
                'path' => 'uploads',
                'name' => 'Uploads'
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class'=>'yii\debug\Module',
        'allowedIPs'=>['*.*.*.*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
