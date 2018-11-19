<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel eperencanaan\models\TaKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kegiatan';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="ta-kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <!-- <div class="row">
        <div class="col-md-3 col-md-offset-9">
            <div class="sort-kegiatan">
                <select name="" id="" class="form-control">
                    <option value="">Tampil Berdasarkan</option>
                    <option value="">Choose A</option>
                    <option value="">Choose B</option>
                </select>
            </div>
        </div>
    </div> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
    
            // 'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Prog',
            'Kd_Keg',
            'Kd_Unit',
            'Kd_Sub',
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

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
