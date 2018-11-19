<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaHonorStandard */
?>
<div class="ta-honor-standard-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Standard',
            'Tahun',
            'Kd_Honor_Sub_Jabatan',
            'Nilai',
            'Kd_Satuan',
        ],
    ]) ?>

</div>
