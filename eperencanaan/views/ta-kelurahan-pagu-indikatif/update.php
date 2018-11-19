<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKelurahanPaguIndikatif */

$this->title = 'Update Ta Kelurahan Pagu Indikatif: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Kelurahan Pagu Indikatifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut' => $model->Kd_Urut]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-kelurahan-pagu-indikatif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
