<?php
use yii\helpers\Url;
use common\components\Helper;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Tahun',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Prioritas',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Prioritas_Pembangunan_Daerah',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => Helper::filterActionColumn('{view}{update}{delete}'),
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Tahun' => $key['Tahun'], 'No_Prioritas'=> $key['No_Prioritas']]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Anda yakin ?',
                          'data-confirm-message'=>'Anda yakin ingin menghapus ini'], 
    ],

];   