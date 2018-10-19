<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefProgram */
?>
<div class="ref-program-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Urusan',
            'Kd_Bidang',
            'Kd_Prog',
            'Ket_Program',
        ],
    ]) ?>

</div>
