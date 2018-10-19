<?php

use yii\helpers\Html;
use yii\grid\GridView;
use emusrenbang\models\Referensi;
use common\components\Helper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$this->title = 'Kirim Ke APBN';
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
    <p>Apakah Anda yakin untuk mengirimkan data ke APBN?</p>
    <a id="tbl_link" class="btn btn-primary" href="http://eplanning.sumutprov.go.id/emusrenbang/web/index.php?r=load-kota&Tahun=2017&Kd_Prov=12&Kd_Kab=71&url=http://dev.pemkomedan.go.id/emusrenbang/web/index.php?r=pra-rka-apbn/kirim-data">
      Kirim
    </a>

    <div id="twitterFeed"></div>
  </div>
</div>
