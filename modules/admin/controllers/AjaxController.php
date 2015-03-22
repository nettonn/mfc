<?php  namespace app\modules\admin\controllers;

use app\modules\main\controllers\BaseAdminAjaxController;
use Yii;
use yii\helpers\FileHelper;

class AjaxController extends BaseAdminAjaxController
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