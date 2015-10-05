<?php namespace app\modules\main\controllers\base;

abstract class Controller extends \yii\web\Controller
{
    public function init()
    {
        if(stripos($_SERVER['REQUEST_URI'], '/index.php') === 0) $this->redirect('/', 301);
    }
}