<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaCapaianProgram */

$this->title = 'Ubah Ta Capaian Program: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Capaian Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-capaian-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
