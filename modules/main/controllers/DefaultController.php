<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 13.01.2015
 */

namespace app\modules\main\controllers;

class DefaultController extends BaseFrontendController
{
    public function actionIndex()
    {

    }

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