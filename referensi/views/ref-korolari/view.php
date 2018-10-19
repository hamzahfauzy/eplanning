<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKorolari */
?>
<div class="ref-korolari-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
            'Kd_Rek_5',
            'D_Rek_1',
            'D_Rek_2',
            'D_Rek_3',
            'D_Rek_4',
            'D_Rek_5',
            'K_Rek_1',
            'K_Rek_2',
            'K_Rek_3',
            'K_Rek_4',
            'K_Rek_5',
        ],
    ]) ?>

</div>
