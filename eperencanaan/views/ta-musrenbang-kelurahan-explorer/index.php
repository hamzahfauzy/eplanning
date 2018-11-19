<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile(
        '@web/css/style_explorer.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/script_explorer.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="row">
    <div class="col-md-2">
        <div class="ruang-data ruang1">
            <h3>Lingkungan</h3>
            <table class="daftar-data kec-wrap">
                <?php
                $no = 0;
                foreach ($dataKec->getLingkungans()->all() as $key => $value) {
                    $no++;
                    $Kd_Prov = $value['Kd_Prov'];
                    $Kd_Kab = $value['Kd_Kab'];
                    $Kd_Kec = $value['Kd_Kec'];
                    $Kd_Kel = $value['Kd_Kel'];
                    $Kd_Urut = $value['Kd_Urut_Kel'];
                    $Kd_Ling = $value['Kd_Lingkungan'];
                    $Nm_Kec = $value['Nm_Lingkungan'];
                    $usulan = $value->getUsulans()->count();

                    echo "<tr class='kec-col'>
											<td>$no</td>
											<td data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' class='data-kec'>$Nm_Kec</td>
											<td>($usulan)</td>
											<td><a href='#' title='detail' data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' data-kel='$Kd_Kel' data-urut='$Kd_Urut' data-ling='$Kd_Ling' class='detail_kecamatan'><i class='glyphicon glyphicon-eye-open'></i></a></td>
									</tr>";
                }   
                ?>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="ruang-data ruang1">
            <h3>Usulan Belum Terverifikasi</h3>
            <table class="daftar-data" id="list-kel"></table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="ruang-data ruang1">
            <h3>Usulan Terverifikasi</h3>
            <table class="daftar-data" id="list-ling"></table>
        </div>
    </div>

    <div class="col-md-2">
        <div class="ruang-data ruang2">
            <h3>Data Penanggung Jawab</h3>
            <table class="daftar-data" id="list-pj"></table>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <div class="ruang-data ruang1">
            <h3>Usulan Kelurahan</h3>
            <table class="daftar-data kec-wrap">
                <?php
                $no = 0;
                foreach ($dataUsulanKelurahan as $key => $value) {
                    $no++;
                    $Kd_Ta = $value['Kd_Ta_Musrenbang_Kelurahan'];
                    
                    $Nm_Usulan = $value['Nm_Permasalahan'];
                    $usulan = $value->getKdTaMusrenbangKelurahanVerifikasis()->count();

                    echo "<tr class='kec-col'>
											<td>$no</td>
											<td  class='data-kec'>$Nm_Usulan</td>
											<td>($usulan)</td>
											<td><button  title='detail' data-kd='$Kd_Ta' class='detail_usulan'><i class='glyphicon glyphicon-eye-open'></i></button></td>
									</tr>";
                }   
                ?>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="ruang-data ruang1">
            <h3>Kompilasi Usulan</h3>
            <table class="daftar-data" id="list-usulan"></table>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Hapus Lingkungan</h4>
            </div>
            <div class="modal-body">
                <h3>Apakah anda yakin ingin menghapus Lingkungan</h3>
                <p>*) Lingkungan yang dihapus akan menghapus usulan</p>
                <form id="form_lingkungan_hapus">
                    <input type="hidden" id="form_prov" name="prov" class="form-control" >
                    <input type="hidden" id="form_kab" name="kab" class="form-control" >
                    <input type="hidden" id="form_kec" name="kec" class="form-control" >
                    <input type="hidden" id="form_kel" name="kel" class="form-control" >
                    <input type="hidden" id="form_urut" name="urutkel" class="form-control" >
                    <input type="hidden" id="form_lingkungan" name="lingkungan" class="form-control" >
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_hapus_lingkungan">Hapus</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_detail_kecamatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>