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
        'attribute'=>'Kd_Urusan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Bidang',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Unit',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Sub',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Jab',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'No_Urut',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Nama',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Nip',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Jabatan',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Tahun'=>$key['Tahun'], 'Kd_Urusan'=>$key['Kd_Urusan'],
				'Kd_Bidang'=>$key['Kd_Bidang'], 'Kd_Unit'=>$key['Kd_Unit'], 'Kd_Sub'=>$key['Kd_Sub'],
				'Kd_Jab'=>$key['Kd_Jab'], 'No_Urut'=>$key['No_Urut']]);
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