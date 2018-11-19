<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefStandardHarga3 */
?>
<div class="ref-standard-harga3-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_1',
            'Kd_2',
            'Kd_3',
            'Uraian',
            'Harga',
            'Satuan',
            'Keterangan',
        ],
    ]) ?>

</div>
