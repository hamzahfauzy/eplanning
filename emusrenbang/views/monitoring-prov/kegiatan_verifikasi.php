<?php

use yii\helpers\Html;
use emusrenbang\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\TaKegiatan;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$ref=new Referensi;


// $this->title = "Laporan RKPD Tahun ".($tahun);
$this->title = "Laporan RKPD Tahun " .($tahun);
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

$this->registerJsFile(
        '@web/js/kegiatan_verifikasi.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

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
                    </div>   
                </div>
                <div class="portlet-body">
                        <table class="table table-bordered" id="sample_1">
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
                                <th colspan="2" class="vcenter text-center">Prakiraan Maju Rencana Tahun 2019 </th>
                                <th rowspan="2">Option</th>
                            </tr>
                            <tr>
                                <th class="vcenter text-center">Lokasi</th>
                                <th class="vcenter text-center">Target Capaian</th>
                                <th class="text-right">Kebutuhan Dana/ Pagu Indikatif</th>
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
                            <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?></td>
                            <td style="font-size:11px;" > <?= $subunit->urusan['Nm_Urusan'] ?></td>
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
                            <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?></td>
                            <td style="font-size:11px;" > <?= $subunit->kdBidang->Nm_Bidang ?></td>
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
                            <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?></td>
                            <td style="font-size:11px;" > <?= $subunit->unit->Nm_Unit ?></td>
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
                            <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?>.<?= $subunit->Kd_Sub?> </td>
                            <td style="font-size:11px;" > <?= $subunit->kdSubUnit->Nm_Sub_Unit ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" > <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
                        </tr>



                        <?php 
                        foreach ($dataKegiatan as $data): 
                            if ($data->getKegiatans()->count()<=0) {
                                continue;
                            }
                        ?>

                        <tr>
                            <td style="font-size:11px;"> <?= $data['Kd_Urusan']?>.<?= $data['Kd_Bidang']?>.<?= $data['Kd_Unit'] ?>.<?= $data['Kd_Sub']?>.<?= $data['Kd_Prog'] ?> </td>
                            <td style="font-size:11px;" > <?= $data->refProgram['Ket_Program'] ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <?= number_format($data->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
                            

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
				                        

				                        if (isset($dataProgKegs->taIndikatorsN1->Target_Angka))
				                        $targetangkan1 = $dataProgKegs->taIndikatorsN1->Target_Angka;                                
				                        else
				                        $targetangkan1 = '-';


				                        if (isset($dataProgKegs->taIndikatorsN1->Target_Uraian))
                                            $targeturaiann1 = $dataProgKegs->taIndikatorsN1->Target_Uraian;
				                        else 
                                            $targeturaiann1 = '';
				                        
				                        ?>
				                        <tr> </tr>
				                        <tr>
				                            <td style="font-size:11px;"> <?= $dataProgKegs['Kd_Urusan']?>.<?= $dataProgKegs['Kd_Bidang']?>.<?= $dataProgKegs['Kd_Unit'] ?>.<?= $dataProgKegs['Kd_Sub']?>.<?= $dataProgKegs['Kd_Prog'] ?>.<?= $dataProgKegs['Kd_Keg']?></td>
				                            <td style="font-size:11px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
				                            <td style="font-size:11px;" > <?= $tolakukur ?></td>
				                            <td style="font-size:11px;" > <?= $dataProgKegs['Lokasi'] ?></td>
				                            <td style="font-size:11px;" > <?= $targetangka ?> <?= $targeturaian ?></td>
				                            <td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
				                            <td style="font-size:11px;" > <?= $dataProgKegs->sumberDana['Nm_Sumber'] ?></td>
				                            <td style="font-size:11px;" > <?= $dataProgKegs['Keterangan'] ?></td>
				                            <td style="font-size:11px;" > <?php $targetangkan1 ?> <?php $targeturaiann1 ?> </td>
				                            <td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs['Pagu_Anggaran_Nt1'],0, ',', '.' )?></td>
																		<td>
																			<?php
																				$url = Url::to(['monitoring/modal-keterangan', 
										                              'Tahun' => $dataProgKegs['Tahun'],
										                              'Kd_Urusan' => $dataProgKegs['Kd_Urusan'],
										                              'Kd_Bidang' => $dataProgKegs['Kd_Bidang'],
										                              'Kd_Unit' => $dataProgKegs['Kd_Unit'],
										                              'Kd_Sub' => $dataProgKegs['Kd_Sub'],
										                              'Kd_Prog' => $dataProgKegs['Kd_Prog'],
										                              'Kd_Keg' => $dataProgKegs['Kd_Keg'],
										                            ]);

																				if($dataProgKegs['Verifikasi_Bappeda'] != null){
																					$warna = 'btn-success';
																				}
																				else{
																					$warna = 'btn-primary';
																				}
																			?>
																			<button type="button" class="btn <?= $warna ?> btn_keterangan" value="<?= $url ?>">Verifikasi</button>
																		</td>
				                        </tr>    
                        				<?php 
                        			endforeach; 
                        			?>   
                        <?php endforeach; ?>

                        <tr>
                            <td></td>
                            <td><b>TOTAL</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                             <td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" > <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
Modal::begin([
    'header' => '<h4>Keterangan Verifikasi</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::button('Simpan',['class'=>'btn btn-primary btn-save','type'=>"button", 'id'=>"keteranganSave"]),
    "id"=>"keteranganModal",
]);
echo "<div id='keteranganContent' class='isi-modal'></div>";
Modal::end();
?>


<script type="text/javascript">


</script>