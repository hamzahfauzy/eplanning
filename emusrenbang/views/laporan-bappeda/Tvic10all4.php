<?php

use common\models\TaRpjmdSasaran;
use yii\helpers\Html;
use emusrenbang\models\Referensi;
use yii\widgets\ActiveForm;

use eperencanaan\models\TaMusrenbang;
//use common\models\TaProgram;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$ref=new Referensi;


// $this->title = "Laporan RKPD Tahun ".($tahun);
$this->title = "Laporan RKPD " .($tahun);
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
                               <?= Html::a('Cetak', ['/laporan-bappeda/cetak-tvic10all4'], ['class'=>'btn btn-bg btn-primary', 'target'=>'_blank']) ?>

                            </div>
                        </div>
                    </div>   
                </div>
                <div class="box-body">
                        <table class="table table-striped table-bordered" id="sample_1">
                        <caption class="headerFox text-center">
                            <h3>PROGRAM DAN KEGIATAN YANG BELUM DIAKOMODIR DALAM RANCANGAN RKPD <br>KABUPATEN ASAHAN <br> TAHUN <?= date('Y')+1 ?>
                        </caption>
                        <thead>
                    <tr>
                        <th style="vertical-align: middle;"><p class="text-center">No</p></th>
                        <th  style="vertical-align: middle;"><p class="text-center">Permasalahan</p></th>
                        <th style="vertical-align: middle;"><p class="text-center">Judul Kegiatan </p></th>
                        <th  style="vertical-align: middle;"><p class="text-center">Lokasi </p></th>
						 <th  style="vertical-align: middle;"><p class="text-center">Alasan </p></th>
                      
                    </tr>
                    
					<tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
								<th class="text-center">(4)</th>
                                
                            </tr>
                        </thead>
                        <tbody>                      

    
                        <?php
						$no=0;
						$taMus=TaMusrenbang::find()
							->Where(['or',
								['Status_Penerimaan_Skpd' => '1'],
								['Status_Penerimaan_Skpd' => '2'],
								])
							->andwhere 	(['or',
								['Status_Penerimaan_Kota' => '1'],
								['Status_Penerimaan_Kota' => '2'],
								])
							->orderBy(['Kd_Asal_Usulan' => SORT_DESC])
							->all();
                       // $subprogram = $unitsubs->taPrograms;
                        foreach ($taMus as $kegiatan) :
						$no=$no+1;
		
										
								?> 
                       
                        <tr>
                         
                         <td style="font-size:11px;"> <?= $no; ?> </td>
						<td><?php echo  $kegiatan['Nm_Permasalahan'];?></td>
						 <td><?php echo $kegiatan['Jenis_Usulan'];?></td>
							<td><?php echo $kegiatan['Detail_Lokasi'];?></td> 
							<td><?php 
								if ($kegiatan['Kd_Asal_Usulan']>=5)
								{
									echo "Pokir";
								}
								else
								{
									echo "Kecamatan";
								}
								
								;
							  
							
							?></td> 
<td><?php echo $kegiatan['Alasan_Kota'];?></td>							
						
                        <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

