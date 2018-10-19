<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Referensi;

/* @var $this yii\web\View */
/* @var $model app\models\RefKegiatan */

$ref=new Referensi;
$this->title = $model->Ket_Kegiatan;
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kegiatan-view">

    <p>
        <?= Html::a('Ubah', ['update', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
            ]
        ],
    ]) ?>
</div>
