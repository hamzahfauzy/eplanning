<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\search\TaMusrenbangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forum Perangkat Daerah';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Musrenbang', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Tahun',
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Kec',
            // 'Kd_Kel',
            // 'Kd_Urut_Kel',
            // 'Kd_Lingkungan',
            // 'Kd_Jalan',
            // 'Kd_Urusan',
            // 'Kd_Bidang',
            // 'Kd_Prog',
            // 'Kd_Keg',
            // 'Kd_Unit',
            // 'Kd_Sub',
            // 'Kd_Pem',
            // 'Nm_Permasalahan:ntext',
            // 'Kd_Klasifikasi',
            // 'Jenis_Usulan:ntext',
            // 'Jumlah',
            // 'Kd_Satuan',
            // 'Harga_Satuan',
            // 'Harga_Total',
            // 'Kd_Sasaran',
            // 'Detail_Lokasi:ntext',
            // 'Latitute',
            // 'Longitude',
            // 'Tanggal',
            // 'status',
            // 'Status_Survey',
            // 'Kd_Prioritas_Pembangunan_Daerah',
            // 'Skor',
            // 'Rincian_Skor:ntext',
            // 'Status_Usulan',
            // 'Status_Penerimaan_Kelurahan',
            // 'Alasan_Kelurahan:ntext',
            // 'Status_Penerimaan_Kecamatan',
            // 'Alasan_Kecamatan:ntext',
            // 'Status_Penerimaan_Skpd',
            // 'Alasan_Skpd:ntext',
            // 'Status_Penerimaan_Kota',
            // 'Alasan_Kota:ntext',
            // 'Kd_User',
            // 'Kd_Asal',
            // 'Kd1',
            // 'Kd2',
            // 'Kd3',
            // 'Kd4',
            // 'Kd5',
            // 'Kd6',
            // 'Uraian_Usulan:ntext',
            // 'Kd_Asal_Usulan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
