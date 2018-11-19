<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefTransportasiKelas */
?>
<div class="ref-transportasi-kelas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Transportasi',
            'Kd_Kelas',
            'Nm_Kelas',
        ],
    ]) ?>

</div>
