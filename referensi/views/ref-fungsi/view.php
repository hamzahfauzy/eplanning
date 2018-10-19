<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefFungsi */
?>
<div class="ref-fungsi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Fungsi',
            'Nm_Fungsi',
        ],
    ]) ?>

</div>
