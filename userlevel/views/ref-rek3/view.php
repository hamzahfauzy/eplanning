<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRek3 */
?>
<div class="ref-rek3-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Nm_Rek_3',
            'SaldoNorm',
        ],
    ]) ?>

</div>
