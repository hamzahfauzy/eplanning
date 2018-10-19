<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRekAset4 */
?>
<div class="ref-rek-aset4-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Aset1',
            'Kd_Aset2',
            'Kd_Aset3',
            'Kd_Aset4',
            'Nm_Aset4',
        ],
    ]) ?>

</div>
