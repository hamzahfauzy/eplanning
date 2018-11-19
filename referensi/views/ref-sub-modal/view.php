<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefSubModal */
?>
<div class="ref-sub-modal-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Kd_Rek_3',
            'Kd_Rek_4',
            'Kd_Rek_5',
            'Kd_Sub_Modal',
            'Nm_Sub_Modal',
        ],
    ]) ?>

</div>
