<?php  namespace app\modules\admin\controllers;

use Yii;
use app\modules\main\controllers\BaseAjaxController;
use yii\helpers\FileHelper;

class AjaxController extends BaseAjaxController
{
    public function actionClearCache()
    {
        Yii::$app->cache->flush();
        foreach(glob(Yii::$app->assetManager->basePath.'/*') as $one) {
            if(is_dir($one))
                FileHelper::removeDirectory($one);
        }
    }
}