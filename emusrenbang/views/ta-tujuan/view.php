<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaTujuan */

$this->title = $model->Ur_Tujuan;
$this->params['breadcrumbs'][] = "Rencana Strategis";
$this->params['breadcrumbs'][] = ['label' => 'Rencana Strategis Tujuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tujuan-view">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Tujuan</h3>

          <div class="box-tools pull-right">
            
            <p>
                <?= Html::a("<i class=\"fa fa-edit\"></i> Ubah", ['update', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan], [
                    'class' => 'btn btn-primary',
                    'data-toggle' => 'tooltip',
                    'title' => 'Ubah',
                ]) ?>
                <?= Html::a("<i class=\"fa fa-trash\"></i> Hapus", ['delete', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan], [
                    'class' => 'btn btn-danger',
                    'data-toggle' => 'tooltip',
                    'title' => 'Hapus',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'Tahun',
                // 'Kd_Urusan',
                // 'Kd_Bidang',
                // 'Kd_Unit',
                // 'Kd_Sub',
                [
                    'attribute' => 'Misi',
                    'format' => 'text',
                    'value' => $misi->misi->Ur_Misi
                ],
                [
                    'attribute' => 'Ur_Tujuan',
                    'format' => 'text',
                    'value' => $model->No_Tujuan.": ".$model->Ur_Tujuan
                ]
            ],
        ]) ?>

        <!-- /.box-body -->
    </div>

</div>
