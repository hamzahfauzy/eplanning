<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefJenisUsulan */
?>
<div class="ref-jenis-usulan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Prog',
            'Kd_Keg',
            'Kd_Klasifikasi',
            'Nm_Jenis_Usulan',
        ],
    ]) ?>

</div>
