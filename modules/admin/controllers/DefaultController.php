<?php

namespace app\modules\admin\controllers;

use app\modules\main\controllers\BaseAdminController;

class DefaultController extends BaseAdminController
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
