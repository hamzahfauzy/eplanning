<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaianKegiatan */

$this->title = 'Update Ref Penilaian Kegiatan: ' . $model->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ref Penilaian Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tahun, 'url' => ['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Program' => $model->Kd_Program, 'ID_Penilaian' => $model->ID_Penilaian]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-penilaian-kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
