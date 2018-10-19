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
$this->title = "Prioritas dan Sasaran Pembangunan Daerah " .($tahun);
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
                        <?php $form = \yii\bootstrap\ActiveForm::begin([
                            'id' => 'search-usulan',
                              'action' => ['rpjmd/cetak-tvc63'], 
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
                <div class="portlet-body">
                    <table class="table" id="sample_1">
                        <caption class="headerFox text-center">
                            <h3> Prioritas dan Sasaran Pembangunan Daerah Tahun <?= $tahun ?></h3>
                        </caption>
                        <thead>

                            <tr>
                                <th> NO. </th>
                                <th class="vcenter text-center">Prioritas Pembangunan Daerah</th>
                                <th class="vcenter text-center">Sasaran Pembangunan Daerah</th>
                                <th class="vcenter text-center">Nama Program</th>
                                <th class="vcenter text-center">OPD Penanggung Jawab</th>
                            </tr>

                            <tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
                                <th class="text-center">(4)</th>
                                <th class="text-center">(5)</th>
                            </tr>
                        </thead>
                        <tbody> 

                        <?php
                        $no = 1;
                        foreach ($PrioritasPem as $Prioritas) : ?>
                       
                        <tr> 
                          <td> <?= $no++ ?> </td>
                          <td style="font-size:11px;"> <?= @$Prioritas['Prioritas_Pembangunan_Daerah'] ?> </td>
                        </tr> 

                        <?php $PrioritasProg =  $Prioritas->taRpjmdProgramPrioritas;

                        foreach ($PrioritasProg as $Program) :
                        ?>
 
                        <tr>
                          <td style="font-size:11px;"><?= @$Program->taRpjmdSasaran['Sasaran'] ?></td>
                          <td style="font-size:11px;"> <?= @$Program->refProgram['Ket_Prog'] ?> </td> 
                          <td style="font-size:11px;"> <?= @$Program->refProgram->kdBidang->refUnits->refSubUnits['Nm_Sub_Unit'] ?> </td>      
                        </tr> 

                        <?php 
                            endforeach; 
                        ?>
                        <?php 
                            endforeach; 
                        ?>    

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

