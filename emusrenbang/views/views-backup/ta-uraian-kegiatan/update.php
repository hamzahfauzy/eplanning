<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaUraianKegiatan */

$this->title = 'Update Ta Uraian Kegiatan: ' . $model->tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Uraian Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tahun, 'url' => ['view', 'tahun' => $model->tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-uraian-kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
