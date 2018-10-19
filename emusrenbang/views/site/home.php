<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerJsFile(
    '@web/js/laporan_bappeda.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

/* @var $this yii\web\View */

$this->title = 'Rencana Kerja Pemerintah Daerah Kabupaten Asahan ';
?>
      <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">

            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        PRIORITAS DAN SASARAN PEMBANGUNAN DAERAH
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                          <li class="item">
                              <div class="product-img">
                                  <img src="images/logo.png" alt="Product Image">
                              </div>
                              <div class="product-info">
                                  <?= Html::a('Pemerintah Daerah', ['/ta-pemda/index'], ['target' => '_blank', 'class' => 'product-title']) ?>
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
                                  <?= Html::a('Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan Daerah', ['/rpjmd/tvc74'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc74-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <span class="product-description">
                                     <!-- (Permendagri 54 Tahun 2010 lampiran v halaman 81) -->
                                  </span>
                              </div>
                          </li>
                          <li class="item">
                              <div class="product-img">
                                  <img src="images/logo.png" alt="">
                              </div>
                              <div class="product-info">
                                  <?= Html::a('Prioritas Pembangunan Daerah', ['/rpjmd/tvc75'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc75-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <span class="product-description">
                                    <!--  (Permendagri 54 Tahun 2010 lampiran v halaman 81) -->
                                  </span>
                              </div>
                          </li>
                          <li class="item">
                              <div class="product-img">
                                  <img src="images/logo.png" alt="Product Image">
                              </div>
                              <div class="product-info">
                                  <?= Html::a('Penjelasan Program Pembangunan Daerah', ['/rpjmd/tvc76'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/rpjmd/tvc76-cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <span class="product-description">
                                     <!-- (Permendagri 54 Tahun 2010 lampiran v halaman 82) -->
                                  </span>
                              </div>
                          </li>
                          
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <?= strtoupper('Penyelarasan Rencana Program Prioritas beserta pagu Indikatif'); ?>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                          
                          <li class="item">
                              <div class="product-img">
                                  <img src="images/logo.png" alt="Product Image">
                              </div>
                              <div class="product-info">
                                  <?= Html::a('Prioritas dan Sasaran Pembangunan Daerah', ['rpjmd/tvc63'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <a href="">
                                      <span class="label label-warning pull-right">Download</span>
                                  </a>
                                  <span class="product-description">
                                     <!-- (Permendagri 54 Tahun 2010 lampiran v halaman 64) -->
                                  </span>
                              </div>
                          </li>

                          <li class="item">
                              <div class="product-img">
                                  <img src="images/logo.png" alt="Product Image">
                              </div>
                              <div class="product-info">
                                  <?= Html::a('Penetapan Proporsi Alokasi Dana Pagu Indikatif', ['rpjmd/tvc64'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <a href="">
                                      <span class="label label-warning pull-right">Download</span>
                                  </a>
                                  <span class="product-description">
                                     <!-- (Permendagri 54 Tahun 2010 lampiran v halaman 64) -->
                                  </span>
                              </div>
                          </li>

                          <li class="item">
                              <div class="product-img">
                                  <img src="images/logo.png" alt="Product Image">
                              </div>
                              <div class="product-info">
                                  <?= Html::a('Kompilasi Program Dan Pagu Indikatif Tiap Perangkat Daerah', ['/laporan-pra-rka/index'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <?= Html::a('<span class="label label-warning pull-right">Download</span>', ['/laporan-pra-rka/cetak'], ['target' => '_blank', 'class' => 'product-title']) ?>
                                  <span class="product-description">
                                  <!--    (Permendagri 54 Tahun 2010 lampiran v halaman 65) -->
                                  </span>
                              </div>
                          </li>
                      <!-- /.item -->
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        ORGANISASI PERANGKAT DAERAH
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                      <select class="form-control" id="pilih-opd">
                        <option value="0">-pilih opd-</option>
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
                                  <?= Html::a('Program dan Kegiatan Prioritas Perangkat Daerah', ['laporan-bappeda/progkeg-prioritas'], ['target' => '_blank', 'class'=>'product-title btn_link ']) ?>
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
                                  <span class="product-description">
                                    <!--  (Permendagri 54 Tahun 2010 lampiran v halaman 81) -->
                                  </span>
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
                                  <span class="product-description">
                                     <!-- (Permendagri 54 Tahun 2010 lampiran v halaman 81) -->
                                  </span>
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
                                  <span class="product-description">
                                   <!--   (Permendagri 54 Tahun 2010 lampiran vi halaman 34) -->
                                  </span>
                              </div>
                          </li>
                          <li class="item">
                              <div class="product-img">
                                  <img src="images/logo.png" alt="Product Image">
                              </div>
                              <div class="product-info">
                                  <?= Html::a('Kompilasi Program Dan Pagu Indikatif Perangkat Daerah', ['/laporan-bappeda/tvc66'], ['class'=>'product-title btn_link']) ?>
                                  <?php // Html::a('Kompilasi Program Dan Pagu Indikatif Perangkat Daerah', ['/laporan-pra-rka/index'], ['class'=>'product-title btn_link']) ?>
                                  <?= Html::a('Download', ['/laporan-bappeda/cetak-kompilasi-program'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                                  <?php // Html::a('Download', ['/laporan-pra-rka/cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                                  <span class="product-description">
                                    <!--  (Permendagri 54 Tahun 2010 lampiran v halaman 65) -->
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
                                   <!--   (Permendagri 54 Tahun 2010 lampiran vi halaman 37) -->
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
                                  <!--    (Permendagri 54 Tahun 2010 lampiran vi halaman 41) -->
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
                                  <?= Html::a('Kajian Usulan Program dan Kegiatan dari Masyarakat Tahun 2018', ['/laporan-bappeda/tvic16'], ['class'=>'product-title btn_link']) ?>
                                  <?php // Html::a('Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja Perangkat Daerah', ['/laporan-rkpd/tv1c1'], ['class'=>'product-title btn_link']) ?>
                                  <?= Html::a('Download', ['/laporan-bappeda/cetak-verifikasi-renja'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                                  <?php // Html::a('Download', ['laporan-rkpd/tv1c1-cetak'], ['target' => '_blank', 'class'=>'label label-warning pull-right btn_link']) ?>
                                  <span class="product-description">
                                  </span>
                              </div>
                          </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6">
          <div class="box box-solid">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Carousel</h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="5" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="6" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="images/slides/religius.jpg">
                    <div class="carousel-caption">
                      <h3>Asahan Religius</h3>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/slides/sehat.jpg">
                    <div class="carousel-caption">
                      <h3>Asahan Sehat</h3>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/slides/cerdas.jpg">
                    <div class="carousel-caption">
                      <h3>Asahan Cerdas</h3>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/slides/infra1.jpg">
                    <div class="carousel-caption">
                      <h3>Asahan Mandiri</h3>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/slides/infra2.jpg">
                    <div class="carousel-caption">
                      <h3>Asahan Mandiri</h3>
                    </div>
                  </div>
<!--
                  <div class="item">
                    <img src="images/slides/031.jpg">
                    <div class="carousel-caption">
                      <h3>Asahan Mandiri</h3>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/slides/56.jpg">
                    <div class="carousel-caption">
                      <h3>Asahan Mandiri</h3>
                    </div>
                  </div>
-->
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="well">
            <p>RKPD adalah Rencana Kerja Pembangunan Daerah, yaitu dokumen perencanaan daerah untuk  periode 1 tahun. RKPD disusun UNTUK MENJAMIN keterkaitan dan konsistensi antara:
	    <br> 1. perencanaan,  <br>2. penganggaran, <br>3. pelaksanaan, dan <br>4. pengawasan. </p><p>RKPD ditetapkan dengan Peraturan Kepala Daerah. RKPD harus menjadi dasar penyusunan KUA dan PPAS serta LKPj, LPPD, dan ILPPD.</p>

            <p>RKPD memuat: <br>1). Rancangan kerangka ekonomi daerah, <br>2). Program prioritas pembangunan daerah, dan <br>3). Rencana kerja yang terukur, pendanaan dan prakiraan maju. <br>Penetapan program prioritas berorientasi pada: pemenuhan hak-hak dasar masyarakat dan pencapaian keadilan yang berkesinambungan dan berkelanjutan.</p>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- END ACCORDION & CAROUSEL-->