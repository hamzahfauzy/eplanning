<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefLRA1 */
?>
<div class="ref-lra1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Rek_1',
            'Nm_Rek_1',
        ],
    ]) ?>

</div>
