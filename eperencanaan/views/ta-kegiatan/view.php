<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKegiatan */

$this->title = $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kegiatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub], [
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
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Prog',
            'Kd_Keg',
            'Kd_Unit',
            'Kd_Sub',
            'ID_Prog',
            'Ket_Kegiatan',
            'Lokasi',
            'Kelompok_Sasaran',
            'Status_Kegiatan',
            'Pagu_Anggaran',
            'Waktu_Pelaksanaan',
            'Kd_Sumber',
            'Status',
            'Keterangan:ntext',
        ],
    ]) ?>

</div>
