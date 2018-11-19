<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKetBiaya */
?>
<div class="ref-ket-biaya-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Ket_Biaya',
            'Nm_Ket_Biaya',
        ],
    ]) ?>

</div>
