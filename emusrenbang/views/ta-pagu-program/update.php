<?php

use yii\helpers\Html;
use app\models\Referensi;
$ref=new Referensi();

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguProgram */

$this->title = 'Update Ta Pagu Program: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Pagu Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog]];
$this->params['breadcrumbs'][] = 'Ubah';
$prog=$ref->getProgramBidangUrusan($model->Kd_Urusan, $model->Kd_Bidang);
$bidang=$ref->getBidangUrusan($model->Kd_Urusan);
$unit=$ref->getUnitBidangUrusan($model->Kd_Urusan, $model->Kd_Bidang);
?>
<div class="ta-pagu-program-update">


    <?= $this->render('_form', [
       'model' => $model,
        'prog'=>$prog,
        'bidang'=>$bidang,
        'unit'=>$unit,
    ]) ?>

</div>
