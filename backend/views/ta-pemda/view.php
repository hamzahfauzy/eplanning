<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaPemda */
?>
<div class="ta-pemda-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Nm_Pemda',
            'Nm_PimpDaerah',
            'Jab_PimpDaerah',
            'Nm_Sekda',
            'Nip_Sekda',
            'Jbt_Sekda',
            'Nm_Ka_Keu',
            'Nip_Ka_Keu',
            'Jbt_Ka_Keu',
            'Nm_Ka_Anggaran',
            'Nip_Ka_Anggaran',
            'Jbt_Ka_Anggaran',
            'Nm_Ka_Verifikasi',
            'Nip_Ka_Verifikasi',
            'Jbt_Ka_Verifikasi',
            'Nm_Ka_Perbendaharaan',
            'Nip_Ka_Perbendaharaan',
            'Jbt_Ka_Perbendaharaan',
            'Nm_Ka_BUD',
            'Nip_Ka_BUD',
            'Jbt_Ka_BUD',
            'NPWP_BUD',
            'K1',
            'K2',
            'K3',
            'K4',
            'Nm_Ka_Pembukuan',
            'Nip_Ka_Pembukuan',
            'Jbt_Ka_Pembukuan',
            'Nm_Atasan_BUD',
            'Nip_Atasan_BUD',
            'Jbt_Atasan_BUD',
            'Ibukota',
            'Alamat',
            'Logo',
        ],
    ]) ?>

</div>
