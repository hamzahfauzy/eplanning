<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahanAcara */

$this->title = 'Update Ta Musrenbang Kelurahan Acara: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kelurahan Acaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-musrenbang-kelurahan-acara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
