<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->title = 'Laporan Sub Unit';
$this->params['subtitle'] = 'Dokumen';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">PRIORITAS DAN SASARAN PEMBANGUNAN DAERAH</h3>
                <span class="label label-primary pull-right"><i class="fa fa-book"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Pemerintah Daerah', ['/ta-pemda/view', 'id'=>'2017'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc74-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan Kota', ['/rpjmd/tvc74'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc74-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Prioritas Pembangunan Daerah Kota', ['/rpjmd/tvc75'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc75-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Penjelasan Program Pembangunan Daerah ', ['/rpjmd/tvc76'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc76-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 82)
                            </span>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-sm-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">OPD</h3>
                <span class="label label-danger pull-right"><i class="fa fa-book"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Visi dan Pejabat OPD', ['/ta-sub-unit/index'], ['target' => '_blank', 'class'=>'product-title']) ?>
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
                            <?= Html::a('Program dan Kegiatan Prioritas OPD', [''], ['target' => '_blank', 'class'=>'product-title']) ?>
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
                            <?= Html::a('Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan OPD', ['/laporan-rkpd/tvc74'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan-rkpd/cetak-tvc74'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span>
                        </div>
                    </li
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Prioritas Pembangunan Daerah OPD', ['/laporan-rkpd/tvc75'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan-rkpd/cetak-tvc75'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 81)
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Rumusan Rencana Program dan Kegiatan OPD', ['/laporan/tvic10'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan/cetak-tvic10'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran vi halaman 34)
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kompilasi Program Dan Pagu Indikatif OPD', ['/laporan-pra-rka/index'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan-pra-rka/cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran v halaman 65)
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kajian Usulan Program dan Kegiatan OPD', ['/laporan-rkpd/tv1c13'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan-rkpd/cetak-tv1c13'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran vi halaman 37)
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja OPD', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                (Permendagri 54 Tahun 2010 lampiran vi halaman 41)
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>