<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Identifikasi Kebijakan Nasional ";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <div class="control-wrap">
          <?php $form = \yii\bootstrap\ActiveForm::begin([
                      'id' => 'search-usulan',
                      'action' => ['laporan-rkpd/cetak-tvic11-hal36'], 
                      'options' => ['target' => '_blank']
          ]) ?>
          <div class="form-group">
              <div class="col-sm-2">
                  <br>
                  <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>
              </div>
          </div>
          <?php \yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
    <div class="box-header with-border">
      <div class="col-md-1"></div><div class="col-md-10"  style="text-align:center;"><h3>Identifikasi Kebijakan Nasional <br> Provinsi .............</h3></div><div class="col-md-1"></div>
      <br>
      <div class="col-xs-12">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
                <th style="text-align:center;vertical-align:middle;">No.</th>
                <th style="text-align:center;vertical-align:middle;">Kebijakan Nasional</th>
                <th style="text-align:center;vertical-align:middle;">Sumber</th>
                <th style="text-align:center;vertical-align:middle;">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php for($i=1;$i<=4;$i++): ?>
              <td style="text-align:center;">(<?= $i ?>)</td>
              <?php endfor; ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
