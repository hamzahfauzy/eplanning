<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefStatusUsulan */
?>
<div class="ref-status-usulan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Status',
            'Nm_Status',
        ],
    ]) ?>

</div>
