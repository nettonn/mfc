<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\main\models\BaseActiveRecord */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $searchModel->getAttributeLabel('modelName').' управление';
$this->params['breadcrumbs'][] = $searchModel->getAttributeLabel('modelName');
$this->params['menu'] = [
    ['label'=>'Добавить', 'url'=>['create']],
];
?>
<div class="user-index">

    <?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        ['class' => 'kartik\grid\DataColumn',
            'attribute'=>'id',
            'width'=>'70px',
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute'=>'name',
            'editableOptions' => [
                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
            ],
        ],
        'alias',
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute'=>'status',
            'content'=>function ($model, $key, $index, $column){
                return $model->getStatusName($model->status);
            },
            'editableOptions' => [
                'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data'=>$searchModel->getStatusesArray(),
            ],
        ],
        'created_at:date',
        'updated_at:date',
        ['class' => 'kartik\grid\ActionColumn'],
    ] ?>

    <?= $this->render('//layouts/admin/part/_grid', ['dataProvider'=>$dataProvider, 'searchModel'=>$searchModel, 'gridColumns'=>$gridColumns, 'title'=>$this->title]) ?>

</div>
