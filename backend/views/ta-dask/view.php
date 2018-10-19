<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaDASK */
?>
<div class="ta-dask-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'No_DPA',
            'Tgl_DPA',
            'No_DPPA',
            'Tgl_DPPA',
        ],
    ]) ?>

</div>
