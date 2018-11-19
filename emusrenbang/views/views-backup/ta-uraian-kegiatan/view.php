<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaUraianKegiatan */

$this->title = $model->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Uraian Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-uraian-kegiatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ubah', ['update', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg], [
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
            'tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Prog',
            'Kd_Keg',
            'lokasi_Kegiatan',
            'kelompok_sasaran',
            'waktu_pelaksanaan',
            'status_kegiatan',
            'pagu',
            'sumber_dana',
            'DAK',
            'created_at',
            'updated_at',
            'username',
        ],
    ]) ?>

</div>
