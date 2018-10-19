<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaProgram */
?>
<div class="ta-program-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'urusan.Nm_Urusan',
            'bidang.Nm_Bidang',
            'refUnit.Nm_Unit',
            'refSubUnit.Nm_Sub_Unit',
            'Kd_Prog',
            'ID_Prog',
            'Ket_Prog',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',
            'Kd_Urusan1',
            'Kd_Bidang1',
        ],
    ]) ?>

</div>
