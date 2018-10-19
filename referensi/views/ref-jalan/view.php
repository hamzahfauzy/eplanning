<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefJalan */
?>
<div class="ref-jalan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Provinsi','value' => $model->provinsi->Nm_Prov],
            ['label' => 'Kabupaten','value' => $model->kabupaten->Nm_Kab],
            ['label' => 'Kecamatan','value' => $model->kecamatan->Nm_Kec],
            ['label' => 'Kelurahan','value' => $model->kelurahan->Nm_Kel],
            ['label' => 'Lingkungan','value' => $model->lingkungan->Nm_Lingkungan],
            ['label' => 'Kode Jalan','value' => $model->Kd_Jalan],
            ['label' => 'Nama Jalan','value' => $model->Nm_Jalan],
        ],
    ]) ?>

</div>
