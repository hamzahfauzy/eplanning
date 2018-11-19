<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefStandardHarga1 */
?>
<div class="ref-standard-harga1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_1',
            'Uraian',
        ],
    ]) ?>

</div>
