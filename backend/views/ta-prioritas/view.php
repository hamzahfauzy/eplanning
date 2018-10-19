<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TaPrioritas */
?>
<div class="ta-prioritas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Prioritas',
            'Nm_Prioritas',
            'Tema',
        ],
    ]) ?>

</div>
