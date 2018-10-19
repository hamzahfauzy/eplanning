<?php
use yii\helpers\Url;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Tahun',
    // ],
    [
        'format' => 'raw',
        'label' => 'Tahapan',
        'value' => function($model) {
            return $model->kdTahapan->Uraian;
        },
        'width' => '30px',
    ],
    [
        'format' => 'raw',
        'label' => 'Peraturan',
        'value' => function($model) {
            return $model->kdPeraturan->Nm_Peraturan;
        },
        'width' => '30px',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Tahapan',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Peraturan',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'No_ID',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Peraturan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Tgl_Peraturan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Uraian',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Tahun, $Kd_Tahapan, $Kd_Peraturan'=>$key]);
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