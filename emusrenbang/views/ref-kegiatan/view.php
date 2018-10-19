<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use emusrenbang\models\Referensi;

/* @var $this yii\web\View */
/* @var $model app\models\RefKegiatan */

$ref=new Referensi;
$this->title = $model->Ket_Kegiatan;
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kegiatan-view">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Kegiatan</h3>

          <div class="box-tools pull-right">
            <p>
                <?= Html::a("<i class=\"fa fa-edit\"></i> Ubah", ['update', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Pagu_Indikatif' => $model->Pagu_Indikatif], [
                    'class' => 'btn btn-primary',
                    'data-toggle' => 'tooltip',
                    'title' => 'Ubah',
                ]) ?>
                <?= Html::a("<i class=\"fa fa-trash\"></i> Hapus", ['delete', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg,'Pagu_Indikatif' => $model->Pagu_Indikatif], [
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
                    'attribute' => 'Urusan',
                    'format' => 'text',
                    'value' => $model->Kd_Urusan." : ". $ref->getUrusanOne($model->Kd_Urusan)->Nm_Urusan
                ],
                [
                    'attribute' => 'Sektor',
                    'format' => 'text',
                    'value' => $model->Kd_Bidang." : ". $ref->getBidangOne($model->Kd_Urusan,$model->Kd_Bidang)->Nm_Bidang
                ],
                [
                    'attribute' => 'Program',
                    'format' => 'text',
                    'value' => $model->Kd_Prog." : ". $ref->getProgramByBidangUrusanProgramOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog)->Ket_Program
                ],
                [
                    'attribute' => 'Kegiatan',
                    'format' => 'text',
                    'value' => $model->Kd_Keg." : ". $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Ket_Kegiatan
                ],
		[
                    'attribute' => 'Indikator',
                    'format' => 'text',
                    'value' => $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Indikator 
                ],
		[
                    'attribute' => 'Satuan0',
                    'format' => 'text',
                    'value' => $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Satuan0  
                ],
		[
                    'attribute' => 'Target',
                    'format' => 'text',
                    'value' =>  $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Target0
                ],
		[
                    'attribute' => 'Pagu Tahun 2016',
                    'format' => 'text',
                    'value' =>  number_format(($ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Pagu_Indikatif),"0", ",", ".") 
                ],
		[
                    'attribute' => 'Target',
                    'format' => 'text',
                    'value' =>  $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Target1
                ],
		[
                    'attribute' => 'Pagu Tahun 2017',
                    'format' => 'text',
                    'value' =>  number_format(($ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Tahun_Pertama),"0", ",", ".")
                ],
		[
                    'attribute' => 'Target',
                    'format' => 'text',
                    'value' =>  $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Target2
                ],
                 [
                    'attribute' => 'Pagu Tahun 2018',
                    'format' => 'text',
                    'value' =>  number_format(($ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Tahun_Kedua),"0", ",", ".")
                ],
		[
                    'attribute' => 'Target',
                    'format' => 'text',
                    'value' =>  $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Target3
                ],
                 [
                    'attribute' => 'Pagu Tahun 2019',
                    'format' => 'text',
                    'value' =>  number_format(($ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Tahun_Ketiga),"0", ",", ".")
                ],
		[
                    'attribute' => 'Target',
                    'format' => 'text',
                    'value' =>  $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Target4
                ],
                 [
                    'attribute' => 'Pagu Tahun 2020',
                    'format' => 'text',
                    'value' => number_format(($ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Tahun_Keempat),"0", ",", ".")
                ],
		[
                    'attribute' => 'Target',
                    'format' => 'text',
                    'value' =>  $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Target5
                ],
                 [
                    'attribute' => 'Pagu Tahun 2021',
                    'format' => 'text',
                    'value' =>  number_format(($ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Tahun_Kelima),"0", ",", ".")
                ],
		[
                    'attribute' => 'Target Akhir',
                    'format' => 'text',
                    'value' =>  $ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Target6
                ],
                 [
                    'attribute' => 'Pagu Akhir',
                    'format' => 'text',
                    'value' =>  number_format(($ref->getKegiatanByOne($model->Kd_Urusan,$model->Kd_Bidang,$model->Kd_Prog,$model->Kd_Keg)->Tahun_Akhir),"0", ",", ".")
                ],

                 
                 
	],
          
        ]) ?>

        <!-- /.box-body -->
    </div>
</div>
