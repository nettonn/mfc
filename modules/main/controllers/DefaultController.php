<?php namespace app\modules\main\controllers;

use app\modules\main\controllers\base\FrontendController;

class DefaultController extends FrontendController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => null,
            ],
        ];
    }
}