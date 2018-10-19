<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefLRA2 */
?>
<div class="ref-lra2-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Rek_1',
            'Kd_Rek_2',
            'Nm_Rek_2',
        ],
    ]) ?>

</div>
