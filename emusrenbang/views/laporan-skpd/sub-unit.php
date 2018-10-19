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
                                <!--(Permendagri 54 Tahun 2010 lampiran v halaman 81)-->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan Daerah', ['/rpjmd/tvc74'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc74-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                            <span class="product-description">
                                <!--(Permendagri 54 Tahun 2010 lampiran v halaman 81)-->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Prioritas Pembangunan Daerah', ['/rpjmd/tvc75'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc75-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
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
                            <?= Html::a('Penjelasan Program Pembangunan Daerah', ['/rpjmd/tvc76'], ['class' => 'product-title']) ?>
                            <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc76-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                            <span class="product-description">
                                                              <!--  (Permendagri 54 Tahun 2010 lampiran v halaman 82)-->
                            </span>
                        </div>
                    </li>      
                </ul>
            </div>
        </div><!-- /.box -->
            <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">LAPORAN PENGGUNAAN PAGU INDIKATIF PERANGKAT DAERAH</h3>
                <span class="label label-primary pull-right"><i class="fa fa-book"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                        <table class="table table-bordered">
                        <tr>
                            <td>Pagu Indikatif Perangkat Daerah</td>
                            <td>:</td>
                            <td align="right">
                                <?php 
                                    $pagu_skpd = @$data->paguSubUnit->pagu;
                                    echo number_format($pagu_skpd,2, ',','.'); 
                                ?>
                            </td>
                        </tr>
                      <tr>
                            <td>Pemakaian Pagu Indikatif Perangkat Daerah</td>
                            <td>:</td>
                            <td align="right">
                                <?php 
                                    $pemakaian_skpd = $data->getBelanjaRincSubs()->sum('Total');
                                    echo number_format($pemakaian_skpd,2, ',','.'); 
                                ?>
                            </td>
                        </tr>
                         <tr>
                            <td>Sisa Pagu Indikatif Perangkat Daerah</td>
                            <td>:</td>
                            <td align="right">
                                <?php 
                                    $sisa_skpd = $pagu_skpd - $pemakaian_skpd;
                                    echo number_format($sisa_skpd,2, ',','.'); 
                                ?>
                            </td>
                        </tr>
                    </table>
                    </div>
                    </li>

                    <li>
                    <table class="table table-bordered">
                    <tr>
                        <td style="font-size:12px;"><b>Penggunaan Pagu Untuk Program</b></td>
                        <td></td>
                    </tr>

                    <?php 
                    foreach ($dataKegiatan as $data): 
                    if ($data->getKegiatans()->count()<=0) {
                        continue;
                    }
                    ?>

                    <tr>
                        <td style="font-size:11px;" > <?= $data->refProgram['Ket_Program'] ?></td>
                        <td style="font-size:11px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                    </tr>

                    <?php endforeach;?>

                    <tr>
                        <td>Total</td>
                        <td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                    </tr>
                    </table>
                    </li>                    
                </ul>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-sm-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">PERANGKAT DAERAH</h3>
                <span class="label label-danger pull-right"><i class="fa fa-book"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Visi dan Pejabat Perangkat Daerah', ['/ta-sub-unit/index'], ['target' => '_blank', 'class'=>'product-title']) ?>
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
                            <?= Html::a('Program dan Kegiatan Prioritas Perangkat Daerah', [''], ['target' => '_blank', 'class'=>'product-title']) ?>
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
                            <?= Html::a('Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan Perangkat Daerah', ['/laporan-skpd/tvc74'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan-skpd/cetak-tvc74'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                                                <!--(Permendagri 54 Tahun 2010 lampiran v halaman 81)-->
                            </span>
                        </div>
                    </li
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Prioritas Pembangunan Daerah Perangkat Daerah', ['/laporan-skpd/tvc75'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan-skpd/cetak-tvc75'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                          <!--                      (Permendagri 54 Tahun 2010 lampiran v halaman 81)-->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Rumusan Rencana Program dan Kegiatan Perangkat Daerah', ['/laporan-skpd/tvic10'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['laporan-skpd/cetak-tvic10'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                                               <!-- (Permendagri 54 Tahun 2010 lampiran vi halaman 34)-->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kompilasi Program Dan Pagu Indikatif Perangkat Daerah', ['/laporan-pra-rka/index'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan-pra-rka/cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                <!--                                (Permendagri 54 Tahun 2010 lampiran v halaman 65) -->
                            </span>
                        </div>
                    </li>
                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kajian Usulan Program dan Kegiatan Perangkat Daerah', ['/laporan-skpd/tv1c13'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['/laporan-skpd/cetak-tv1c13'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
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
                            <?= Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-skpd/tv1c1'], ['class'=>'product-title']) ?>
                            <?= Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right']) ?>
                            <span class="product-description">
                                                                <!--(Permendagri 54 Tahun 2010 lampiran vi halaman 41) -->
                            </span>
                        </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                            <img src="images/logo.png" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <?= Html::a('Kajian Usulan Program dan Kegiatan dari Masyarakat Tahun 2019', ['/laporan-skpd/tvic16'], ['class'=>'product-title btn_link']) ?>
                            <?php // Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title btn_link']) ?>
                            <?= Html::a('Download', ['/laporan-skpd/cetak-tvic16'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
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
                            <?= Html::a('Rincian Anggaran Belanja Langsung Menurut Program dan per Kegiatan Satuan Kerja', ['/laporan-skpd/laporan-rka'], ['class'=>'product-title btn_link']) ?>
                            <span class="product-description">
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>
<div class="row">
 <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">LAPORAN PENGGUNAAN PAGU INDIKATIF PERANGKAT DAERAH</h3>
                <span class="label label-success pull-right"><i class="fa fa-book"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                   <li>
                    <table class="table table-bordered">
                    <tr>
                        <td style="font-size:12px;"><b>Penggunaan Pagu Untuk Kegiatan</b></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="vcenter text-center">Program</td>
                        <td class="vcenter text-center">Kegiatan</td>
                        <td class="vcenter text-center">Pagu Indikatif</td>
                    </tr>
                    <?php 
                        foreach ($dataKegiatan as $data): 
                        if ($data->getKegiatans()->count()<=0) {
                            continue;
                        }
                    ?>

                    <tr>
                        <td style="font-size:12px;" > <?= $data->refProgram['Ket_Program'] ?></td>
                        <td></td>
                        <td style="font-size:12px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                    </tr>


                    <?php $dataProgKeg = $data->kegiatans;
                          foreach ($dataProgKeg as $dataProgKegs) :
                     ?>

                    <tr>
                        <td></td>
                        <td style="font-size:12px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
                        <td style="font-size:12px;" align="right" > <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                    </tr>

                    <?php endforeach;?>
                    <?php endforeach;?>

                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                    </tr>
                    </table>
                    </li>        
                </ul>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div>
