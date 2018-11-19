<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaForumLingkungan2 */

$this->title = 'Ubah Data';
$this->params['breadcrumbs'][] = ['label' => 'Ta Forum Lingkungan2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Ta_Forum_Lingkungan' => $model->Kd_Ta_Forum_Lingkungan, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-forum-lingkungan2-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('tambah_usulan', [
        'model' => $model,
    ]) ?>

</div>
