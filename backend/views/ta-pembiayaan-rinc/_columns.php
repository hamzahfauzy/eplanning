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
        // 'attribute'=>'Kd_Prog',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ID_Prog',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Keg',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Rek_1',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Rek_2',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Rek_3',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Rek_4',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Rek_5',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'No_ID',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Sat_1',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Nilai_1',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Sat_2',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Nilai_2',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Sat_3',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Nilai_3',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Satuan123',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Jml_Satuan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Nilai_Rp',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Total',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Keterangan',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Tahun'=>$key['Tahun'], 'Kd_Urusan'=>$key['Kd_Urusan'],
				'Kd_Bidang'=>$key['Kd_Bidang'], 'Kd_Unit'=>$key['Kd_Unit'],
				'Kd_Sub'=>$key['Kd_Sub'], 'Kd_Prog'=>$key['Kd_Prog'], 'Kd_Keg'=>$key['Kd_Keg'],
				'Kd_Rek_1'=>$key['Kd_Rek_1'], 'Kd_Rek_2'=>$key['Kd_Rek_2'], 'Kd_Rek_3'=>$key['Kd_Rek_3'],
				'Kd_Rek_4'=>$key['Kd_Rek_4'], 'Kd_Rek_5'=>$key['Kd_Rek_5'], 'No_ID'=>$key['No_ID']]);
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