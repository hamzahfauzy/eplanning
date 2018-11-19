<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefEntry */
?>
<div class="ref-entry-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Penandatangan',
            'Nm_Penandatangan',
            'Nip_Penandatangan',
            'Jbt_Penandatangan',
            'Jns_Dokumen',
        ],
    ]) ?>

</div>
