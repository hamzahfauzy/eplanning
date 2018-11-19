<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaAgendaPerencanaanKelurahan */

$this->title = 'Update Ta Agenda Perencanaan Kelurahan: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Agenda Perencanaan Kelurahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-agenda-perencanaan-kelurahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
