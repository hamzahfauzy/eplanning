<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaKegiatanLanjutan */
?>
<div class="ta-kegiatan-lanjutan-view">
 
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
        ],
    ]) ?>

</div>
