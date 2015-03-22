<?php namespace app\modules\main\controllers;

use yii\filters\VerbFilter;

abstract class BaseAjaxController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*'  => ['post'],
                ],
            ],
        ];
    }
}