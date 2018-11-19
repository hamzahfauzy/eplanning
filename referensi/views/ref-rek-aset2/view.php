<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRekAset2 */
?>
<div class="ref-rek-aset2-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Aset1',
            'Kd_Aset2',
            'Nm_Aset2',
        ],
    ]) ?>

</div>
