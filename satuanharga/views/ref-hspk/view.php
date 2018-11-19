<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk */
?>
<div class="ref-hspk-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Hspk1',
            'Kd_Hspk2',
            'Kd_Hspk3',
            'Kd_Hspk4',
            'Uraian_Kegiatan',
            'Kd_Satuan',
            'Harga',
            'kode',
        ],
    ]) ?>

</div>
