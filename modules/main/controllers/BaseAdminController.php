<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 13.01.2015
 */

namespace app\modules\main\controllers;

use yii\filters\AccessControl;

abstract class BaseAdminController extends BaseController
{
    public $layout = '/admin/main';

    public $menu = [];

    public function init()
    {
        parent::init();

    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }
}