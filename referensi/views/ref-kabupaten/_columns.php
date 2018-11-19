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
        'attribute'=>'Kd_Prov',
        'value' => 'provinsi.Nm_Prov',
        'label'=>'Provinsi',
        'filter'=>Yii::$app->runAction('ajax/provinsi')
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Kab',
        'label' => 'Kode Kabupaten'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Nm_Kab',
        'label' => 'Nama Kabupaten'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Kd_Prov'=>$key['Kd_Prov'], 'Kd_Kab'=>$key['Kd_Kab']]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Konfirmasi',
                          'data-confirm-message'=>'Apakah kamu yakin ingin menghapus item ini?'], 
    ],

];   