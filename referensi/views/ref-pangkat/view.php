<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefPangkat */
?>
<div class="ref-pangkat-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Golongan',
            'Kd_Golongan_Ruang',
            'Kd_Pangkat',
            'Nm_Pangkat',
        ],
    ]) ?>

</div>
