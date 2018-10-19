<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
// use common\models\RefUrusan;
use common\models\RefBidang;
// use common\models\TaProgram;

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
        'value'=>'urusan.Nm_Urusan',
        'filter' => $urusan,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Bidang',
        'value'=>'bidang.Nm_Bidang',
        'filter' => $bidang,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Unit',
        'value'=>'refUnit.Nm_Unit',
        'filter' => $unit,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Sub',
        'value'=>'refSubUnit.Nm_Sub_Unit',
        'filter' => $subunit,
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Prog',
        'value' => 'refProgram.Ket_Program',
        'filter'=> $program,
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Tahun' => $key['Tahun'], 'Kd_Urusan' => $key['Kd_Urusan'], 'Kd_Bidang' => $key['Kd_Bidang'], 'Kd_Unit' => $key['Kd_Unit'], 'Kd_Sub' => $key['Kd_Sub'], 'Kd_Prog' => $key['Kd_Prog'] ]);
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