<?php

define('YII_DEBUG', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '95.27.4.141']));

if(defined('YII_DEBUG') && YII_DEBUG) {
    define('YII_ENV', 'dev');
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
} else {
    ini_set('display_errors', 'off');
    error_reporting(E_ERROR);
//    die();
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();