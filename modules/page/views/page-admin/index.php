<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

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
            'attribute'=>'name',
            'editableOptions' => [
                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
            ],
        ],

        'alias',
        'created_at:datetime',
        'updated_at:datetime',
        [
            'class' => '\yii2mod\toggle\ToggleColumn',
            'attribute' => 'status',
            'filter'=>$searchModel->getStatusesArray()
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'buttons'=>[
                'view'=>function ($url, $model, $key) {
                    return method_exists($model, 'getUrl')?Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $model->getUrl()) : '';
                 }
            ]
        ],
    ];
    Pjax::begin();
    echo $this->render('//layouts/admin/part/_grid', ['dataProvider'=>$dataProvider, 'searchModel'=>$searchModel, 'gridColumns'=>$gridColumns, 'title'=>$this->title]);
    Pjax::end();
    ?>
</div>
