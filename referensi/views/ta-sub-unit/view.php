<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaSubUnit */
?>
<div class="ta-sub-unit-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Nm_Pimpinan',
            'Nip_Pimpinan',
            'Jbt_Pimpinan',
            'Alamat',
            'Ur_Visi',
        ],
    ]) ?>

</div>
