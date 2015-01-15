<?php

if(stripos($_SERVER['REQUEST_URI'], '/index.php') === 0) {
    // Редирект на без index.php
    header('Location: http://'.$_SERVER['SERVER_NAME']
        .($_SERVER['SERVER_PORT']!==80?':'.$_SERVER['SERVER_PORT']:'')
        .preg_replace('~^/index\.php~', '', $_SERVER['REQUEST_URI']), null, 301);
    die();
}

define('YII_DEBUG', $_SERVER['REMOTE_ADDR'] == '127.0.0.1');
if(defined('YII_DEBUG') && YII_DEBUG) {
    define('YII_ENV', 'dev');
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
} else {
    ini_set('display_errors', 'off');
    error_reporting(E_ERROR);
    die();
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();