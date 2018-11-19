<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaKegiatan */

$this->title = 'Update Ta Kegiatan: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
