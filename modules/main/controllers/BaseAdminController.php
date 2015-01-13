<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 13.01.2015
 */

namespace app\modules\main\controllers;

use yii\web\Controller;

abstract class BaseAdminController extends Controller
{
    public $layout = '/admin/main';
}