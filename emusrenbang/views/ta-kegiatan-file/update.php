<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaKegiatanFile */

$this->title = 'Update Ta Kegiatan File: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Kegiatan Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-kegiatan-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
