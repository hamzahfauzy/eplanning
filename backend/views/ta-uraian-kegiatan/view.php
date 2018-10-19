<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaUraianKegiatan */
?>
<div class="ta-uraian-kegiatan-view">
 
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
