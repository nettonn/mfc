<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\main\models\BaseActiveRecord */
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
            'attribute'=>'username',
            'editableOptions' => [
                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
            ],
        ],
        'email:email',
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute'=>'role',
            'content'=>function ($model, $key, $index, $column){
                return $model->getRoleName($model->role);
            },
            'editableOptions' => [
                'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                'data'=>$searchModel->getRolesArray(),
            ],
        ],
        'created_at:date',
        'updated_at:date',
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
        ['class' => 'kartik\grid\ActionColumn'],
    ];

    echo $this->render('//layouts/admin/part/_grid', ['dataProvider'=>$dataProvider, 'searchModel'=>$searchModel, 'gridColumns'=>$gridColumns, 'title'=>$this->title])
    ?>

</div>
