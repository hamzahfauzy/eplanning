<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaTimAnggaran */
?>
<div class="ta-tim-anggaran-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Tim',
            'No_Urut',
            'Nama',
            'NIP',
            'Jabatan',
        ],
    ]) ?>

</div>
