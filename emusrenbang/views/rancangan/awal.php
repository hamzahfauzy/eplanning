<?php

use yii\helpers\Html;
use emusrenbang\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\TaKegiatan;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;

/* var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$ref=new Referensi;


// $this->title = "Laporan RKPD Tahun ".($tahun);
$this->title = "Rancangan Awal Renja Perangkat Daerah 2020 - 2021";  //.($tahun+1);
$this->params['breadcrumbs'][] = ['label' => 'Rancangan Awal', 'url' => ['rancangan/awal']];
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
                            <div class="col-sm-4">
                                <br>                              
                                <?php 
								 //Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); 
                                 
                                if($status == 0){
                                ?>
                                <a href="index.php?r=pra-rka/program"><button type="button" class="btn btn-success btn-lg">+ Tambah Data</button></a>
                                <?php } ?>
								<a href="index.php?r=laporan-skpd%2Fcetak-tvic10a" target="_blank"><button type="button" class="btn btn-warning btn-lg">Cetak</button></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <br>
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
                                <th rowspan="2" class="vcenter text-center"> Kode </th>
                                <th rowspan="2" class="vcenter text-center">
                                    Urusan/Bidang Urusan <br> Pemerintahan Daerah dan <br>Program/Kegiatan
                                </th>
                                <th rowspan="2" class="vcenter text-center">
                                    Indikator Kinerja Program / Kegiatan
                                </th>
                                <th colspan="4" class="vcenter text-center">Rencana Tahun 2020 </th>
                                <th rowspan="2" class="vcenter text-center">Catatan Penting</th>
                                <th colspan="2" class="vcenter text-center">Prakiraan Maju Rencana Tahun 2021 </th>
                                
                            </tr>
                            <tr>
                                <th class="vcenter text-center">Lokasi</th>
                                <th class="vcenter text-center">Target Capaian</th>
                                <th class="text-center">Kebutuhan Dana/ Pagu Indikatif</th>
                                <th class="vcenter text-center">Sumber Dana</th>
                                <th class="vcenter text-center">Target Capaian Kinerja</th>
                                <th class="vcenter text-center">Kebutuhan Dana/ Pagu Indikatif</th>
                            </tr>

                            <tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
                                <th class="text-center">(4)</th>
                                <th class="text-center">(5)</th>
                                <th class="text-center">(6)</th>
                                <th class="text-center">(7)</th>
                                <th class="text-center">(8)</th>
                                <th class="text-center">(9)</th>
                                <th class="text-center">(10)</th>
                            </tr>
                        </thead>
                        <tbody>                      
                        <tr>
                            <td style="font-size:11px;"> <b><?= $subunit->Kd_Urusan?></b></td>
                            <td style="font-size:11px;" ><b> <?= $subunit->urusan['Nm_Urusan'] ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:11px;"><b> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?></b></td>
                            <td style="font-size:11px;" ><b> <?= $subunit->kdBidang->Nm_Bidang ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                         <tr>
                            <td style="font-size:11px;"> <b><?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?></b></td>
                            <td style="font-size:11px;" > <b><?= $subunit->unit->Nm_Unit ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                         <tr>
                            <td style="font-size:11px;"> <b><?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?>.<?= $subunit->Kd_Sub?></b> </td>
                            <td style="font-size:11px;" > <b><?= $subunit->kdSubUnit->Nm_Sub_Unit ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"><b><span id="total"></b></span></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" ><b><span id="totalnt1"></b></span></td>
                        </tr>



                        <?php 
                        $total = 0;
                        $totalnt1 = 0;
                        foreach ($dataKegiatan as $data): 
                            if($status==0){
                                if ($data->getKegiatans()->count()<=0) {
                                    continue;
                                }
                            }else{
                                if ($data->getKegiatanrancanganawal()->count()<=0) {
                                    continue;
                                }
                            }

                        ?>

                        <tr>
                            <td style="font-size:11px;"><b> <?= $data['Kd_Urusan']?>.<?= $data['Kd_Bidang']?>.<?= $data['Kd_Unit'] ?>.<?= $data['Kd_Sub']?>.<?= $data['Kd_Prog'] ?></b> </td>
                            <td style="font-size:11px;" ><b> <?= $data->refProgram['Ket_Program'] ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<?php if($status == 0) { ?>
								<td style="font-size:12px;" align="right"> <b><?= number_format($data->getKegiatans()->sum('Pagu_Anggaran'),0, ',', '.') ?></b></td>
							<td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <b><?= number_format($data->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
							
							<?php }else { ?>
								<td style="font-size:12px;" align="right"> <b><?= number_format($data->getKegiatanrancanganawal()->sum('Pagu_Anggaran'),0, ',', '.') ?></b></td>
							
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <b><?= number_format($data->getKegiatanrancanganawal()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                            <?php } ?>

                        <?php 
                            if($status == 0)
                                $dataProgKeg = $data->kegiatans;
                            else
                                $dataProgKeg = $data->kegiatanrancanganawal;


						$tahunn = [2016=>"Pagu_Indikatif",2017=>"Tahun_Pertama",2018=>"Tahun_Kedua",2019=>"Tahun_Ketiga",2020=>"Tahun_Keempat",2021=>"Tahun_Kelima"];
						$target = [2016=>"Target0",2017=>"Target1",2018=>"Target2",2019=>"Target3",2020=>"Target4",2021=>"Target5"];
						
                        foreach ($dataProgKeg as $dataProgKegs) :
                              $pagu = $dataProgKegs->getPagu()->sum('pagu');
                              
							  if($dataProgKegs['Pagu_Anggaran'] == 0)
								   $pagu = @$dataProgKegs->refKegiatans->{$tahunn[2019]};
							  else
								  $pagu = @$dataProgKegs['Pagu_Anggaran'];
                                   
							  

							 
							  if($dataProgKegs['Pagu_Anggaran_Nt1'] == 0)
								  //print_r($dataProgKegs->refKegiatans);
								  $nt1 = @$dataProgKegs->refKegiatans[$tahunn[2020]]; //$dataProgKegs->refKegiatans->{; //dikomen oleh Ripin G || Edited By HF
							  else
								  $nt1 = @$dataProgKegs['Pagu_Anggaran_Nt1'];
                            
                            $total += $pagu;
                            $totalnt1 += $nt1;
							
                        if (isset($dataProgKegs->taIndikatorsKinerja->Tolak_Ukur))                       
							$tolakukur = @$dataProgKegs->taIndikatorsKinerja->Tolak_Ukur;
                         else 
							$tolakukur = '-';
                        
                        
                        if (isset($dataProgKegs->taIndikatorsKinerja->Target_Angka))
							$targetangka = @$dataProgKegs->taIndikatorsKinerja->Target_Angka;                                
                        else
							$targetangka = @$dataProgKegs->refKegiatans->{$target[2019]};


                         if (isset($dataProgKegs->taIndikatorsKinerja->Target_Uraian)) 
							@$targeturaian = @$dataProgKegs->taIndikatorsKinerja->Target_Uraian;                                
                        else 
							@$targeturaian = "-";
                        

                        if (isset($dataProgKegs->taIndikatorsN1->Target_Angka))
							$targetangkan1 = @$dataProgKegs->taIndikatorsN1->Target_Angka;                                
                        else
							$targetangkan1 = @$dataProgKegs->refKegiatans->{$target[2020]};

                        ?>
                        <tr> </tr>
                        <tr>
                            <td style="font-size:11px;"> <?= $dataProgKegs['Kd_Urusan']?>.<?= $dataProgKegs['Kd_Bidang']?>.<?= $dataProgKegs['Kd_Unit'] ?>.<?= $dataProgKegs['Kd_Sub']?>.<?= $dataProgKegs['Kd_Prog'] ?>.<?= $dataProgKegs['Kd_Keg']?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
                            <td style="font-size:11px;" > <?= $tolakukur ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Lokasi'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangka ?> <?= @$targeturaian ?></td>
                            <td style="font-size:11px;" align="right" > <?= number_format($pagu,0, ',', '.') ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs->sumberDana['Nm_Sumber'] ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Keterangan'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangkan1 ?> <?= @$targeturaian ?> </td>
                            <td style="font-size:11px;" align="right" > <?= number_format($nt1,0, ',', '.' )?></td>

                        </tr>    
                        <?php endforeach; ?>   
                        <?php endforeach; ?>

                        <tr>
                            <td></td>
                            <td><b>TOTAL</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                             <td style="font-size:12px;" align="right"> <b><?= number_format($total,0, ',', '.') ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" ><b> <?= number_format($totalnt1,0, ',', '.') ?> 
                                <script type="text/javascript">
                                    document.getElementById("total").innerHTML = "<?= number_format($total,0, ',', '.') ?>";
                                    document.getElementById("totalnt1").innerHTML = "<?= number_format($totalnt1,0, ',', '.') ?>";
                                </script>
								</b>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

