<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaSubUnitJab */
?>
<div class="ta-sub-unit-jab-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Kd_Jab',
            'No_Urut',
            'Nama',
            'Nip',
            'Jabatan',
        ],
    ]) ?>

</div>
