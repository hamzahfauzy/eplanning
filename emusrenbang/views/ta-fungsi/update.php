<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaFungsi */

$this->title = 'Ubah: ' . $model->Ur_Fungsi;
$this->params['breadcrumbs'][] = "Rencana Strategis";
$this->params['breadcrumbs'][] = ['label' => 'Fungsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Ur_Fungsi, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Fungsi' => $model->No_Fungsi]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-fungsi-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
