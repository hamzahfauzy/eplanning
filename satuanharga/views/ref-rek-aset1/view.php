<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRekAset1 */
?>
<div class="ref-rek-aset1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Aset1',
            'Nm_Aset1',
        ],
    ]) ?>

</div>