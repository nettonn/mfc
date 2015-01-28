<?php
/**
 * @author: dmitry lebedev <dev.nettonn@gmail.com>
 * Date: 28.01.2015
 */

namespace app\modules\main\widgets;

use Yii;

class ActiveForm extends \yii\widgets\ActiveForm
{
    public $fieldConfig = [
        'class' => 'app\\modules\\main\\widgets\\ActiveField'
    ];
}