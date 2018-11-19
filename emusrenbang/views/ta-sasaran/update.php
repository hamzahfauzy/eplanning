<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaSasaran */

$this->title = 'Ubah Rencana Strategis Sasaran: ' . $model->Ur_Sasaran;
$this->params['breadcrumbs'][] = ['label' => 'Rencana Strategis Sasaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Ur_Sasaran, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan, 'No_Sasaran' => $model->No_Sasaran]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-sasaran-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataMisi' => $dataMisi,
        'dataTujuan' => $dataTujuan,
    ]) ?>

</div>
