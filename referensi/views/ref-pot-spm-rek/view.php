<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefPotSPMRek */
?>
<div class="ref-pot-spmrek-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Pot_Rek',
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
            'Kd_Rek_5',
            'Kd_Pot',
        ],
    ]) ?>

</div>
