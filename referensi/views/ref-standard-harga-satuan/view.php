<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefStandardSatuan */
?>
<div class="ref-standard-satuan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Satuan',
            'Uraian',
        ],
    ]) ?>

</div>
