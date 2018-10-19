<?php

use yii\helpers\Html;
use emusrenbang\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\TaKegiatan;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$ref=new Referensi;


// $this->title = "Laporan RKPD Tahun ".($tahun);
$this->title = "Kompilasi Program Dan Pagu Indikatif Tiap OPD " .($tahun);
$this->params['breadcrumbs'][] = "Laporan";
$this->params['breadcrumbs'][] = $this->title;

// $level = Yii::$app->user->level;
// $namalengkap='';
// if($level != "admin"){
//     $namalengkap=Yii::$app->user->identity->nama_lengkap;
// }


$js="Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
//UIExtendedModals.init('index.php?r=ajax/modaltest&id=test');
TableAdvanced.init();

";
$this->registerJs($js, 4, 'My');

?>
<div>
    <div class="portlet-body form">
        <?php $form = ActiveForm::begin(); ?>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <div class="form-group">
                            <label>Program</label>
                            <div>
                                <input type="text" class="form-control" placeholder="Program">
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
      
        <?php ActiveForm::end(); ?>
    </div>
    <div class="clearfix"></div>
    <br>
    <style type="text/css">
        .tanda{
            background: #578ebe !important;
            color: #fff !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <!-- <div class="caption">
                        <i class="fa fa-globe"></i>Datatable with TableTools
                    </div> -->
                    <div class="tools">
                    </div>
                    <div class="control-wrap">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <br>
                                <?= Html::a('Cetak', ['/laporan-bappeda/cetak-tvc66', 'urusan'=>$subunit->Kd_Urusan, 'bidang'=>$subunit->Kd_Bidang, 'unit'=>$subunit->Kd_Unit, 'sub'=>$subunit->Kd_Sub], ['class'=>'btn btn-bg btn-primary', 'target'=>'_blank']) ?>

                            </div>
                        </div>
                     
                    </div>   
                </div>
                <div class="portlet-body">
                        <table class="table table-striped table-bordered" id="sample_1">
                        <caption class="headerFox text-center">
                            <h3>Rumusan Rencana Program dan Kegiatan <?= $subunit->namaSub->Nm_Sub_Unit ?> </h2>
                        </caption>
                        <thead>
                                <tr>
                                 <th rowspan="2" class="vcenter text-center"> No. </th>
                                <th rowspan="2" class="vcenter text-center"> OPD </th>
                                <th rowspan="2" class="vcenter text-center">
                                    Program
                                </th>
                                <th colspan="2" class="vcenter text-center">Kinerja </th>
                                <th rowspan="2" class="vcenter text-center">Pagu Indikatif</th>
                               
                                
                            </tr>
                            <tr>
                                <th class="vcenter text-center">Indikator</th>
                                <th class="vcenter text-center">Target</th>
                                
                            </tr>

                            <tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
                                <th class="text-center">(4)</th>
                                <th class="text-center">(5)</th>
                                <th class="text-center">(6)</th>
                        </thead>
                        <tbody>                      
                        
                        <?php
                        $no = 1; 
                        foreach ($dataKegiatan as $data): 
                        ?>

                        <tr>
                            <td> <?= $no++ ?></td>
                            <td style="font-size:11px;"> <?= $data->refSubUnit['Nm_Sub_Unit'] ?> </td>
                            <td style="font-size:11px;" > <?= $data->refProgram['Ket_Program'] ?></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

