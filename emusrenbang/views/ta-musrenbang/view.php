<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\RefRPJMD;

/* @var $this yii\web\View */
/* @var $model app\models\RefUrusan */

$this->title = 'View';
$this->params['breadcrumbs'][] = "Usulan";
$this->params['breadcrumbs'][] = ['label' => 'Usulan Kecamatan', 'url' => ['ta-musrenbang/usulan-semua']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-urusan-view">

    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $this->title ?></h3>

        </div>
        <!-- /.box-header -->

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'Tahun',
                [
                    'attribute' => 'Nama Kecamatan', 
                    'value' => function($model) {
                        if (isset($model->kecamatan->Nm_Kec)) {
                            return $model->kecamatan->Nm_Kec;
                        }
                    }
                ],
                [
                    'attribute' => 'Nama Kelurahan', 
                    'value' => function($model) {
                        if (isset($model->kelurahan->Nm_Kel)) {
                            return $model->kelurahan->Nm_Kel;
                        }
                    }
                ],
                [
                    'attribute' => 'Nama Lingkungan', 
                    'value' => function($model) {
                        if (isset($model->lingkungan->Nm_Lingkungan)) {
                            return $model->lingkungan->Nm_Lingkungan;
                        }
                    }
                ],
                [
                    'attribute' => 'Nama Jalan', 
                    'value' => function($model) {
                        if (isset($model->kdJalan->Nm_Jalan)) {
                            return $model->kdJalan->Nm_Jalan;
                        }
                    }
                ],
                'Detail_Lokasi',
                'bidangPembangunan.Bidang_Pembangunan',
                //['attribute' => 'Nama Jalan', 'value' => $model->rpjmd->Nm_Prioritas_Pembangunan_Kota],
                'Nm_Permasalahan',
                'Jenis_Usulan',
                'Skor',
                [
                    'attribute'=>'Status_Prioritas',
                    'filter'=>[""=>"Semua", "1"=>"Prioritas", 0=>"Cadangan" ],
                    'value' => function ($model) {
                        if($model->Status_Prioritas)
                            return 'Prioritas';   
                        else
                            return 'Cadangan';   
                    }
                ],
            ],
        ]) ?>

        <!-- /.box-body -->
    </div>

</div>
