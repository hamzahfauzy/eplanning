<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefRek2 */
?>
<div class="ref-rek2-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label'=>'Kode Rekening', 'value'=>$model->kdRek1->Kd_Rek_1.'.'.$model->Kd_Rek_2],
            ['label' => 'Golongan Rekening 1', 'value' => $model->kdRek1->Nm_Rek_1],
            ['label' => 'Nama Rekening', 'value' => $model->Nm_Rek_2]
        ],
    ]) ?>

</div>
