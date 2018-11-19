<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaPembiayaanRinc */
?>
<div class="ta-pembiayaan-rinc-view">
 
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
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
            'Kd_Rek_5',
            'No_ID',
            'Sat_1',
            'Nilai_1',
            'Sat_2',
            'Nilai_2',
            'Sat_3',
            'Nilai_3',
            'Satuan123',
            'Jml_Satuan',
            'Nilai_Rp',
            'Total',
            'Keterangan',
        ],
    ]) ?>

</div>
