<?php

use yii\helpers\Html;
use yii\grid\GridView;
use emusrenbang\models\Referensi;

$this->title = 'Program SKPD Tahun '.(date('Y')+1);
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="ref-kegiatan-unit">
    <div class="box box-success">
        <div class="box-header">
            <h3><?= $this->title ?></h3>
        </div>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' =>'Kode',
                        'format' => 'text',
                        'value' => function($model){
                            return $model->Kd_Urusan.'.'.$model->Kd_Bidang.'.'.$model->Kd_Unit;
                        }
                    ],
                    [
                        'attribute' =>'Nm_Unit',
                        'format' => 'text',
                        'value' => function($model){
                            return $model->Nm_Unit;
                        }
                    ],
                    [
                        'attribute' =>'Program',
                        'format' => 'raw',
                        'value' => function($model){
                            $ref=new Referensi;
                            return Html::a($ref->getProgramCount($model->Kd_Urusan,$model->Kd_Bidang), ['ta-belanja/programadmin',
                                'urusan'=>$model->Kd_Urusan,
                                'bidang'=>$model->Kd_Bidang,
                                'unit'=>$model->Kd_Unit
                            ], ['class' => 'btn btn-success']);
                        }
                    ],
                    [
                        'attribute' =>'Kegiatan',
                        'format' => 'raw',
                        'value' => function($model){
                            $ref=new Referensi;
                            return "<div class='btn btn-warning'>".$ref->getKegiatanCount($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Unit)."</div>";
                        }
                    ]
                ],
            ]); ?>
        </div>
    </div>  
</div>