<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefPotSPM */
?>
<div class="ref-pot-spm-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Pot',
            'Nm_Pot',
            'Kd_MAP',
        ],
    ]) ?>

</div>
