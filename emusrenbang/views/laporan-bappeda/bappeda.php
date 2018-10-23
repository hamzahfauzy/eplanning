<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->registerJsFile(
    '@web/js/laporan_bappeda.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Laporan Bappeda';
$this->params['subtitle'] = 'Dokumen';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-6">

        <!-- BOX 1 -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">PRIORITAS DAN SASARAN PEMBANGUNAN DAERAH</h3>
                <span class="label label-primary pull-right"><i class="fa fa-list"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Pemerintah Daerah', ['/ta-pemda/index'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc74-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                           <!-- <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span> -->
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan Daerah', ['/rpjmd/tvc74'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc74-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                           <!-- <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span> -->
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Prioritas Pembangunan Daerah', ['/rpjmd/tvc75'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc75-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                           <!-- <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span> -->
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Penjelasan Program Pembangunan Daerah', ['/rpjmd/tvc76'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc76-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                           <!-- <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Matriks Prioritas Pembangunan Daerah Tahun Anggaran '.(date("Y")+1), ['laporan-bappeda/mppk'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['laporan-bappeda/cetak-mppk'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <!-- <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
					    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Rancangan Awal RKPD Kabupaten Asahan Tahun '.(date("Y")+1), ['laporan-bappeda/tvic10all1'], ['class'=>'product-title']) ?> 
                            <?= Html::a('Download', ['laporan-bappeda/cetak-tvic10all1'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <!-- <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
							    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('RKPD Kabupaten Asahan Tahun '.(date("Y")+1), ['laporan-bappeda/tvic10all'], ['class'=>'product-title']) ?> 
                            <?= Html::a('Download', ['laporan-bappeda/cetak-tvic10all'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <!-- <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
					<li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info"> 
                            <?= Html::a('Berita Acara Musrenbang RKPD Kabupaten Asahan Tahun '.(date("Y")+1), ['laporan-bappeda/cetak-tvic10all6'], ['class'=>'product-title']) ?> 
                            <?= Html::a('Download', ['laporan-bappeda/cetak-tvic10all6'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <!-- <span class="product-description"> 
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
					<li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info"> 
                            <?= Html::a('Lampiran I Berita Acara Musrenbang RKPD Kabupaten Asahan Tahun '.(date("Y")+1), ['laporan-bappeda/cetak-tvic10all5'], ['class'=>'product-title']) ?> 
                            <?= Html::a('Download', ['laporan-bappeda/cetak-tvic10all5'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <!-- <span class="product-description"> 
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
					 <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info"> 
                            <?= Html::a('Lampiran II Berita Acara Musrenbang RKPD Kabupaten Asahan Tahun '.(date("Y")+1), ['laporan-bappeda/tvic10all3'], ['class'=>'product-title']) ?> 
                            <?= Html::a('Download', ['laporan-bappeda/cetak-tvic10all3'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <!-- <span class="product-description"> 
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
					
					<li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info"> 
                            <?php //Html::a('Lampiran III Berita Acara Musrenbang RKPD Kabupaten Asahan Tahun '.(date("Y")+1), ['laporan-bappeda/tvic10all2'], ['class'=>'product-title']) ?> 
                            <a href="#" class='product-title' data-toggle="modal" data-target="#myModal">Lampiran III Berita Acara Musrenbang RKPD Kabupaten Asahan Tahun <?= (date("Y")+1) ?></a>
                            <?= Html::a('Download', ['laporan-bappeda/cetak-tvic10all2'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <!-- <span class="product-description"> 
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
					
					<li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info"> 
                            <?= Html::a('Lampiran IV Berita Acara Musrenbang RKPD Kabupaten Asahan Tahun '.(date("Y")+1), ['laporan-bappeda/tvic10all4'], ['class'=>'product-title']) ?> 
                            <?= Html::a('Download', ['laporan-bappeda/cetak-tvic10all4'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <!-- <span class="product-description"> 
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span> -->
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- /.box -->
        <!-- END BOX 1 -->

        <!-- BOX 2 -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">PERANGKAT DAERAH</h3>
                <span class="label label-danger pull-right"><i class="fa fa-book"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <select class="form-control" id="pilih-skpd">
                  <option value="0">-pilih perangkat daerah-</option>
                  <?php
                    foreach ($RefSubUnit as $key => $value):
                    ?>
                      <option value="1" data-urusan='<?= $value->Kd_Urusan ?>' data-bidang='<?= $value->Kd_Bidang ?>' data-unit='<?= $value->Kd_Unit ?>' data-sub='<?= $value->Kd_Sub ?>' ><?= $value->Nm_Sub_Unit ?></option>
                    <?php
                    endforeach;
                  ?>
                </select>
                <input type="hidden" id="urusan">
                <input type="hidden" id="bidang">
                <input type="hidden" id="unit">
                <input type="hidden" id="sub">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Visi dan Pejabat Perangkat Daerah', ['/laporan-bappeda/visi'], ['target' => '_blank', 'class'=>'product-title btn_link']) ?>
                            <?php // Html::a('Visi dan Pejabat Perangkat Daerah', ['/ta-sub-unit/index'], ['target' => '_blank', 'class'=>'product-title btn_link']) ?>
                            <a href="">
                                <!-- <span class="label label-warning pull-right">Download</span> -->
                            </a>
                            <span class="product-description">
                                <!-- (Permendagri 54 Tahun 2010 lampiran v halaman 81) -->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Program dan Kegiatan Prioritas Perangkat Daerah', ['#'], ['target' => '_blank', 'class'=>'product-title btn_link ']) ?>
                            <a href="">
                                <!-- <span class="label label-warning pull-right">Download</span> -->
                            </a>
                            <span class="product-description">
                                <!-- (Permendagri 54 Tahun 2010 lampiran v halaman 81) -->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan Perangkat Daerah', ['/laporan-bappeda/tvc74'], ['class'=>'product-title btn_link']) ?>
                            <?php //Html::a('Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan Perangkat Daerah', ['/laporan-rkpd/tvc74'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['/laporan-bappeda/cetak-tvc74'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <?php // Html::a('Download', ['/laporan-rkpd/cetak-tvc74'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                          <!--  <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span>-->
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Prioritas Pembangunan Daerah Perangkat Daerah', ['/laporan-bappeda/tvc75'], ['class'=>'product-title btn_link']) ?>
                            <?php //Html::a('Prioritas Pembangunan Daerah Perangkat Daerah', ['/laporan-rkpd/tvc75'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['/laporan-bappeda/cetak-tvc75'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <?php // Html::a('Download', ['/laporan-rkpd/cetak-tvc75'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                          <!--  <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span> -->
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Rumusan Rencana Program dan Kegiatan Perangkat Daerah', ['/laporan-bappeda/tvic10'], ['class'=>'product-title btn_link']) ?>
                            <?php // Html::a('Rumusan Rencana Program dan Kegiatan Perangkat Daerah', ['/laporan/tvic10'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['/laporan-bappeda/cetak-tvic10'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <?php // Html::a('Download', ['/laporan/cetak-tvic10'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                                                          <!--  <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran vi halaman 34)
                            </span> -->
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kompilasi Program Dan Pagu Indikatif Perangkat Daerah', ['/laporan-bappeda/kompilasi-program'], ['class'=>'product-title btn_link']) ?>
                            <?php // Html::a('Kompilasi Program Dan Pagu Indikatif Perangkat Daerah', ['/laporan-pra-rka/index'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['/laporan-bappeda/cetak-kompilasi-program'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <?php // Html::a('Download', ['/laporan-pra-rka/cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <span class="product-description">
                                                             <!--   (Permendagri 54 Tahun 2010 lampiran v halaman 65) -->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kajian Usulan Program dan Kegiatan Perangkat Daerah', ['/laporan-bappeda/tv1c13'], ['class'=>'product-title btn_link']) ?>
                            <?php // Html::a('Kajian Usulan Program dan Kegiatan Perangkat Daerah', ['/laporan-rkpd/tv1c13'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['/laporan-bappeda/cetak-tv1c13'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <?php // Html::a('Download', ['/laporan-rkpd/cetak-tv1c13'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <span class="product-description">
                                                                <!--(Permendagri 54 Tahun 2010 lampiran vi halaman 37)-->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['laporan-bappeda/tv1c1'], ['class'=>'product-title btn_link']) ?>
                            <?php // Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['laporan-bappeda/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <?php // Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <span class="product-description">
                                                               <!-- (Permendagri 54 Tahun 2010 lampiran vi halaman 41) -->
                            </span>
                        </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Hasil Verifikasi Rencana Kerja Perangkat Daerah', ['/laporan-bappeda/verifikasi-renja'], ['class'=>'product-title btn_link']) ?>
                            <?php // Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['/laporan-bappeda/cetak-verifikasi-renja'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <?php // Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <span class="product-description">
                            </span>
                        </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kajian Usulan Program dan Kegiatan dari Masyarakat Tahun '.(date("Y")+1), ['/laporan-bappeda/tvic16'], ['class'=>'product-title btn_link']) ?> 
                            <?php // Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['/laporan-bappeda/cetak-verifikasi-renja'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <?php // Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <span class="product-description">
                            </span>
                        </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Rincian Anggaran Belanja Langsung Menurut Program dan per Kegiatan Satuan Kerja', ['/laporan-bappeda/laporan-rka'], ['class'=>'product-title btn_link']) ?>
                            <span class="product-description">
                            </span>
                        </div>
                    </li>

                </ul>
            </div>
        </div><!-- /.box -->
        <!-- END BOX 2 -->

    </div><!-- /.col -->

    <div class="col-md-6">

        <!-- BOX 3 -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Penyelarasan Rencana Program Prioritas Beserta Pagu Indikatif</h3>
                <span class="label label-primary pull-right"><i class="fa fa-list"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Prioritas dan Sasaran Pembangunan Daerah', ['rpjmd/tvc63'], ['class' => 'product-title']) ?>
                            <a href="">
                                <span class="label label-warning pull-right">Download</span>
                            </a>
                            <span class="product-description">
                                                                <!--(Permendagri 54 Tahun 2010 lampiran v halaman 64)-->
                            </span>
                        </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Penetapan Proporsi Alokasi Dana Pagu Indikatif', ['rpjmd/tvc64'], ['class' => 'product-title']) ?>
                            <a href="">
                                <span class="label label-warning pull-right">Download</span>
                            </a>
                            <span class="product-description">
                                                                <!--(Permendagri 54 Tahun 2010 lampiran v halaman 64)-->
                            </span>
                        </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kompilasi Program Dan Pagu Indikatif Tiap Perangkat Daerah', ['/laporan-pra-rka/index'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/laporan-pra-rka/cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                            <span class="product-description">
                                                               <!-- (Permendagri 54 Tahun 2010 lampiran v halaman 65)-->
                            </span>
                        </div>
                    </li>
                <!-- /.item -->
                </ul>
            </div>
        </div><!-- /.box -->
        <!-- END BOX 3 -->

        <!-- BOX 4 -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">KUA PPAS</h3>
                <span class="label label-danger pull-right"><i class="fa fa-book"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <select class="form-control" id="pilih-skpd-2">
                  <option value="0">-pilih perangkat daerah-</option>
                  <?php
                    foreach ($RefSubUnit as $key => $value):
                    ?>
                      <option value="1" data-urusan='<?= $value->Kd_Urusan ?>' data-bidang='<?= $value->Kd_Bidang ?>' data-unit='<?= $value->Kd_Unit ?>' data-sub='<?= $value->Kd_Sub ?>' ><?= $value->Nm_Sub_Unit ?></option>
                    <?php
                    endforeach;
                  ?>
                </select>
                <input type="hidden" id="urusan">
                <input type="hidden" id="bidang">
                <input type="hidden" id="unit">
                <input type="hidden" id="sub">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                    <?= Html::a('Matriks Prioritas Pembangunan Daerah Tahun Anggaran '.(date("Y")+1), ['laporan-bappeda/mppkp1'], ['class'=>'product-title btn_link_2']);?>
                            <?= Html::a('Download', ['laporan-bappeda/mppkp1'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link_2']) ?>
                    </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">

                            <?= Html::a('Matriks Prioritas Pembangunan Daerah Perubahan Tahun Anggaran '.(date("Y")+1), ['laporan-bappeda/mppkp'], ['class'=>'product-title btn_link_2']);?>
                            <?php // Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['laporan-bappeda/mppkp'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link_2']) ?>
                            <?php // Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <!-- <span class="product-description">
                                                                (Permendagri 54 Tahun 2010 lampiran vi halaman 41)
                            </span> -->
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">

                            <?= Html::a('Plafon Anggaran Sementara Berdasarkan Program dan Kegiatan Tahun Anggaran '.(date("Y")+1),  ['laporan-bappeda/paspbpk1'], ['class'=>'product-title btn_link_2']) ?>
                            <?php // Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['laporan-bappeda/paspbpk'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link_2']) ?>
                            <?php // Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <!-- <span class="product-description">
                                                                (Permendagri 54 Tahun 2010 lampiran vi halaman 41)
                            </span> -->
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Plafon Anggaran Sementara Perubahan Berdasarkan Program dan Kegiatan Tahun Anggaran '.(date("Y")+1), ['laporan-bappeda/paspbpk'], ['class'=>'product-title btn_link_2']) ?>
                            <?php // Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['laporan-bappeda/paspbpk'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link_2']) ?>
                            <?php // Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                            <!-- <span class="product-description">
                                                                (Permendagri 54 Tahun 2010 lampiran vi halaman 41)
                            </span> -->
                        </div>
                    </li>
                </ul
                </ul>
            </div>
        </div><!-- /.box -->
        <!-- BOX 4 -->

    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form>
    <input type="hidden" name="r" value="laporan-bappeda/tvic10all2">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pilih OPD</h4>
      </div>
      <div class="modal-body">
        <label>Pilih Urusan :</label>
        <select name="urusan" class="form-control urusan" required>
            <option value="">Pilih Urusan</option>
            <?php foreach($RefUrusan as $urusan): ?>
            <option value="<?=$urusan->Kd_Urusan?>"><?=$urusan->Nm_Urusan?></option>
            <?php endforeach ?>
        </select>
        <label>Pilih Bidang :</label>
        <select name="bidang" class="form-control bidang" required>
            <option value="">Pilih Bidang</option>
        </select>
        <label>Pilih Unit :</label>
        <select name="unit" class="form-control unit" required>
            <option value="">Pilih Unit</option>
        </select>
        <label>Pilih Sub Unit :</label>
        <select name="sub" class="form-control subunit" required>
            <option value="">Pilih Sub Unit</option>
        </select>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>

  </div>
</div>

<script src="/eperencanaan/emusrenbang/web/assets/687adee6/jquery.js"></script>
<script>
$(".urusan").change(function(){
	var val = $(".urusan").val()
    $.get("index.php?r=laporan-bappeda/get-data&urusan="+val,function(response){
        if(response)
        {
            var content = "<option value=''>Pilih Bidang</option>"
            for(i=0;i<response.length;i++)
            {
                content += "<option value='"+response[i][0]+"'>"+response[i][1]+"</option>"
            }
            $(".bidang").html(content)
        }
    },"json")
})

$(".bidang").change(function(){
    var urusan = $(".urusan").val()
    var val = $(this).val()
    $.get("index.php?r=laporan-bappeda/get-data&urusan="+urusan+"&bidang="+val,function(response){
        if(response)
        {
            var content = "<option value=''>Pilih Unit</option>"
            for(i=0;i<response.length;i++)
            {
                content += "<option value='"+response[i][0]+"'>"+response[i][1]+"</option>"
            }
            $(".unit").html(content)
        }
    },"json")
})

$(".unit").change(function(){
    var urusan = $(".urusan").val()
    var bidang = $(".bidang").val()
    var val = $(this).val()
    $.get("index.php?r=laporan-bappeda/get-data&urusan="+urusan+"&bidang="+bidang+"&unit="+val,function(response){
        if(response)
        {
            var content = "<option value=''>Pilih Sub Unit</option>"
            for(i=0;i<response.length;i++)
            {
                content += "<option value='"+response[i][0]+"'>"+response[i][1]+"</option>"
            }
            $(".subunit").html(content)
        }
    },"json")
})
</script>