<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKabupaten */
?>
<div class="ref-kabupaten-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Provinsi','value' => $model->provinsi->Nm_Prov],
            ['label' => 'Kode Kabupaten','value' => $model->Kd_Kab],
            ['label' => 'Nama Kabupaten','value' => $model->Nm_Kab]
        ],
    ]) ?>

</div>
