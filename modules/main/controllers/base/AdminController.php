<?php namespace app\modules\main\controllers\base;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

abstract class AdminController extends Controller
{
    public $layout = '/admin/main';

    public function init()
    {
        parent::init();
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ]);
    }
}