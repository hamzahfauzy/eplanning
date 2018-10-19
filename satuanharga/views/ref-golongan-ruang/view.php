<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefGolonganRuang */
?>
<div class="ref-golongan-ruang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Golongan',
            'Kd_Golongan_Ruang',
            'Nm_Golongan_Ruang',
        ],
    ]) ?>

</div>
