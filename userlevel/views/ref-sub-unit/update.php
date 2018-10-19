<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSubUnit */

$this->title = 'Ubah UPT: ' . $model->Nm_Sub_Unit;
$this->params['breadcrumbs'][] = "Unit Organisasi";
$this->params['breadcrumbs'][] = ['label' => 'UPT', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Sub_Unit, 'url' => ['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-sub-unit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
