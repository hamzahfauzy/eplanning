<?php
use yii\helpers\Url;

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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Tahun',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refDapil.Nm_Dapil',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refProvinsi.Nm_Prov',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refKabupaten.Nm_Kab',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refKecamatan.Nm_Kec',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Tahun' => $key['Tahun'], 'Kd_Dapil' => $key['Kd_Dapil'], 'Kd_Prov' => $key['Kd_Prov'], 'Kd_Kab' => $key['Kd_Kab'], 'Kd_Kec' => $key['Kd_Kec']]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Anda Yakin?',
                          'data-confirm-message'=>'Anda yakin ingin menghapus ini'],
    ],

];   