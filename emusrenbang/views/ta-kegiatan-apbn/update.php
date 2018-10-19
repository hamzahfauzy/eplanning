<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaKegiatanApbn */

$this->title = 'Update Ta Kegiatan Apbn: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Kegiatan Apbns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-kegiatan-apbn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
