<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaPrioritasBTL */
?>
<div class="ta-prioritas-btl-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Prioritas',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
            'Kd_Rek_5',
        ],
    ]) ?>

</div>
