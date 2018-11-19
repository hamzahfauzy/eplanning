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
        //'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Prov',
        'value'=>'provinsi.Nm_Prov',
        'label'=>'Provinsi',
        'filter'=>Yii::$app->runAction('ajax/provinsi')
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Kab',
        'value'=>'kabupaten.Nm_Kab',
        'label'=>'Kabupaten/Kota',
        'filter'=>Yii::$app->runAction('ajax/kabupaten', ['Kd_Prov' => $searchModel->Kd_Prov])
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Kec',
        'value'=>'kecamatan.Nm_Kec',
        'label'=>'Kecamatan',
        'filter'=>Yii::$app->runAction('ajax/kecamatan', ['Kd_Prov' => $searchModel->Kd_Prov,
                                                          'Kd_Kab' => $searchModel->Kd_Kab])
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Nm_Kel',
        'label' => 'Nama Kelurahan'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
              //  return Url::to([$action,'Kd_Prov, $Kd_Kab, $Kd_Kec, $Kd_Kel, $Kd_Urut'=>$key]);
              return Url::to([$action,'Kd_Prov' =>$key['Kd_Prov'], 'Kd_Kab' =>$key['Kd_Kab'] , 'Kd_Kec'=>$key['Kd_Kec'],'Kd_Kel'=>$key['Kd_Kel'],'Kd_Urut'=>$key['Kd_Urut'] ]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Konfirmasi',
                          'data-confirm-message'=>'Apakah Anda yakin ingin menghapus data ini?'], 
    ],

];   