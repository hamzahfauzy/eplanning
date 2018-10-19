<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

$this->registerJsFile(
        '@web/js/musrenbang/laporan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Laporan';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- <div class="alert alert-info">
    <strong>Silahkan melakukan Skoring pada usulan Desa/Kelurahan.</strong><br>
    <i>Pastikan semua usulan Desa/Kelurahan sudah diskoring untuk menentukan prioritas.</i>          
</div> -->

<div class="col-md-12">
    <div class="row">
        <div class="col-md-1">
        </div>       
    </div>
</div>

<div class="col-md-12">
  <div class="control-wrap">
    <?php
    $form = ActiveForm::begin(['id' => 'search-usulan',
                'action' => ['pokir/laporan-cetak'], 'options' => ['target' => '_blank']])
    ?>
    <div class="col-md-1">
        <div class="form-group">
            <label >&nbsp;</label>
            <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'form-control btn btn-primary']); ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
  </div>

  <div class="box-widget widget-module">
    <div class="widget-container">
      <div class=" widget-block">
        <div class="control-wrap">
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                  'Nm_Permasalahan',
                  'Jenis_Usulan',
                  'Jumlah',
                  ['class' => 'yii\grid\ActionColumn'],
              ],
          ]); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-1">
    <div class="form-group">
      <label >&nbsp;</label>
       <?= Html::a('Kirim ke SKPD', ['#'], ['class' => 'btn btn-success btn-lg', 'data-toggle' => 'modal', 'data-target' => '#modal_kirim_usulan']) ?>  
    </div>
  </div>
</div>

<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_kirim_usulan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
            </div>
            <div class="modal-body">
                <h2>Apakah anda yakin ingin mengirim usulan?</h2>
                *) Apabila Usulan telah dikirim, anda tidak dapat melakukan perubahan lagi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
<?= Html::a('Kirim', ['pokir/selesai'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
<!-- /.modal form -->