<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row">
	<div class="col-sm-6">
      <div class="box box-danger">
          <div class="box-header with-border">
              <h3 class="box-title">Verifikasi Renja OPD</h3>
              <span class="label label-danger pull-right"><i class="fa fa-book"></i></span>
          </div><!-- /.box-header -->
          <div class="box-body">
          	<?php $form = ActiveForm::begin(['action' =>["monitoring/kegiatan-verifikasi"], 'method' => 'get']); ?>
	            <select class="form-control" id="pilih-skpd" name='key'>
	              <!-- <option value="0">-pilih OPD-</option> -->
	              <?php
	                foreach ($RefSubUnit as $key => $value):
	                	$key = $value->Kd_Urusan."|".$value->Kd_Bidang."|".$value->Kd_Unit."|".$value->Kd_Sub;
	                ?>
	                  <option value="<?= $key ?>"><?= $value->Nm_Sub_Unit ?></option>
	                <?php
	                endforeach;
	              ?>
	            </select>
	            <?php echo Html::submitButton('Verifikasi' , ['class' => 'btn btn-success' ]) ?>
            <?php ActiveForm::end(); ?>
          </div>
      </div>
  </div>
</div>