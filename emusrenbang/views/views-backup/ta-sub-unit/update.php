<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaSubUnit */

$this->title = 'Data Umum Unit Organisasi: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Sub Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-sub-unit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
