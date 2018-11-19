<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaCapaianProgram */
?>
<div class="ta-capaian-program-view">
 
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
            'No_ID',
            'Tolak_Ukur',
            'Target_Angka',
            'Target_Uraian',
        ],
    ]) ?>

</div>
