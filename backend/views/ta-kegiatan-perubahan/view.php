<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaKegiatanPerubahan */
?>
<div class="ta-kegiatan-perubahan-view">
 
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
            'Keterangan',
            'Keterangan_1',
            'Keterangan_31',
            'Keterangan_32',
        ],
    ]) ?>

</div>
