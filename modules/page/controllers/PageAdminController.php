<?php namespace app\modules\page\controllers;

use app\modules\main\controllers\CrudAdminController;
use Yii;
use app\modules\page\models\Page;
use app\modules\page\models\PageSearch;

/**
 * UserAdminController implements the CRUD actions for User model.
 */
class PageAdminController extends CrudAdminController
{
    protected function getModel($typeOrCondition)
    {
        switch($typeOrCondition) {
            case 'search':
                return new PageSearch();
            case 'model':
                return new Page();
            case 'name':
                return 'User';
        }
        return Page::findOne($typeOrCondition);
    }

    protected function getEditableReturnValue($attributes)
    {
        if(isset($attributes['status']))
            return (new Page())->getStatusName($attributes['status']);
        if(isset($attributes['role']))
            return (new Page())->getRoleName($attributes['role']);
        return '';
    }
}
