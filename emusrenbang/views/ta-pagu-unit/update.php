<?php

use yii\helpers\Html;
use emusrenbang\models\Referensi; //sebelumnya use app\models\Referensi;

$ref=new Referensi();

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguUnit */

$this->title = 'Ubah Ta Pagu Unit: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Pagu Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit]];
$this->params['breadcrumbs'][] = 'Ubah';

$bidang=$ref->getBidangUrusan($model->Kd_Urusan);
$unit=$ref->getUnitBidangUrusan($model->Kd_Urusan, $model->Kd_Bidang);
?>
<div class="ta-pagu-unit-update">

    <?= $this->render('_form', [
        'model' => $model,
        'bidang'=>$bidang,
        'unit'=>$unit,
    ]) ?>

</div>
