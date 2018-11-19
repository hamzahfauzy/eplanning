<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefAkrual3 */
?>
<div class="ref-akrual3-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Akrual_1',
            'Kd_Akrual_2',
            'Kd_Akrual_3',
            'Nm_Akrual_3',
            'SaldoNorm',
        ],
    ]) ?>

</div>
