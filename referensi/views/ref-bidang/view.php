<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefBidang */
?>
<div class="ref-bidang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Urusan',
            'Kd_Bidang',
            'Nm_Bidang',
            'Kd_Fungsi',
        ],
    ]) ?>

</div>
