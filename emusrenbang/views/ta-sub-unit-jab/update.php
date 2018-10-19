<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaSubUnitJab */

$this->title = 'Ubah Ta Sub Unit Jab: ' . $model->Tahun;
$this->params['breadcrumbs'][] = "Data Umum";
$this->params['breadcrumbs'][] = ['label' => 'Data Jabatan Unit Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Jab' => $model->Kd_Jab, 'No_Urut' => $model->No_Urut]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-sub-unit-jab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
