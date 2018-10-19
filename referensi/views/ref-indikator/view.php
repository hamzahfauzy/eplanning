<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefIndikator */
?>
<div class="ref-indikator-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Indikator',
            'Nm_Indikator',
        ],
    ]) ?>

</div>
