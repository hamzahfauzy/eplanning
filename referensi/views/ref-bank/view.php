<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefBank */
?>
<div class="ref-bank-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Bank',
            'Nm_Bank',
            'No_Rekening',
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
            'Kd_Rek_5',
        ],
    ]) ?>

</div>
