<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 26.01.2015
 */

namespace app\modules\main\controllers;

class BaseController extends \yii\web\Controller
{
    public function init()
    {
        if(stripos($_SERVER['REQUEST_URI'], '/index.php') === 0) $this->redirect('/', 301);
    }
}