<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefUsulan */
?>
<div class="ref-usulan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Usulan',
            'Kd_Klasifikasi',
            'Nm_Usulan',
        ],
    ]) ?>

</div>
