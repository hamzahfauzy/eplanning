<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKeterangan */
?>
<div class="ref-keterangan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Keterangan',
            'Nm_Keterangan',
        ],
    ]) ?>

</div>
