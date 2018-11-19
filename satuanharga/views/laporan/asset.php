<?php
/* @var $this yii\web\View */

$this->title = "Chart Akun Aset";
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="box box-warning">
  <div class="box-header">
      <div class="row">
          <div class="col-md-12 text-center">
              <h1>ASET</h1>
          </div>
      </div>
      <?php $form = ActiveForm::begin([
          'action'  => 'index.php?r=laporan/cetak-aset',
          'options' => ['target' => '_blank']
          ])
      ?>
      <div class="row">
            <div class="col-md-6 form-group">
              <select class="form-control" name="pilih_kode">
                  <?php foreach ($dataRekAsets as $dataRekAset): ?>
                      <option value="<?= $dataRekAset['Kd_Aset1']; ?>"><?= $dataRekAset['Kd_Aset1']; ?> . <?= $dataRekAset['Nm_Aset1']; ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6 form-group">
              <?= Html::submitButton('Cetak',['class' => 'btn btn-warning']); ?>
            </div>
      </div>
      <?php ActiveForm::end(); ?>
  </div><!-- /.box-header -->
  <div class="box-body no-padding">
  </div><!-- /.box-body -->
</div><!-- /.box -->
