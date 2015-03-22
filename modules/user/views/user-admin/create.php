<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\BaseActiveRecord */

$this->title = $model->getAttributeLabel('modelName').' - добавить';
$this->params['breadcrumbs'][] = ['label' => $model->getAttributeLabel('modelName'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
$this->params['menu'] = [
    ['label'=>'Список', 'url'=>['index']]
];
?>
<div class="<?= $this->context->id ?>-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
