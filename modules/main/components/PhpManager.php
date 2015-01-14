<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 14.01.2015
 */

namespace app\modules\main\components;

use Yii;

class PhpManager extends \yii\rbac\PhpManager
{
    public function init()
    {
        parent::init();
    }

    public function getAssignments($userId)
    {
        if(!Yii::$app->user->isGuest){
            $assignment = new \yii\rbac\Assignment;
            $assignment->userId = $userId;
            $assignment->roleName = Yii::$app->user->identity->role;
            return [$assignment->roleName => $assignment];
        }
        return [];
    }
}