<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaS3UP */
?>
<div class="ta-s3-up-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'No_Bukti',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Tgl_Bukti',
            'No_BKU',
            'Kd_Bank',
            'Kd_Pembayaran',
            'Nilai',
            'D_K',
            'Keterangan',
        ],
    ]) ?>

</div>
