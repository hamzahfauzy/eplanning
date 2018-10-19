<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKecamatanPaguIndikatif */

$this->title = 'Update Ta Kecamatan Pagu Indikatif: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Kecamatan Pagu Indikatifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-kecamatan-pagu-indikatif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
