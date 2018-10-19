<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKegiatan */
?>
<div class="ref-kegiatan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Prog',
            'Kd_Keg',
            'Ket_Kegiatan:ntext',
        ],
    ]) ?>

</div>
