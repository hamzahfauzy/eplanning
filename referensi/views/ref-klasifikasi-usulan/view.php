<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKlasifikasiUsulan */
?>
<div class="ref-klasifikasi-usulan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Klasifikasi',
            'Nm_Klasifikasi',
        ],
    ]) ?>

</div>
