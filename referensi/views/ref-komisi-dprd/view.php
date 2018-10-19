<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKomisiDprd */
?>
<div class="ref-komisi-dprd-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Komisi',
            'Nm_Komisi:ntext',
            'Keterangan:ntext',
        ],
    ]) ?>

</div>
