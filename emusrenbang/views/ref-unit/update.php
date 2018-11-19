<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefUnit */

$this->title = 'Ubah SKPD: ' . $model->Nm_Unit;
$this->params['breadcrumbs'][] = "Unit Organisasi";
$this->params['breadcrumbs'][] = ['label' => 'SKPD', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Nm_Unit, 'url' => ['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ref-unit-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
