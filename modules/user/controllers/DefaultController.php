<?php

namespace app\modules\user\controllers;

use app\modules\main\controllers\BaseAdminController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class DefaultController extends BaseAdminController
{
    public function actionLogin()
    {

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionRequestPasswordResetToken()
    {

    }

    public function actionPasswordReset()
    {

    }

    public function behaviors()
    {
        return [
            'access'=> [
                'class'=>AccessControl::className(),
                'rules'=> [
                    'allow'=>true,
                    'actions'=>['logout'],
                    'roles'=>['admin'],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}
