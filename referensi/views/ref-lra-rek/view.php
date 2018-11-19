<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefLRARek */
?>
<div class="ref-lrarek-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_LRA_1',
            'Kd_LRA_2',
            'Kd_LRA_3',
            'Kd_LRA_4',
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
        ],
    ]) ?>

</div>
