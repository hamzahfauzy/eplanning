<?php
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\Modal;

$this->title = 'e-Monev '.$Nm_Pemda;
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/dashboard_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>-</h3>
                <p>Belum diverifikasi</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo $modelKegiatan ?></h3>

                <p>Kegiatan Perangkat Daerah</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar-check-o"></i>
            </div>
            <a href="#" class="small-box-footer"><h1></h1></a>
        </div>
    </div>
     <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?php echo $modelTotal ?></h3>

                <p>Total Usulan Perangkat Daerah</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="#" class="small-box-footer"><h1></h1></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3 style="">Download</h3>
                <p>Panduan Pengguna</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="../panduan/panduan_skpd.pdf" class="small-box-footer">DOWNLOAD <i class="fa fa-arrow-circle-down"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">
                <h3><?php echo $modelLingkungan ?></h3>
                <p>Usulan Dusun/Lingkungan</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-text-o"></i>
            </div>
            <a href="<?php echo Url::toRoute(['ta-musrenbang/usulan-semua']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
            <div class="inner">
                <h3><?php echo $modelKelurahan ?></h3>

                <p>Usulan Desa/Kelurahan</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-code-o"></i>
            </div>
            <a href="<?php echo Url::toRoute(['ta-musrenbang/usulan-semua']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
     <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-maroon">
            <div class="inner">
                <h3><?php echo $modelKecamatan ?></h3>

                <p>Usulan Kecamatan</p>
            </div>
            <div class="icon">
                <i class="fa fa-file-archive-o"></i>
            </div>
            <a href="<?= Url::toRoute(['ta-musrenbang/usulan-semua']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
        <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-olive">
            <div class="inner">
                <h3><?php echo $modelPokir ?></h3>
                    
                <p>Pokok Pikiran</p>
            </div>
            <div class="icon">
                <i class="fa  fa-comments-o"></i>
            </div>
            <a href="<?php echo Url::toRoute(['ta-musrenbang/usulan-pokir']); ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-folder-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pagu Indikatif Perangkat Daerah</span>
                <span class="info-box-number">
                <?php 
                    if (isset($TaSubUnit->paguSubUnit->pagu)) {
                        $pagu = $TaSubUnit->paguSubUnit->pagu;
                    }
                    else {
                        $pagu = 0;
                    }
                    echo number_format($pagu,2,",","."); 
                ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-hourglass-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pemakaian Pagu Indikatif</span>
                <span class="info-box-number">
                <?php 
                    if ( $TaSubUnit->getBelanjaRincSubs()->exists() ) {
                        $pemakaian = $TaSubUnit->getBelanjaRincSubs()->sum('Total');
                    } 
                    else {
                        $pemakaian = 0;
                    }
                    echo number_format($pemakaian,2,",",".");
                ?>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-calculator"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sisa Pagu</span>
                <span class="info-box-number">
                <?php
                    $sisa_pagu      = $pagu - $pemakaian;
                    echo number_format($sisa_pagu,2,",",".");
                ?>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-body">
                <?php echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'Jumlah Usulan Berdasarkan RPJMD dan Bidang Pembangunan'],
                        'xAxis' => [
                            'categories' => ['Pembangunan Infrastruktur', 'Pendidikan', 'Kesehatan', 'Pertanian', 'Lainnya']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Usulan']
                        ],
                        'series' => [
                            ['name' => 'Infrastruktur', 'data' => $jumlahUsulan[0]],
                            ['name' => 'Kesehatan', 'data' => $jumlahUsulan[1]],
                            ['name' => 'Pendidikan', 'data' => $jumlahUsulan[2]],
			    ['name' => 'Pertanian', 'data' => $jumlahUsulan[2]],
			 ['name' => 'Lainnya', 'data' => $jumlahUsulan[2]]


                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    
</div>


<!-- <?php
// Modal::begin([
//     'header' => '<h4>Tambah Rincian</h4>',
//     "size"=>"modal-lg",
//     'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]),
//     "id"=>"modal_warning",
// ]);
// echo "<div id='tambahRincianContent' class='isi-modal'>aaaa</div>";
// Modal::end();
?>
 -->
<div class="modal fade" id="modal_peringatan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perhatian!</h4>
      </div>
      <div class="modal-body">
        <h3>
            Setiap Perangkat Daerah  <br/>
            Harus sudah menyelesaikan Penyusunan Rencana Kerja tahun 2018  <br/>
            Paling Lambat Rabu, 22 Maret 2017 Pukul 06.00 WIB
        </h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="modal_kirim" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Perhatian!</h4>
      </div>
      <div class="modal-body">
        <h3>
            Apakah Anda yakin ingin mengirim RENJA?<br/>
        </h3>
        Sertakan file pendukung RENJA berupa tandatangan kepala Perangkat Daerah terkait
        <input type="file" >

        <br/>
        *) RENJA yang dikirim merupakan kegiatan-kegiatan yang sudah diverifikasi dan diterima oleh BAPPEDA
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kirim</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->