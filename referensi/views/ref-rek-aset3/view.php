<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRekAset3 */
?>
<div class="ref-rek-aset3-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Aset1',
            'Kd_Aset2',
            'Kd_Aset3',
            'Nm_Aset3',
        ],
    ]) ?>

</div>
