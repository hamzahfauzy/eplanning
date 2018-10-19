<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaAgendaPerencanaanLingkungan */

$this->title = 'Update Ta Agenda Perencanaan Lingkungan: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Agenda Perencanaan Lingkungans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-agenda-perencanaan-lingkungan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
