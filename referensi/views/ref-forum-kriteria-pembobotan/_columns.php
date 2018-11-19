<?php
use yii\helpers\Url;
use kartik\grid\GridView;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'value' => function ($model) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function($model){
            return Yii::$app->controller->renderpartial('get_view_bobot',[
                    'model' => $model,
                ]);
        }
    ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Kriteria',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kriteria',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Bobot',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Keterangan_Kriteria',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   