<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'Tahun',
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Kec',
            'Kd_Kel',
            'Kd_Urut_Kel',
            'Kd_Lingkungan',
            'Kd_Jalan',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Prog',
            'Kd_Keg',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Pem',
            'Nm_Permasalahan:ntext',
            'Kd_Klasifikasi',
            'Jenis_Usulan:ntext',
            'Jumlah',
            'Kd_Satuan',
            'Harga_Satuan',
            'Harga_Total',
            'Kd_Sasaran',
            'Detail_Lokasi:ntext',
            'Latitute',
            'Longitude',
            'Tanggal',
            'status',
            'Status_Survey',
            'Kd_Prioritas_Pembangunan_Daerah',
            'Skor',
            'Rincian_Skor:ntext',
            'Status_Usulan',
            'Status_Penerimaan_Kelurahan',
            'Alasan_Kelurahan:ntext',
            'Status_Penerimaan_Kecamatan',
            'Alasan_Kecamatan:ntext',
            'Status_Penerimaan_Skpd',
            'Alasan_Skpd:ntext',
            'Status_Penerimaan_Kota',
            'Alasan_Kota:ntext',
            'Kd_User',
            'Kd_Asal',
            'Kd1',
            'Kd2',
            'Kd3',
            'Kd4',
            'Kd5',
            'Kd6',
            'Uraian_Usulan:ntext',
            'Kd_Asal_Usulan',
        ],
    ]) ?>

</div>
