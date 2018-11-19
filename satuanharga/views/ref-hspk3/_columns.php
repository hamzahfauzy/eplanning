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
    //     'attribute'=>'Kd_Hspk',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Kd_Hspk1',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Kd_Hspk2',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Kd_Hspk3',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Kd_Hspk3',
        'value' => function ($model) {
            return $model->kdHspk1->Kd_Hspk1 . '.' . $model->Kd_Hspk2 . '.' . $model->Kd_Hspk3;
        },
        'label' => 'Kode HSPK 3'
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Hspk3',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Nm_Hspk3',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return Url::to([$action, 'Kd_Hspk1' => $key['Kd_Hspk1'], 'Kd_Hspk2' => $key['Kd_Hspk2'], 'Kd_Hspk3' => $key['Kd_Hspk3']]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => 'Delete',
            'data-confirm' => false, 'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item'],
    ],
];
