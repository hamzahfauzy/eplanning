<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->registerJsFile(
    '@web/js/laporan_bappeda.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Usulan Ke APBN';
$this->params['subtitle'] = 'Dokumen';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">OPD</h3>
                <span class="label label-danger pull-right"><i class="fa fa-book"></i></span>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php $form = ActiveForm::begin(['action' =>['pra-rka-apbn/hasil-rekap'],'id' => 'tambah_kamus_form', 'method' => 'get',]); ?>

                    <select class="form-control" id="pilih-skpd" name="skpd">
                   
					  
                      <?php
                        foreach ($RefSubUnit as $key => $value):
                            $Kd_Urusan = $value->Kd_Urusan;
                            $Kd_Bidang = $value->Kd_Bidang;
                            $Kd_Unit = $value->Kd_Unit;
                            $Kd_Sub = $value->Kd_Sub;

                            $val = $Kd_Urusan."|".$Kd_Bidang."|".$Kd_Unit."|".$Kd_Sub
                            ?>
                              <option value="<?= $val ?>" ><?= $value->Nm_Sub_Unit ?></option>
                            <?php
                        endforeach;
                      ?>
                    </select>
                    <input type="submit" value="Lihat" class="btn btn-primary">
                <?php ActiveForm::end(); ?>

            </div>
        </div><!-- /.box -->
    </div>
</div>