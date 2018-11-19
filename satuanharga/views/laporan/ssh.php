<?php
/* @var $this yii\web\View */

$this->title = "Chart Akun SSH";
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="box box-warning">
  <div class="box-header">
      <div class="row">
          <div class="col-md-12 text-center">
              <h1>DAFTAR STANDAR SATUAN HARGA</h1>
              <h2>(SSH)</h2>
          </div>
      </div>
      <?php $form = ActiveForm::begin([
          'action'  => 'index.php?r=laporan/cetak-ssh',
          'id'      => 'pilih-kode-form',
          'options' => ['target' => '_blank']
          ])
      ?>
      <div class="row">
            <div class="col-md-6 form-group">
              <select class="form-control" name="pilih_kode">
                  <?php foreach ($dataSatus as $dataSatu): ?>
                      <option value="<?= $dataSatu['Kd_Ssh1']; ?>"><?= $dataSatu['Kd_Ssh1']; ?> . <?= $dataSatu['Nm_Ssh1']; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6 form-group">
              <?= Html::submitButton('Cetak',['class' => 'btn btn-warning', 'name' => 'cetak' ]); ?>
              <?= Html::submitButton('Cetak Tanpa Uraian',['class' => 'btn btn-info', 'name' => 'cetakosong' ]); ?>
            </div>
      </div>
      <?php ActiveForm::end(); ?>
  </div><!-- /.box-header -->
  <div class="box-body no-padding">
  </div><!-- /.box-body -->
</div><!-- /.box -->
