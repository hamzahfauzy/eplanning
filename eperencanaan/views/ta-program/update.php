<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaProgram */

$this->title = 'Update Ta Program: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'ID_Prog' => $model->ID_Prog, 'Ket_Prog' => $model->Ket_Prog, 'Kd_Urusan1' => $model->Kd_Urusan1, 'Kd_Bidang1' => $model->Kd_Bidang1]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-program-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
