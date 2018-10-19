<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

$this->registerCssFile(
        '@web/css/style_explorer.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/verifikasi_explorer_prov.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="row">
  <div class="col-md-3">
    <div class="ruang-data ruang1">
      <h3>OPD</h3>
      <table class="daftar-data">
        <?php
          foreach ($skpd as $key => $value):
          ?>
            <tr class="dat-col">
              <td class="dat-skpd" 
                  data-key="<?= $value->Kd_Urusan."|".$value->Kd_Bidang."|".$value->Kd_Unit."|".$value->Kd_Sub ?>"
                  data-toggle="tooltip" 
                  data-placement="right" 
                  title="<?= $value->Nm_Sub_Unit ?>">
                <?= substr($value->Nm_Sub_Unit, 0, 20); ?>
                (<?= $value->getTaProgramProvs()->count() ?>)
              </td>
            </tr>
          <?php
          endforeach;
        ?>
      </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="ruang-data ruang1">
      <h3>PROGRAM</h3>
      <table class="daftar-data" id="program-wrap">
        <!-- diisi oleh ajax -->
      </table>
    </div>
  </div>
  <div class="col-md-5">
    <div class="ruang-data ruang1">
      <h3>KEGIATAN</h3>
      <table class="daftar-data" id="kegiatan-wrap">
        <!-- diisi oleh ajax -->
      </table>
    </div>
  </div>
</div>

<?php
Modal::begin([
    'header' => '<h4>Keterangan Verifikasi</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"keteranganSave"]),
    "id"=>"keteranganModal",
]);
echo "<div id='keteranganContent' class='isi-modal'></div>";
Modal::end();
?>