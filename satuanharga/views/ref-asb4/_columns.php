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
    //     [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Asb1',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Asb2',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Asb3',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Asb4',
        'value' => function ($model) {return $model->kdAsb1->Kd_Asb1.'.'.$model->Kd_Asb2.'.'.$model->Kd_Asb3.'.'.$model->Kd_Asb4;},
        'label' => 'Kode ASB 4'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Nm_Asb4',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'Kd_Asb1'=>$key['Kd_Asb1'], 'Kd_Asb2'=>$key['Kd_Asb2'], 'Kd_Asb3'=>$key['Kd_Asb3'], 'Kd_Asb4'=>$key['Kd_Asb4']]);
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
