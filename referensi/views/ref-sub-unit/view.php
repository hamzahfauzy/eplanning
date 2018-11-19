<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefSubUnit */
?>
<div class="ref-sub-unit-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Unit',
            'Kd_Sub',
            'Nm_Sub_Unit',
        ],
    ]) ?>

</div>
