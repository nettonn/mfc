<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 13.01.2015
 */

namespace app\modules\main\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

abstract class BaseAdminController extends Controller
{
    public $layout = '/admin/main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }
}