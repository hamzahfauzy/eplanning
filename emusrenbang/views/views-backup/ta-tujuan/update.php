<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaTujuan */

$this->title = 'Update  Tujuan: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Tujuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi, 'No_Tujuan' => $model->No_Tujuan]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-tujuan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
