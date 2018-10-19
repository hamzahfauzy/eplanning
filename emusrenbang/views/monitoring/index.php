<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile(
        '@web/css/style_explorer.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/bappeda_explorer.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="row">
  <div class="col-md-2">
    <div class="ruang-data ruang1">
      <h3>SKPD</h3>
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
                <?= substr($value->Nm_Sub_Unit, 0, 13); ?>
                (<?= $value->getTaPrograms()->count() ?>)
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
      <h3>PROGRAM</h3>
      <table class="daftar-data" id="program-wrap">
        <!-- diisi oleh ajax -->
      </table>
    </div>
  </div>
  <div class="col-md-2">
    <div class="ruang-data ruang1">
      <h3>KEGIATAN</h3>
      <table class="daftar-data" id="kegiatan-wrap">
        <tr class="dat-col">
          <td>a</td>
        </tr>
        <tr class="dat-col">
          <td>a</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="col-md-2">
    <div class="ruang-data ruang1">
      <h3>RINCIAN</h3>
      <table class="daftar-data" id="rincian-wrap">
        <tr class="dat-col">
          <td>a</td>
        </tr>
        <tr class="dat-col">
          <td>a</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="col-md-2">
    <div class="ruang-data ruang1">
      <h3>RINCIAN SUB</h3>
      <table class="daftar-data">
        <tr class="dat-col">
          <td>a</td>
        </tr>
        <tr class="dat-col">
          <td>a</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="col-md-2">
    <div class="ruang-data ruang1">
      <h3>RINCIAN OBYEK</h3>
      <table class="daftar-data">
        <tr class="dat-col">
          <td>a</td>
        </tr>
        <tr class="dat-col">
          <td>a</td>
        </tr>
      </table>
    </div>
  </div>
</div>

