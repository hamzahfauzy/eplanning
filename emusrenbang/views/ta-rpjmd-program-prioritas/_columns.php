<?php
use yii\helpers\Url;
use common\components\Helper;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Tahun',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Misi',
        'label' => 'Misi',
        'contentOptions' => ['id' => 'cinta'],
    'value' => function($model) {return '('.@$model->taRpjmdMisi->No_Misi.') '.@$model->taRpjmdSasaran->taRpjmdTujuan->taRpjmdMisi->Misi;},
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Tujuan',
        'label' => 'Tujuan',
        'value' => function($model) {return '('.@$model->No_Tujuan.') '.@$model->taRpjmdSasaran->taRpjmdTujuan->Tujuan;},
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Sasaran',
        'label' => 'Sasaran',
        'value' => function($model) {return '('.@$model->No_Sasaran.') '.@$model->taRpjmdSasaran->Sasaran;},
    ],
	 [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Prioritas',
        'label' => 'Prioritas Pembangunan Daerah (RPJMD)',
        'value' => function($model) {return '('.@$model->No_Prioritas.') '.@$model->refRPJMD2->Keterangan;},
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'No_Prioritas',
        'label' => 'Prioritas Pembangunan Daerah (RKPD)',
        'value' => function($model) {return '('.@$model->No_Prioritas.') '.@$model->refRPJMD2->Nm_Prioritas_Pembangunan_Kota;},
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Prog',
        'label' => 'Program',
        'value' => function($model) {return '('.@$model->Kd_Prog.') '.@$model->refKamusProgram->Nm_Program;},
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Urusan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Bidang',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Kd_Prog',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'template' => Helper::filterActionColumn('{view}{update}{delete}'),
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action, 'Kd_Prog' => $model['Kd_Prog'],'No_Prioritas' => $model['No_Prioritas']]);
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