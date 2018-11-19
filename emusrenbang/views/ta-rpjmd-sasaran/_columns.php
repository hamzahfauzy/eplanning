<?php
use yii\helpers\Url;
use common\components\Helper;

return [
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Tahun',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Misi',
        'value'=>function($model) { return '('.$model->taRpjmdTujuan->taRpjmdMisi->No_Misi.') '.$model->taRpjmdTujuan->taRpjmdMisi->Misi; },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Tujuan',
        'value'=>function($model) { return '('.$model->taRpjmdTujuan->No_Tujuan.') '.$model->taRpjmdTujuan->Tujuan; },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Sasaran',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Sasaran',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => Helper::filterActionColumn('{view}{update}{delete}'),
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Tahun' => $key['Tahun'] , 'No_Misi' => $key['No_Misi'], 'No_Tujuan' => $key['No_Tujuan'], 'No_Sasaran' => $key['No_Sasaran']]);
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