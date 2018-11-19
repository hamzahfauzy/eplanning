<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaPenilaianKegiatan */

$this->title = 'Update Ta Penilaian Kegiatan: ' . $model->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Penilaian Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tahun, 'url' => ['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Program' => $model->Kd_Program, 'Kd_Kegiatan' => $model->Kd_Kegiatan, 'ID_Penilaian' => $model->ID_Penilaian]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-penilaian-kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
