<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaTupok */

$this->title = 'Update Tugas Pokok: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Tugas Pokok', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Tupok' => $model->No_Tupok]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-tupok-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
