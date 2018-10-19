<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRpjmd */
?>
<div class="ref-rpjmd-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Prioritas_Pembangunan_Kota',
            'Nm_Prioritas_Pembangunan_Kota',
            'Keterangan:ntext',
        ],
    ]) ?>

</div>
