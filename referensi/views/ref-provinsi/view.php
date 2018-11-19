<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefProvinsi */
?>
<div class="ref-provinsi-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Kode Provinsi', 'value' => $model->Kd_Prov],
            ['label' => 'Nama Provinsi', 'value' => $model->Nm_Prov],
        ],
    ]) ?>

</div>
