<?php
use yii\helpers\Url;
use kartik\grid\GridView;

$this->registerCSSFile(
    '@web/css/tabel_style.css',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]
);


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
        'class' => 'kartik\grid\ExpandRowColumn',
        'value' => function ($model) {
            return GridView::ROW_COLLAPSED;
        },
        'detail' => function($model){
            return Yii::$app->controller->renderpartial('get_form_asb',[
                    'model' => $model,
                ]);
        }
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
        'attribute'=>'Kd_Asb5',
        'value' => function ($model) {return $model->kdAsb1->Kd_Asb1.'.'.$model->Kd_Asb2.'.'.$model->Kd_Asb3.'.'.$model->Kd_Asb4.'.'.$model->Kd_Asb5;},
        'label' => 'Kode ASB 5'
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Asb5',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Jenis_Pekerjaan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kdSatuan.Uraian',
        'label' => 'Satuan'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Harga',
        'contentOptions' => ['class' => 'text-right'],
        'value' => function($model) {return number_format($model->Harga,2,',','.');},
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'Kd_Asb1'=>$key['Kd_Asb1'], 'Kd_Asb2'=>$key['Kd_Asb2'], 'Kd_Asb3'=>$key['Kd_Asb3'], 'Kd_Asb4'=>$key['Kd_Asb4'], 'Kd_Asb5'=>$key['Kd_Asb5']]);
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
