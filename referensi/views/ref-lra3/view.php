<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefLRA3 */
?>
<div class="ref-lra3-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Nm_Rek_3',
        ],
    ]) ?>

</div>
