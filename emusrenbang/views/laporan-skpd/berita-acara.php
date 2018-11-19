<?php

use yii\helpers\Html;
use emusrenbang\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\TaKegiatan;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$ref=new Referensi;


// $this->title = "Laporan RKPD Tahun ".($tahun);
$this->title = "Berita Acara ";
$this->params['breadcrumbs'][] = $this->title;

// $level = Yii::$app->user->level;
// $namalengkap='';
// if($level != "admin"){
//     $namalengkap=Yii::$app->user->identity->nama_lengkap;
// }
?>


<div class="box box-success">
    <div class="box-header with-border">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
                              'id' => 's',
                    'action' => ['laporan/berita-acara-cetak'], 
                    'options' => ['target' => '_blank']
        ]) ?>
        <h4>Pelaksanaan</h4>
        <div class="form-inline">
            <div class="form-group">
                <label>&emsp;Tanggal : &emsp;</label>
                <input type="date" class="form-control" name="tanggal" required=""/>
            </div>
            <div class="form-group">
                <label>&emsp;Waktu : &emsp;</label>
                <input type="time" class="form-control" name="waktu" required=""/>
            </div>
            <div class="form-group">
                <label>&emsp;Tempat : &emsp;</label>
                <textarea class="form-control" name="tempat" required=""></textarea>
            </div>
        </div>
        <hr>
        <h4>Pimpinan Sidang</h4>
        <div class="form-inline">
            <div class="form-group">
                <label>&emsp;Nama : &emsp;</label>
                <input type="input" class="form-control" name="nama" required=""/>
            </div>
            <div class="form-group">
                <label>&emsp;Jabatan : &emsp;</label>
                <input type="input" class="form-control" name="jabatan" required=""/>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>
                </div>
            </div>
        </div>
        <?php \yii\bootstrap\ActiveForm::end() ?>
    </div>
</div>