<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;



$this->title = 'Peraturan RKPD';
$this->params['breadcrumbs'][] = "Laporan";
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-md=12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Verifikasi Renja OPD</h3>
            <span class="label label-danger pull-right"><i class="fa fa-book"></i></span>
        </div><!-- /.box-header -->
        <div class="box-body">
        	<div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>OPD</label>
                <select class="form-control select2" style="width: 100%;">
                  <option value="0">Piilih</option>
                  <?php
		                foreach ($RefSubUnit as $key => $value):
		                	$key = $value->Kd_Urusan."|".$value->Kd_Bidang."|".$value->Kd_Unit."|".$value->Kd_Sub;
		                ?>
		                  <option value="<?= $key ?>"><?= $value->Nm_Sub_Unit ?></option>
		                <?php
		                endforeach;
			            ?>
                </select>
              </div>
            </div>
            <div></div>
          </div>
        </div>
    </div>
</div>
