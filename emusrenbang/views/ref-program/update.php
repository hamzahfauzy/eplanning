<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */

$this->title = 'Ubah: ' . $model->Ket_Program;
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Ket_Program, 'url' => ['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-program-update">

    <?= $this->render('_form', [
        'model' => $model,
        'kp' => $kp,
    ]) ?>

</div>
