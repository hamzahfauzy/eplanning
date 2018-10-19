<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRek1 */
?>
<div class="ref-rek1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Kode Rekening', 'value' => $model->Kd_Rek_1],
            ['label' => 'Nama Rekening', 'value' => $model->Nm_Rek_1],
        ],
    ]) ?>

</div>
