<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefSetting */
?>
<div class="ref-setting-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'SistemKuitansi',
            'StandardHarga',
            'Kontrol_Angg_SPD',
            'Kontrol_SPD_SPP',
            'Kontrol_SPP_SPM',
            'Locked:boolean',
            'LastDBAplVer',
            'DefaultPaper:boolean',
            'SPDKegiatan:boolean',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Pembayaran',
            'PFK',
            'Peny_SPJ:boolean',
            'SP2DPre:boolean',
            'SP2DFormat',
            'KunciPagu:boolean',
            'Prognosis',
            'Akrual:boolean',
        ],
    ]) ?>

</div>
