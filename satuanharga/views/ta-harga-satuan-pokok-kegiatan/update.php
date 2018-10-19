<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaHargaSatuanPokokKegiatan */

$this->title = 'Update Ta Harga Satuan Pokok Kegiatan: ' . $model->Kd_Benua;
$this->params['breadcrumbs'][] = ['label' => 'Ta Harga Satuan Pokok Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Benua, 'url' => ['view', 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2, 'Kd_Aset3' => $model->Kd_Aset3, 'Kd_Aset4' => $model->Kd_Aset4, 'Kd_Aset5' => $model->Kd_Aset5, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2, 'Kd_3' => $model->Kd_3, 'Kd_Satuan' => $model->Kd_Satuan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-harga-satuan-pokok-kegiatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
