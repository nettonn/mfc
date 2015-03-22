<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\BaseActiveRecord */

$this->title = $model->getAttributeLabel('modelName').' изменение: ' . ' ' . (isset($model->name)?$model->name:$model->id);
$this->params['breadcrumbs'][] = ['label' => $model->getAttributeLabel('modelName'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';
$this->params['menu'] = [
    ['label'=>'Список', 'url'=>['index']],
    ['label'=>'Добавить', 'url'=>['create']],
];
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
