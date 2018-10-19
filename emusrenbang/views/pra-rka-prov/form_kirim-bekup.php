<?php

use yii\helpers\Html;
use yii\grid\GridView;
use emusrenbang\models\Referensi;
use common\components\Helper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$this->title = 'Kirim Ke Provinsi';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/sinkron.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="box box-success">
  <div class="box-header">
      <h3 class="box-title">
          <?= $this->title; ?>
      </h3>
  </div>
  <div class="box-body">
    <p>Apakah Anda yakin untuk mengirimkan data ke provinsi?</p>
    <?php //$form = ActiveForm::begin(['action' =>['pra-rka-prov/kirim-proses', 'Key' => 1,]]); ?>
    <?php $form = ActiveForm::begin(['action' =>['http://eplanning.sumutprov.go.id', 'Key' => 1,]]); ?>
      <textarea name="data_json" id="data_json" style="display: none;"><?= $data_kirim ?></textarea>
      <button type="button" class="btn btn-primary" id="tbl-kirim">Kirim</button>
    <?php ActiveForm::end(); ?>
  </div>
</div>