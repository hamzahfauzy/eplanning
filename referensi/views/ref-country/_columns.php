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
        'attribute'=>'Kd_Benua',
        'value' => 'kdSubBenua.kdBenua.Nm_Benua',
        'label' => 'Benua',
        'filter' => Yii::$app->runAction('ajax/benua')
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Benua_Sub',
        'value' => 'kdSubBenua.Nm_Benua_Sub',
        'label' => 'Benua Bagian',
        'filter'=>Yii::$app->runAction('ajax/benua-sub',['Kd_Benua' => $searchModel->Kd_Benua])
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Benua_Sub_Negara',
        'label' => 'Kode Negara',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Nm_Negara',
        'label' => 'Nama Negara'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'Kd_Benua' => $key['Kd_Benua'], 'Kd_Benua_Sub' => $key['Kd_Benua_Sub'],
				'Kd_Benua_Sub_Negara'=>$key['Kd_Benua_Sub_Negara']]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Konfirmasi',
                          'data-confirm-message'=>'Apakah anda yakin ingin menghapus data ini?'], 
    ],

];   