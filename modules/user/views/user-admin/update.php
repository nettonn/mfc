<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\BaseActiveRecord */

$this->title = $model->getAttributeLabel('modelName').' изменение: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => $model->getAttributeLabel('modelName'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменение';
$this->params['menu'] = [
    ['label'=>'Список', 'url'=>['index']],
    ['label'=>'Добавить', 'url'=>['create']],
];
?>
<div class="<?= $this->context->id ?>-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
