<?php

use yii\helpers\Html;
use app\models\Referensi;
$ref=new Referensi();


/* @var $this yii\web\View */
/* @var $model app\models\KegiatanSkpd */

$this->title = 'Tambah Kegiatan Rencana Kerja';
$this->params['breadcrumbs'][] = $this->title;

$urusan=Yii::$app->user->identity->id_urusan;
$bidang=Yii::$app->user->identity->id_bidang;

$prog=$ref->getProgramBidangUrusan($urusan, $bidang);
?>
<div class="kegiatan-skpd-create">

    <?= $this->render('_form', [
        'model' => $model,
        'prog'=>$prog,
        'kdurusan'=>$urusan,
        'kdbidang'=>$bidang,
    ]) ?>

</div>
