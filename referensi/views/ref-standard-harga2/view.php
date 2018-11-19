<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefStandardHarga2 */
?>
<div class="ref-standard-harga2-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_1',
            'Kd_2',
            'Uraian',
        ],
    ]) ?>

</div>
