<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRekAset5 */
?>
<div class="ref-rek-aset5-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Aset1',
            'Kd_Aset2',
            'Kd_Aset3',
            'Kd_Aset4',
            'Kd_Aset5',
            'Nm_Aset5',
        ],
    ]) ?>

</div>
