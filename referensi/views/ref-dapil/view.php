<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefDapil */
?>
<div class="ref-dapil-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Tahun',
            'Kd_Dapil',
            'Nm_Dapil:ntext',
        ],
    ]) ?>

</div>
