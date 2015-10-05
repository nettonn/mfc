<?php namespace app\modules\user\controllers;

use app\modules\main\controllers\base\CrudAdminController;
use Yii;
use app\modules\user\models\User;
use app\modules\user\models\UserSearch;

/**
 * UserAdminController implements the CRUD actions for User model.
 */
class UserAdminController extends CrudAdminController
{
    protected function getModel($typeOrCondition)
    {
        switch($typeOrCondition) {
            case 'search':
                return new UserSearch();
            case 'model':
                return new User();
            case 'name':
                return 'User';
        }
        return User::findOne($typeOrCondition);
    }

    protected function getEditableReturnValue($attributes)
    {
        if(isset($attributes['username']))
            return $attributes['username'];
        if(isset($attributes['status']))
            return (new User())->getStatusName($attributes['status']);
        if(isset($attributes['role']))
            return (new User())->getRoleName($attributes['role']);
        return '';
    }
}
