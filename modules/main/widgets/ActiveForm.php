<?php namespace app\modules\main\widgets;

use Yii;

class ActiveForm extends \yii\widgets\ActiveForm
{
    public $fieldConfig = [
        'class' => 'app\\modules\\main\\widgets\\ActiveField'
    ];
}