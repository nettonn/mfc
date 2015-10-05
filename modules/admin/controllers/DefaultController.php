<?php namespace app\modules\admin\controllers;

use app\modules\main\controllers\base\AdminController;

class DefaultController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFiles()
    {
        return $this->render('files');
    }
}
