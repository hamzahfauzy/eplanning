<?php

use yii\helpers\Html;
use emonev\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\TaKegiatan;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use emonev\models\TaBelanjaRincSub;
use emonev\models\TaBelanjaRancangan;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$ref=new Referensi;


// $this->title = "Laporan RKPD Tahun ".($tahun);
$this->title = "Laporan RKPD Tahun " .($tahun);
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['laporan-skpd/sub-unit']];
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
                              'action' => ['laporan-skpd/cetak-tvic10'], 
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
                                <th colspan="4" class="vcenter text-center">Rencana Tahun <?= $tahun ?> </th>
                                <th rowspan="2" class="vcenter text-center">Catatan Penting</th>
                                <th colspan="2" class="vcenter text-center">Prakiraan Maju Rencana Tahun <?= $tahun+1 ?> </th>
                                
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
                            <td style="font-size:11px;" > <b><?= $subunit->urusan['Nm_Urusan'] ?></b></td>
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
                            <td style="font-size:11px;"> <b><?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?></b></td>
                            <td style="font-size:11px;" ><b><?= $subunit->kdBidang->Nm_Bidang ?></b></td>
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
                            <td style="font-size:11px;"><b> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?>.<?= $subunit->Kd_Sub?> </b></td>
                            <td style="font-size:11px;" > <b><?= $subunit->kdSubUnit->Nm_Sub_Unit ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<!--Perinta Lama -->
                            <td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
							<!--Perintah Baru dari get_laporan_renja by Ripin-->
							 <!--<td style="font-size:12px;" align="right"><b><span id="total"><?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></span></b></td>-->
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" > <b><?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        </tr>

<!--Perintah Baru dari get_laporan_renja by Ripin-->
						<?php 
						$pagu_total = 0;
                        foreach ($dataKegiatan as $data): 
                            if ($data->getKegiatans()->count()<=0) {
                                continue;
                            }
                            if($data->getBelanjaRincSubs()->sum('Total')==0){
                                $belanja = $data->getKegiatans()->sum('Pagu_Anggaran');
                            }else{
                                $belanja = $data->getKegiatans()->sum('Pagu_Anggaran_Nt1');
                            }
							
							
                        ?>
						
	<!--Perinta Lama -->						
                        <?php 
                       // foreach ($dataKegiatan as $data): 
                       //     if ($data->getKegiatans()->count()<=0) {
                        //        continue;
                        //    }
                        ?>

                        <tr>
                            <td style="font-size:11px;"> <b><?= $data['Kd_Urusan']?>.<?= $data['Kd_Bidang']?>.<?= $data['Kd_Unit'] ?>.<?= $data['Kd_Sub']?>.<?= $data['Kd_Prog'] ?> </b></td>
                            <td style="font-size:11px;" > <b><?= $data->refProgram['Ket_Program'] ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<!--Perintah Baru dari get_laporan_renja by Ripin-->
							<!--<td style="font-size:12px;" align="right"> <b><?= number_format($belanja,0, ',', '.') ?></b></td> -->
							<!--Perinta Lama -->
                            <td style="font-size:12px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td> 
							
                          
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"><b> <?= number_format($data->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                            

                        <?php $dataProgKeg = $data->kegiatans;


                              foreach ($dataProgKeg as $dataProgKegs) :
                         ?>

                        <?php 
                        
                        if (isset($dataProgKegs->taIndikatorsKinerja->Tolak_Ukur))                       
                        $tolakukur = $dataProgKegs->taIndikatorsKinerja->Tolak_Ukur;
                         else 
                        $tolakukur = '-';
                        
                        
                        if (isset($dataProgKegs->taIndikatorsKinerja->Target_Angka))
                        $targetangka = $dataProgKegs->taIndikatorsKinerja->Target_Angka;                                
                        else
                        $targetangka = '';


                         if (isset($dataProgKegs->taIndikatorsKinerja->Target_Uraian)) 
                        $targeturaian = $dataProgKegs->taIndikatorsKinerja->Target_Uraian;                                
                        else 
                        $targeturaian = '';
					
                        //Ditambah oleh Ripin G
						if (isset($dataProgKegs->taIndikatorsN1->Target_Uraian))
                        $targeturaiann1 = $dataProgKegs->taIndikatorsN1->Target_Uraian;                                
                        else
                        $targeturaiann1 = '-'; //batas ditambah

                        if (isset($dataProgKegs->taIndikatorsN1->Target_Angka))
                        $targetangkan1 = $dataProgKegs->taIndikatorsN1->Target_Angka;                                
                        else
                        $targetangkan1 = '-';

						//Ditambah dari get_laporan_renja : by Ripin
						 if($dataProgKegs->getBelanjaRincSubs()->sum('Total')==0){
                            $pagu = $dataProgKegs->getPagu()->sum('pagu');
                        }else{
                            $pagu = $dataProgKegs->getBelanjaRincSubs()->sum('Total');
                        }

                        $pagu_total += $pagu; //batas ditambah
						
                        ?>
                        <tr> </tr>
                        <tr>
                            <td style="font-size:11px;"> <?= $dataProgKegs['Kd_Urusan']?>.<?= $dataProgKegs['Kd_Bidang']?>.<?= $dataProgKegs['Kd_Unit'] ?>.<?= $dataProgKegs['Kd_Sub']?>.<?= $dataProgKegs['Kd_Prog'] ?>.<?= $dataProgKegs['Kd_Keg']?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
                            <td style="font-size:11px;" > <?= $tolakukur ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Lokasi'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangka ?> <?= $targeturaian ?></td>
                            <!--<td style="font-size:11px;" align="right" > <?= number_format($pagu,0, ',', '.') ?></td> //Perinta Baru -->
							<td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs->sumberDana['Nm_Sumber'] ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Keterangan'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangkan1 ?> <?= $targeturaiann1 ?> </td>
                            <td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs['Pagu_Anggaran_Nt1'],0, ',', '.' )?></td>

                        </tr>

						<tr> </tr>   
						<?php 
								$PosisiKegiatan = [
							'Kd_Urusan' =>  $dataProgKegs['Kd_Urusan'], 
							'Kd_Bidang' => $dataProgKegs['Kd_Bidang'],
							'Kd_Unit' => $dataProgKegs['Kd_Unit'],
							'Kd_Sub' => $dataProgKegs['Kd_Sub'],
							'Kd_Prog' => $dataProgKegs['Kd_Prog'],
							'Kd_Keg' => $dataProgKegs['Kd_Keg'],
							];
								$data_belanja2=TaBelanjaRancangan::find()
								->where($PosisiKegiatan)
								->andwhere(['Kd_Rek_3'=>3])
								->count();
								if ($data_belanja2>0):
									$data_belanja1=TaBelanjaRincSubRancangan::find()
									->where($PosisiKegiatan)
									->andwhere(['Kd_Rek_3'=>3])
									->all();
								else:
									$data_belanja1=TaBelanjaRincSub::find() 
									->where($PosisiKegiatan)
									->andwhere(['Kd_Rek_3'=>3])
									->all();
								endif;
									foreach ($data_belanja1 as $xxB) :


							 ?>
							
							<tr>
							<td style="font-size:11px;"></td>
                            <td style="font-size:11px;"> <i>
							<?php 
								
								
										echo $xxB['Keterangan'];
									echo "<br>";
									echo $xxB['Lokasi']; 
									
									

							 ?>
							</td>
                            <td style="font-size:11px;" > </td>
							<td style="font-size:11px;" > <i><?= $xxB['Lokasi'] ?></td>
                            <td style="font-size:11px;" > <i>
							<?php 
								
								
									echo number_format($xxB['Jml_Satuan'],0, ',', '.')." ". $xxB['Satuan123'];
									

							?>
							</td>
                            <td style="font-size:11px;" align="right" > <i>
							<?php 
								
								
									echo number_format($xxB['Total'],0, ',', '.');
									

							?>
							
							</td>
                            <td style="font-size:11px;" > </td>
                            <td style="font-size:11px;" > </td>
                            <td style="font-size:11px;" >  </td>
                            <td style="font-size:11px;" align="right" ></td>

                        </tr>    
                        <?php endforeach; ?>   
						<?php endforeach; ?>   
                        <?php endforeach; ?>

                        <tr>
                            <td></td>
                            <td><b>TOTAL</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<!-- Perintah Baru dari get_laporan_renja : by Ripin-->
							<!--<td style="font-size:12px;" align="right"> <b><?= number_format($pagu_total,0, ',', '.') ?></b></td> -->
							<!-- Perintah Lama -->
							<td style="font-size:12px;" align="right"> <b><?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td> 
							
                                
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" > <b><?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        </tr>
					<!-- Perintah Baru sama sekali dari get_laporan_renja : by Ripin-->
					<?php if($subunit->getBelanjaRincSubs()->sum('Total')==0){ ?>
                        <script type="text/javascript">
                                document.getElementById("total").innerHTML = "<?= number_format($pagu_total,0, ',', '.') ?>";
                        </script>
                        <?php } ?> <!--Batas Ditambah -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

