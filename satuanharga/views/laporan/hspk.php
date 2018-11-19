<?php
/* @var $this yii\web\View */

$this->title = "Chart Akun HSPK";
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="box box-warning">
  <div class="box-header">
      <div class="row">
          <div class="col-md-12 text-center">
              <h1>HARGA SATUAN POKOK KEGIATAN</h1>
              <h2>(HSPK)</h2>
          </div>
      </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <?php $form = ActiveForm::begin([
          'action'  => 'index.php?r=laporan/cetak-hspk',
          'options' => ['target' => '_blank']
          ])
      ?>
      <div class="row">
        <div class="col-md-6 form-group">
          <select class="form-control" name="pilih_kode">
              <?php foreach ($dataHspks as $dataHspk): ?>
                  <option value="<?= $dataHspk['Kd_Hspk1']; ?>"><?= $dataHspk['Kd_Hspk1']; ?> . <?= $dataHspk['Nm_Hspk1']; ?></option>
              <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6 form-group">
          <?= Html::submitButton('Cetak',['class' => 'btn btn-primary']); ?>
          <!-- <?= Html::submitButton('Cetak Rincian',['class' => 'btn btn-success']); ?> -->
        </div>
      </div>
      <?php 
      ActiveForm::end(); 
    ?>
  </div><!-- /.box-body -->
</div><!-- /.box -->
