<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaKegiatan */
?>
<div class="ta-kegiatan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Prog',
            'ID_Prog',
            'Kd_Keg',
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
