<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefLingkungan */
?>
<div class="ref-lingkungan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Provinsi','value' => $model->provinsi->Nm_Prov],
            ['label' => 'Kabupaten','value' => $model->kabupaten->Nm_Kab],
            ['label' => 'Kecamatan','value' => $model->kecamatan->Nm_Kec],
            ['label' => 'Kelurahan','value' => $model->kelurahan->Nm_Kel],
            ['label' => 'Kode Lingkungan','value' => $model->Kd_Lingkungan],
            ['label' => 'Nama Lingkungan','value' => $model->Nm_Lingkungan],
        ],
    ]) ?>

</div>
