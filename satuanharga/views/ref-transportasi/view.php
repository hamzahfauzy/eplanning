<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefTransportasi */
?>
<div class="ref-transportasi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Transportasi',
            'Nm_Transportasi',
        ],
    ]) ?>

</div>
