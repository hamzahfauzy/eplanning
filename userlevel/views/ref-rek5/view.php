<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRek5 */
?>
<div class="ref-rek5-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
            'Kd_Rek_5',
            'Nm_Rek_5',
            'Peraturan',
        ],
    ]) ?>

</div>
