<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanSkpd */

$this->title = 'Update Kegiatan Skpd: ' . $model->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan Skpd', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tahun, 'url' => ['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="kegiatan-skpd-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
