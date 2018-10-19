<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKegiatan */

$this->title = 'Ubah Kegiatan: ' . $model->Ket_Kegiatan;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Ket_Kegiatan, 'url' => ['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub_Unit' => $model->Kd_Sub_Unit,'Pagu_Indikatif' => $model->Pagu_Indikatif]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-kegiatan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
