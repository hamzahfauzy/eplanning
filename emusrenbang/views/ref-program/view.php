<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\RefUnit;
// use app\models\Referensi;

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */

// $ref=new Referensi;
$this->title = $model->Ket_Program;
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-program-view">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Program</h3>

          <div class="box-tools pull-right">
            
            <p>
                <?= Html::a("<i class=\"fa fa-edit\"></i> Ubah", ['update', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub_Unit' => $model->Kd_Sub_Unit], [
                    'class' => 'btn btn-primary',
                    'data-toggle' => 'tooltip',
                    'title' => 'Ubah',
                ]) ?>
                <?= Html::a("<i class=\"fa fa-trash\"></i> Hapus", ['delete', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog,'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub_Unit' => $model->Kd_Sub_Unit], [
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
                [
                    'attribute' => 'kdUrusan.Nm_Urusan',
                    'format' => 'text',
                    'value' => $model->Kd_Urusan." : ".$model->kdUrusan->Nm_Urusan//. $ref->getUrusanOne($model->Kd_Urusan)->Nm_Urusan
                ],
                [
                    'attribute' => 'kdBidang.Nm_Bidang',
                    'format' => 'text',
                    'value' => $model->kdBidang->Nm_Bidang//. $ref->getBidangOne($model->Kd_Urusan,$model->Kd_Bidang)->Nm_Bidang
                ],
                [
                    'attribute' => 'Ket_Program',
                    'format' => 'text',
                    'value' => $model->Kd_Prog." : ".$model->Ket_Program
                ],
				[
                    'attribute' => 'KdUnit.Nm_Unit',
                    'format' => 'text',
                    'value' => $model->Kd_Unit ." : ".$model->Kd_Sub_Unit
                ],
				
            ],
        ]) ?>

        <!-- /.box-body -->
    </div>

</div>
