<?php namespace app\modules\main\controllers;

use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

abstract class BaseFrontendAjaxController extends BaseFrontendController
{
    public function init()
    {
        parent::init();
        if(!\Yii::$app->request->isAjax)
            throw new \HttpException(400);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*'  => ['post'],
                ],
            ],
        ]);
    }
}