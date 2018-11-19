<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaMisi */

$this->title = 'Ubah Misi: ' . $model->Ur_Misi;
$this->params['breadcrumbs'][] = "Rencana Strategis";
$this->params['breadcrumbs'][] = ['label' => 'Data Misi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Ur_Misi, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'No_Misi' => $model->No_Misi]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-misi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
