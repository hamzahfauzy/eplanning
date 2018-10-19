<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaTupok */
?>
<div class="ta-tupok-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'No_Tupok',
            'Ur_Tupok',
        ],
    ]) ?>

</div>
