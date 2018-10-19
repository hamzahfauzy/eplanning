<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel emusrenbang\models\search\TaKegiatanApbnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ta Kegiatan Apbns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-kegiatan-apbn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ta Kegiatan Apbn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Prog',
            'Kd_Keg',
            // 'Kd_Unit',
            // 'Kd_Sub',
            // 'ID_Prog',
            // 'Ket_Kegiatan',
            // 'Lokasi',
            // 'Kelompok_Sasaran',
            // 'Status_Kegiatan',
            // 'Pagu_Anggaran',
            // 'Waktu_Pelaksanaan',
            // 'Kd_Sumber',
            // 'Status',
            // 'Keterangan:ntext',
            // 'Pagu_Anggaran_Nt1',
            // 'Verifikasi_Bappeda',
            // 'Tanggal_Verifikasi_Bappeda',
            // 'Keterangan_Verifikasi_Bappeda:ntext',
            // 'Kd_Urusan_Prov',
            // 'Kd_Bidang_Prov',
            // 'Kd_Unit_Prov',
            // 'Kd_Sub_Prov',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
