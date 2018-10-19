<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefGolongan */
?>
<div class="ref-golongan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Golongan',
            'Nm_Golongan',
        ],
    ]) ?>

</div>
