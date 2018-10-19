<?php
/* @var $this yii\web\View */

$this->title = "Chart Akun ASB";
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="box box-warning">
  <div class="box-header">
      <div class="row">
          <div class="col-md-12 text-center">
              <h1>ANALISA STANDART BELANJA</h1>
              <h2>(ASB)</h2>
          </div>
      </div>
      <?php $form = ActiveForm::begin([
          'action'  => 'index.php?r=laporan/cetak-asb',
          'id'      => 'pilih-kode-form',
          'options' => ['target' => '_blank']
          ])
      ?>
      <div class="row">
            <div class="col-md-6 form-group">
              <select class="form-control" name="pilih_kode">
                  <?php foreach ($dataSatus as $dataSatu): ?>
                      <option value="<?= $dataSatu['Kd_Asb1']; ?>"><?= $dataSatu['Kd_Asb1']; ?> . <?= $dataSatu['Nm_Asb1']; ?></option>
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
