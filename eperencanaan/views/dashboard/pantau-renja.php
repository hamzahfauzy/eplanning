<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use emusrenbang\models\TaBelanjaRincSub;
use common\models\TaKegiatanRancanganAwal;
use common\models\TaKegiatan;
setlocale(LC_ALL, 'INDONESIA');
include"header.php";


?>
					
			
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
							
                                <h3>PANTAUAN KEGIATAN RENJA PERANGKAT DAERAH</h3>
                            </div>
							<!--
							<form>
							
									
								
								 <div class="col-md-3">
								 <div class="form-group">
								 <b>Kecamatan:</b>
								<select  class="form-control" id="status" name="status_keg">
									<option value="0">Semua</option>
									<option value="1">Sudah Entri</option>
									<option value="2">Belum Entri</option>
								</select>
								
								</div></div>
								</form>
							
							-->
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center" rowspan=2>No</th>
										<th style="text-align:center" rowspan=2>ORGANISASI PERANGKAT DAERAH (OPD)</th>
										<th style="text-align:center"colspan=2>RANWAL</th>
										
										<th style="text-align:center"colspan=2>RANCANGAN</th>
										</tr>
										<tr>
										<th style="text-align:center">Kegiatan</th>
										<th style="text-align:center">Pagu Kegiatan</th>
										
										<th style="text-align:center">Rincian</th>
										<th style="text-align:center">Pagu Kegiatan</th>
										</tr>
									
								</thead>
								</thead>
								<tbody>
								<?php 
									
								
								
								$no=1;$xJum=0;$yJum=0;$xxTotal=0;$xxTotal1=0;$xJum1=0;$yJum1=0;$xxJum=0;$xxJum1=0;
								foreach($data1 as $rows):
								 $cUnit=@$opd($rows['Kd_Urusan'],$rows['Kd_Bidang'],$rows['Kd_Unit'],$rows['Kd_Sub']);
								 $UU1=$rows['Kd_Urusan'];$UU2=$rows['Kd_Bidang'];$UU3=$rows['Kd_Unit'];$UU4=$rows['Kd_Sub']; 
									$data2=TaBelanjaRincSub::find()
										->where(['Kd_Urusan'=>$UU1])
										->andwhere(['Kd_Bidang'=>$UU2]) 
										->andwhere(['Kd_Unit'=>$UU3])
										->andwhere(['Kd_Sub'=>$UU4])
										->all();
										$cJum1=0;$xPagu1=0;
									foreach($data2 as $rows1):
										if ($UU1==$rows1['Kd_Urusan'] && $UU2==$rows1['Kd_Bidang'] && $UU3==$rows1['Kd_Unit']&& $UU4==$rows1['Kd_Sub']) 
											{
												  $cJum1=$cJum1+1; 
												  $xPagu1=$xPagu1+$rows1['Total'];
											}
									endforeach;
								?>
									
									<tr>
									<?php
										$nox=1;$cJum=0;$xPagu=0;
										$xData=TaKegiatanRancanganAwal::find()
											   ->where(['Kd_Urusan'=>$UU1])
												->andwhere(['Kd_Bidang'=>$UU2]) 
												->andwhere(['Kd_Unit'=>$UU3])
												->andwhere(['Kd_Sub'=>$UU4])
											   ->count();
										if ($xData<=0) {
											$cData=TaKegiatan ::find()
													->all();
										}
										else
										{
											$cData=TaKegiatanRancanganAwal::find()
													->all();
										}
										foreach($cData as $rows):
										?>
											<?php if ($UU1==$rows['Kd_Urusan'] && $UU2==$rows['Kd_Bidang'] && $UU3==$rows['Kd_Unit']&& $UU4==$rows['Kd_Sub']) 
											{
												  $cJum=$cJum+1; 
												  $xPagu=$xPagu+$rows['Pagu_Anggaran'];
											}
												  
											?>
												  
										<?php $nox++; endforeach; ?>
											<td><?=$no;?></td>
											
											<?php if ($cJum==0) { ?>
												<td>
												<font style="color: red"> <?=$cUnit;?>  </font></td>
											<?php }
											else
											{ ?>
										<td><?=$cUnit;?>  </td>
										<?php
											}
											
											?>
											
											<td align="right">
											
												<a href="index.php?r=dashboard%2Flaporan-renja1&urusan=<?php echo $UU1;?>&bidang=<?=$UU2;?>&unit=<?=$UU3?>&sub=<?=$UU4?>"><button class="btn btn-success">
												<?=number_format($cJum);?></button> </a>
											
											</td> 
											
											<td align="right"><?=number_format($xPagu);?></td> 
											<?php if ($cJum1<=0) { ?>
											
												<td align="right" style="color:red" >
												
												<a href="index.php?r=dashboard%2Flaporan-renja1&urusan=<?php echo $UU1;?>&bidang=<?=$UU2;?>&unit=<?=$UU3?>&sub=<?=$UU4?>"><button class="btn btn-danger">
												<?=number_format($cJum1);?></button> </a>
												</td> 
												<td align="right" style="color:red" ><?=number_format($xPagu1);?></td> 
												
											<?php } else { ?>
												<td align="right">
												<a href="index.php?r=dashboard%2Flaporan-renja1&urusan=<?php echo $UU1;?>&bidang=<?=$UU2;?>&unit=<?=$UU3?>&sub=<?=$UU4?>"><button class="btn btn-success" >
												<?=number_format($cJum1);?></button> </a>
												
												</td> 
												<td align="right"><?=number_format($xPagu1);?></td>  
											<?php } ?>
											<?php $xxJum=$xxJum+$cJum;?>
											<?php $xxJum1=$xxJum1+$cJum1;?>
											<?php $xxTotal=$xxTotal+$xPagu;?>
											<?php $xxTotal1=$xxTotal1+$xPagu1;?>

									</tr>
										<?php if ($cJum1==0) 
											{
												$xJum1=$xJum1+1;
											}
											else
											{
												$yJum1=$yJum1+1;
											}
											?>
											<?php if ($cJum==0) 
											{
												$xJum=$xJum+1;
											}
											else
											{
												$yJum=$yJum+1;
											}
											?>
											
								<?php $no++; endforeach; ?>
								<td align="center"colspan=2><b>TOTAL</b></td>
								
								<td align="right"><b><?=number_format($xxJum);?></b></td>
								<td align="right"><b><?=number_format($xxTotal);?></b></td>
								<td align="right"><b><?=number_format($xxJum1);?></b></td> 
								<td align="right"><b><?=number_format($xxTotal1);?></b></td> 
								</b>
								</tbody>
							</table>
							
							
                        </div>
                    </div>
                </div>
				1. Jumlah OPD Yang Belum Entri Renja : <b><?= $xJum; ?> </b>| 	Jumlah OPD Yang Sudah Entri Renja : <b><?= $yJum; ?> </b>
				<br>
				2. Jumlah OPD Yang Belum Entri Rincian Renja : <b><?= $xJum1; ?></b> | 	Jumlah OPD Yang Sudah Entri Rincian Renja : <b><?= $yJum1; ?> </b>
<?php
Modal::begin([
    'header' => '<h4>Lihat File</h4>',
    "size"=>"modal-default",
    'footer' => Html::button('Tutup',['class'=>'btn btn-primary pull-left','data-dismiss'=>"modal"]),
    "id"=>"lihatFileModal",
]);
echo "<div id='isi_modal'></div>";
Modal::end();
?>