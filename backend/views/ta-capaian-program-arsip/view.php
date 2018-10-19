<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaCapaianProgramArsip */
?>
<div class="ta-capaian-program-arsip-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Perubahan',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Prog',
            'ID_Prog',
            'No_ID',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',
        ],
    ]) ?>

</div>
