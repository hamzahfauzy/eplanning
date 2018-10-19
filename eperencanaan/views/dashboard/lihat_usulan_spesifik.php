<?php

use yii\helpers\Html;
use kartik\widgets\Typeahead;

$this->title = 'Cetak Usulan Lingkungan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- page wrapper -->
<div class="dev-page">

    <!-- page header -->
    <div class="dev-page-header">

        <div class="dph-logo">
            <img src="img/logo.png" height="40">
            <span class="judul-logo">E-Planning Kabupaten Asahan</span>
            <a class="dev-page-sidebar-collapse">
                <div class="dev-page-sidebar-collapse-icon">
                    <span class="line-one"></span>
                    <span class="line-two"></span>
                    <span class="line-three"></span>
                </div>
            </a>
        </div>


    </div>
    <!-- ./page header -->

    <!-- page container -->
    <div class="dev-page-container">   

        <!--sidebar-->
<?php include "leftpage.php"; ?>
        
        <!-- page content -->
        <div class="dev-page-content">



            <!-- page content container -->
            <div class="container">


                <!-- page title -->
                <div class="page-title" id="tour-step-4" style="text-align: center">
                    <h1><b>E-Planning Kabupaten Asahan</b></h1>
                    <img src="img/logo_medan.png" width="150px"/>

                </div>
                <div style="text-align: center"><h3>Detail Usulan</h3></div>
                
                <!-- ./page title -->
                <hr>
                    <div class="col-sm-6">
                            <table class="table table-striped">
                                <tbody id="body-tabel">
                                    
                                    <tr><td width="200px">Permasalahan</td><td width="1px">:</td><td><b><?= $usulan->Nm_Permasalahan?></b></td></tr>
                                     <tr><td width="200px">Usulan Kegiatan</td><td width="1px">:</td><td><b><?= $usulan->Jenis_Usulan?></b></td></tr>
                                      <tr><td width="200px">Bidang Pembangunan</td><td width="1px">:</td><td><b><?= $usulan->kdPem->Bidang_Pembangunan?></b></td></tr>
                                       <tr><td width="200px">Volume Satuan</td><td>:</td><td width="1px"><b><?= ($usulan->Jumlah.' '.$usulan->kdSatuan->Uraian)?></b></td></tr>
                                       <tr><td width="200px">Prakiraan Anggaran</td><td width="1px">:</td><td><b>Rp. <?= \Yii::$app->zultanggal->ZULgetcurrency($usulan->Harga_Total)?></b></td></tr>
                                         <tr><td width="200px">Lokasi</td><td>:</td><td width="1px"><b><?= $usulan->Detail_Lokasi?></b></td></tr>
                                         
                                </tbody>
                                
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <h3>Foto : </h3>
                            <?php foreach ($foto as $data) :?>
                            <img src="data/<?= $data->kdMedia->Nm_Media?>" width="100px" height="150px"/>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>

          


            <!-- Copyright -->
            <div class="copyright">
                <div class="pull-left">
                    &copy; 2017 <strong>BAPPEDA Kabupaten Asahan</strong>. All rights reserved.
                </div>
            </div>
            <!-- ./Copyright -->
        </div>
        <!-- ./page content container -->

    </div>
</div>
</div>
