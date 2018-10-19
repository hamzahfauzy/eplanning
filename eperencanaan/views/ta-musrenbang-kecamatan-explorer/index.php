<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile(
        '@web/css/style_explorer.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/kecamatan_explorer.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="row">
    <div class="col-md-2">
        <div class="ruang-data ruang1">
            <h3>Kelurahan</h3>
            <table class="daftar-data kec-wrap">
                <?php
                    foreach ($data as $value) :
                        $kel    = $value->Kd_Kel;
                        $urut   = $value->Kd_Urut;
                        // $usulan1 = $value->getTaMusrenbangKelurahans()->count();
                        // $usulan2 = $value->getTaMusrenbangKelurahanVerifikasis()->count();
                        // $usulan = $usulan1+$usulan2;
                        ?>
                        <tr class="kel-col">
                            <td class="kel" data-kel="<?= $kel ?>" data-urut="<?= $urut ?>">
                              <?= $value->Nm_Kel ?>
                            </td>
                            <td class="pull-right"><?php echo "&nbsp&nbsp&nbsp&nbsp"; ?>
                              <?php //$usulan ?>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                ?>
            </table>
        </div>
    </div>
    <div class="col-md-2">
        <div class="ruang-data ruang1">
            <h3>Lingkungan</h3>
            <table class="daftar-data" id="list-lingkungan">
                
            </table>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ruang-data ruang1">
            <h3>Usulan Lingkungan</h3>
            <table class="daftar-data" id="list-usulan-lingkungan">
                
            </table>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ruang-data ruang1">
            <h3>Usulan Kelurahan</h3>
            <table class="daftar-data" id="usulan-kelurahan">
                
            </table>
        </div>
    </div>

    <div class="col-md-2">
        <div class="ruang-data ruang2">
            <h3>Data Penanggung Jawab</h3>
            <table class="daftar-data" id="list-pj">
                
            </table>
        </div>
    </div>

    <div class="col-md-6">
        <div class="ruang-data">
            <h3>Penyelenggaraan Musrenbang Kelurahan</h3>
            <table class="daftar-data" id="list-kelurahan-acara" border='1' cellspacing='0'>
                
            </table>
        </div>
    </div>
</div>
<hr>



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