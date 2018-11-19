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
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Kd_Ssh1',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Kd_Ssh2',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Kd_Ssh3',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        // 'attribute' => 'Kd_Ssh1',
        'value' => function ($model) {
            return $model->kdSsh1->Kd_Ssh1 . '.' . $model->Kd_Ssh2 . '.' . $model->Kd_Ssh3 . '.' . $model->Kd_Ssh4;
        },
        'label' => 'Kode SSH 4'
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'kdSsh2.Nm_Ssh2',
    //     'label' => 'Kode 2',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'kdSsh3.Nm_Ssh3',
    //     'label' => 'Kode 3',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Ssh4',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'Nm_Ssh4',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return Url::to([$action, 'Kd_Ssh1' => $key['Kd_Ssh1'], 'Kd_Ssh2' => $key['Kd_Ssh2'], 'Kd_Ssh3' => $key['Kd_Ssh3'], 'Kd_Ssh4' => $key['Kd_Ssh4']]);
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
