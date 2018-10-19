<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefFraksiDprd */
?>
<div class="ref-fraksi-dprd-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Fraksi',
            'Nm_Fraksi:ntext',
        ],
    ]) ?>

</div>
