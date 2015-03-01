<?php
use kartik\grid\GridView;
use yii\helpers\Html;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns,
//        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo
    'toolbar' =>  [
        ['content'=>
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Сброс'])
        ],
//            '{export}',
        '{toggleData}',
    ],
    'export' => false,
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'hover' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading' => $title,
    ],
    'showPageSummary' => false,
    'persistResize' => false,
    'exportConfig' => false,
]);
?>