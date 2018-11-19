<?php
use yii\helpers\Html;
?>
<div class="w-info-chart-meta">
    <div class="top-stat-box">
        <div class="row">
            <div class="col-md-3 right-light-border col-sm-6">
                <div class="stat-w-wrap ca-center number-rotate">
                    <span class="stat-w-title">Pagu Indikatif Lingkungan</span>
                    <a href="#" class="ico-cirlce-widget w_bg_green">
                        <span><i class="fa fa-money"></i></span>
                    </a>
                    <div class="w-meta-info w-currency">
                        <span class="w-meta-value number-animate" data-value="330" data-animation-duration="1500">0</span>
                        <span class="w-meta-title">Lingkungan 1</span>
                        <span class="w-previos-stat">Sisa : Rp. 0</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 right-light-border col-sm-6">
                <div class="stat-w-wrap ca-center number-rotate">
                    <span class="stat-w-title">Pagu Indikatif Kelurahan</span>
                    <a href="#" class="ico-cirlce-widget w_bg_red">
                        <span><i class="fa fa-money"></i></span>
                    </a>
                    <div class="w-meta-info w-currency">
                        <span class="w-meta-value number-animate" data-value="330" data-animation-duration="1500">0</span>
                        <span class="w-meta-title">Kelurahan ABC</span>
                        <span class="w-previos-stat">Sisa : Rp. 0</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 right-light-border col-sm-6">
                <div class="stat-w-wrap ca-center number-rotate">
                    <span class="stat-w-title">Pagu Indikatif Kecamatan</span>
                    <a href="#" class="ico-cirlce-widget w_bg_yellow">
                        <span><i class="fa fa-money"></i></span>
                    </a>
                    <div class="w-meta-info w-currency">
                        <span class="w-meta-value number-animate" data-value="330" data-animation-duration="1500">0</span>
                        <span class="w-meta-title">Kecamatan ABC</span>
                        <span class="w-previos-stat">Sisa : Rp. 0</span>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-sm-6">
                <div class="ca-center stat-w-wrap">
                    <?php if (!$acara->exists() == 0) : ?>
                        <a href="../web/sop/sopwarga.pdf"><span class="stat-w-title">DOWNLOAD ABSENSI</span></a>
                        <i class="fa fa-4x fa-file-text-o sr-icons"></i>
                        <br>
                        <hr>
                        <?= Html::a('<span class="glyphicon glyphicon-download"></span> Download Absensi', ['lingkungan/absen-download', 'filename' => '113020256_bab12016-12-22_05-34-19.pdf', 'kode' => '1'], ['class' => 'btn btn-primary']) ?>
                    <?php elseif ($acara->Waktu_Mulai == 0) : ?>
                        <span class="stat-w-title">MULAI FORUM</span>
                        <br>
                        <?= Html::a('<span class="glyphicon glyphicon-download"></span> MULAI', ['lingkungan/mulai', 'kode' => '2'], ['class' => 'btn btn-primary btn-lg']) ?>
                    <?php else : ?>
                        <span class="stat-w-title">HENTIKAN FORUM</span>
                        <br>
                        <?= Html::a('<span class="glyphicon glyphicon-download"></span> SELESAI', ['lingkungan/selesai', 'kode' => '2'], ['class' => 'btn btn-danger btn-lg']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
