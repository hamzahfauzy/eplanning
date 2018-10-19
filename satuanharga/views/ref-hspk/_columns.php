<?php
use yii\helpers\Url;
use kartik\grid\GridView;

$this->registerCssFile(
    '@web/css/tabel_style.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/hspk_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
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
            return Yii::$app->controller->renderpartial('get_form_hspk',[
                    'model' => $model,
                ]);
        }
    ],
    //     [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Hspk1',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Hspk2',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'Kd_Hspk3',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Kd_Hspk4',
        //'value' => function ($model) {return $model->kdHspk1->Kd_Hspk1.'.'.sprintf("%02d", $model->Kd_Hspk2).'.'.sprintf("%02d", $model->Kd_Hspk3).'.'.sprintf("%02d", $model->Kd_Hspk4);},
        'value' => function ($model) {return $model->kdHspk1->Kd_Hspk1.'.'.$model->Kd_Hspk2.'.'.$model->Kd_Hspk3.'.'.$model->Kd_Hspk4;},
        'label' => 'Kode HSPK 4'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Uraian_Kegiatan',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'kdSatuan.Uraian',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Harga',
        'contentOptions' => ['class' => 'text-right'],
        'value' => function ($model) { return number_format("".$model->Harga, "2", ",", ".");}
        
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'Kd_Hspk1'=>$key['Kd_Hspk1'], 'Kd_Hspk2'=>$key['Kd_Hspk2'], 'Kd_Hspk3'=>$key['Kd_Hspk3'], 'Kd_Hspk4'=>$key['Kd_Hspk4']]);
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
