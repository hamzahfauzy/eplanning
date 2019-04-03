<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use common\models\RefKecamatan;
use common\models\RefJalan;
use eperencanaan\models\TaMusrenbang;
setlocale(LC_ALL, 'INDONESIA');
include"header.php";


?>
					
								
								
			
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
							
                                <h3>PANTAUAN KEGIATAN FORUM PERANGKAT DAERAH</h3>
                            </div>
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<!--<th style="text-align:center">Kecamatan</th>-->
										<th style="text-align:center">OPD</th>
										<th style="text-align:center">Unduh Absen</th>
										<th style="text-align:center">Mulai</th>
										<th style="text-align:center">Selesai</th>
										<th style="text-align:center">Unduh BA</th>
										<th style="text-align:center">Lokasi</th>
										<th style="text-align:center">Usulan Diterima</th>
										<th style="text-align:center">Pagu (Rp.)</th>
										<th style="text-align:center">Usulan Ditolak</th>
										<th style="text-align:center">Pagu (Rp.)</th>
										<th style="text-align:center">Belum Dibahas (Kec)</th>
										<th style="text-align:center">Pagu (Rp.)</th>
										<th style="text-align:center">Belum Dibahas (Pokir)</th>
										<th style="text-align:center">Pagu (Rp.)</th>
										
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;$jum_usulan=0;$jum_pagu=0;$jum_usulan1=0;$jum_pagu1=0;$jum_usulan2=0;$jum_pagu2=0;$jum_usulan3=0;$jum_pagu3=0;
								foreach($data as $rows): 
									 
								?>
									<tr>
										<td align='right'><?=$no;?></td>
										<!--<td>
										<?php //echo $data_opd($rows['Kd_Urusan'],$rows['Kd_Bidang'],$rows['Kd_Unit'],$rows['Kd_Sub_Unit']);?>
										</td> -->
										
										<td>
										 <?=$opd1($rows['Kd_Urusan'],$rows['Kd_Bidang'],$rows['Kd_Unit'],$rows['Kd_Sub_Unit']);?>

										</td>
										<td align="center">
										<?php if ($rows['Waktu_Unduh_Absen']==0) {
											echo "<font color='red'> Belum Diunduh </font>";
										} else
										{
										echo(Yii::$app->zultanggal->ZULgethari(date('N', $rows['Waktu_Unduh_Absen']))).', ';
										echo "<br>";
										 echo(date('j',$rows['Waktu_Unduh_Absen']))." ";
										 echo (Yii::$app->zultanggal->ZULgetbulan(date('n', $rows['Waktu_Unduh_Absen'])))." "; 
										 echo (date('Y', $rows['Waktu_Unduh_Absen']))." "; 
										 echo "<br>";
										echo date('H.i', $rows['Waktu_Unduh_Absen']);
										}
										?>
										</td>
										
										<td align="center">
										<?php if ($rows['Waktu_Mulai']==0) {
											echo "<font color='red'> Belum Mulai </font>";
										} else
										{
										echo(Yii::$app->zultanggal->ZULgethari(date('N', $rows['Waktu_Mulai']))).', ';  echo "<br>";
										 echo(date('j',$rows['Waktu_Mulai']))." ";
										 echo (Yii::$app->zultanggal->ZULgetbulan(date('n', $rows['Waktu_Mulai'])))." "; 
										 echo (date('Y', $rows['Waktu_Mulai']))." "; echo "<br>";
										echo date('H.i', $rows['Waktu_Mulai']);
										}
										?>
										
										</td>
										<td align="center">
										
										
										
										<?php if ($rows['Waktu_Selesai']==0) {
											echo "<font color='red'> [Belum Kirim] </font>";
										} else
										{
										echo(Yii::$app->zultanggal->ZULgethari(date('N', $rows['Waktu_Selesai']))).', ';  echo "<br>";
										 echo(date('j',$rows['Waktu_Selesai']))." ";
										 echo (Yii::$app->zultanggal->ZULgetbulan(date('n', $rows['Waktu_Selesai'])))." "; 
										 echo (date('Y', $rows['Waktu_Selesai']))." "; echo "<br>";
										echo date('H.i', $rows['Waktu_Selesai']);
										}
										?>
									</td>
										
										<td align="center"><?php if ($rows['Waktu_Unduh_Berita_Acara']==0) {
											echo "<font color='red'> Belum Unduh </font>";
										} else
										{
										echo(Yii::$app->zultanggal->ZULgethari(date('N', $rows['Waktu_Unduh_Berita_Acara']))).', '; echo "<br>"; 
										 echo(date('j',$rows['Waktu_Unduh_Berita_Acara']))." ";
										 echo (Yii::$app->zultanggal->ZULgetbulan(date('n', $rows['Waktu_Unduh_Berita_Acara'])))." "; 
										 echo (date('Y', $rows['Waktu_Unduh_Berita_Acara']))." "; echo "<br>";
										echo date('H.i', $rows['Waktu_Unduh_Berita_Acara']);
										}
										?></td>
										<td width="20%"><?=$rows['Nama_Tempat']?><br><?=$rows['Alamat'];?></td>
										<?php 
										$tot_usulan = TaMusrenbang::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $rows['Kd_Urusan']])
				->andwhere(['Kd_Bidang' => $rows['Kd_Bidang']])
				->andwhere(['Kd_Unit' => $rows['Kd_Unit']])
				->andwhere(['Kd_Sub' => $rows['Kd_Sub_Unit']])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				//->andwhere(["NOT",["Skor"=>NULL]])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				//->andwhere(["NOT",["Skor"=>0]])
				//->andwhere(">","Kd_Prioritas_Pembangunan_Daerah",0)
				->count();
			?>
	
					<?php 
										$tot_pagu = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $rows['Kd_Urusan']])
				->andwhere(['Kd_Bidang' => $rows['Kd_Bidang']])
				->andwhere(['Kd_Unit' => $rows['Kd_Unit']])
				->andwhere(['Kd_Sub' => $rows['Kd_Sub_Unit']])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				//->andwhere(["NOT",["Skor"=>NULL]])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				//->andwhere(["NOT",["Skor"=>0]])
				->sum('Harga_Total');
			?>			
			<?php 
										$tot_usulan1 = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $rows['Kd_Urusan']])
				->andwhere(['Kd_Bidang' => $rows['Kd_Bidang']])
				->andwhere(['Kd_Unit' => $rows['Kd_Unit']])
				->andwhere(['Kd_Sub' => $rows['Kd_Sub_Unit']])
				//->andWhere(['or',['Kd_Asal_Usulan'=>'1'],['Kd_Asal_Usulan'=>'2'],['Kd_Asal_Usulan'=>'3']])
				->andWhere(["Status_Penerimaan_Skpd"=>'3'])
				//->andwhere(["Kd_Prioritas_Pembangunan_Daerah"=>0])
				->COUNT();
			?>			
			<?php 
										$tot_pagu1 = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $rows['Kd_Urusan']])
				->andwhere(['Kd_Bidang' => $rows['Kd_Bidang']])
				->andwhere(['Kd_Unit' => $rows['Kd_Unit']])
				->andwhere(['Kd_Sub' => $rows['Kd_Sub_Unit']])
				//->andWhere(['or',['Kd_Asal_Usulan'=>'1'],['Kd_Asal_Usulan'=>'2'],['Kd_Asal_Usulan'=>'3']])
               ->andWhere(["Status_Penerimaan_Skpd"=>'3'])
				//->andwhere(["Kd_Prioritas_Pembangunan_Daerah"=>0])
				->sum('Harga_Total');
			?>			
			<!--Belum Dibahas-->
			<?php 
			
					$tot_usulan2 = TaMusrenbang::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $rows['Kd_Urusan']])
				->andwhere(['Kd_Bidang' => $rows['Kd_Bidang']])
				->andwhere(['Kd_Unit' => $rows['Kd_Unit']])
				->andwhere(['Kd_Sub' => $rows['Kd_Sub_Unit']])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>NULL],
									['Status_Penerimaan_Skpd'=>'0'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				//->andwhere(["NOT",["Skor"=>NULL]])
				//->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["<=","Kd_Asal_Usulan",'4'])
				//->andwhere(["NOT",["Skor"=>0]])
				//->andwhere(">","Kd_Prioritas_Pembangunan_Daerah",0)
				->count();
			?>
	
					<?php 
										$tot_pagu2 = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $rows['Kd_Urusan']])
				->andwhere(['Kd_Bidang' => $rows['Kd_Bidang']])
				->andwhere(['Kd_Unit' => $rows['Kd_Unit']])
				->andwhere(['Kd_Sub' => $rows['Kd_Sub_Unit']])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>NULL],
									['Status_Penerimaan_Skpd'=>'0'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				//->andwhere(["NOT",["Skor"=>NULL]])
				//->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["<=","Kd_Asal_Usulan",'4'])
				//->andwhere(["NOT",["Skor"=>0]])
				->sum('Harga_Total');
			?>		
			<?php 
			
					$tot_usulan3 = TaMusrenbang::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $rows['Kd_Urusan']])
				->andwhere(['Kd_Bidang' => $rows['Kd_Bidang']])
				->andwhere(['Kd_Unit' => $rows['Kd_Unit']])
				->andwhere(['Kd_Sub' => $rows['Kd_Sub_Unit']])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>NULL],
									['Status_Penerimaan_Skpd'=>'0'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				//->andwhere(["NOT",["Skor"=>NULL]])
				//->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere([">","Kd_Asal_Usulan",'4'])
				//->andwhere(["NOT",["Skor"=>0]])
				//->andwhere(">","Kd_Prioritas_Pembangunan_Daerah",0)
				->count();
			?>
	
					<?php 
										$tot_pagu3 = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Urusan' => $rows['Kd_Urusan']])
				->andwhere(['Kd_Bidang' => $rows['Kd_Bidang']])
				->andwhere(['Kd_Unit' => $rows['Kd_Unit']])
				->andwhere(['Kd_Sub' => $rows['Kd_Sub_Unit']])
                ->andwhere(['or',
									['Status_Penerimaan_Skpd'=>NULL],
									['Status_Penerimaan_Skpd'=>'0'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				//->andwhere(["NOT",["Skor"=>NULL]])
				//->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere([">","Kd_Asal_Usulan",'4'])
				//->andwhere(["NOT",["Skor"=>0]])
				->sum('Harga_Total');
			?>		
			
							<td align='right'>
										<a href="index.php?r=dashboard%2Fhasil-forum-opd&Setuju=1&Urusan=<?=$rows['Kd_Urusan'];?>&Bidang=<?=$rows['Kd_Bidang'];?>&Unit=<?=$rows['Kd_Unit'];?>&Sub=<?=$rows['Kd_Sub_Unit'];?>"><button class="btn btn-success"><?=number_format($tot_usulan);?></button></a> 
										</td>
										<td align='right'>
										<?=number_format($tot_pagu);?>
										</td>
										<td align='right'>
										
										<a href="index.php?r=dashboard%2Fhasil-forum-opd&Setuju=0&Urusan=<?=$rows['Kd_Urusan'];?>&Bidang=<?=$rows['Kd_Bidang'];?>&Unit=<?=$rows['Kd_Unit'];?>&Sub=<?=$rows['Kd_Sub_Unit'];?>"><button class="btn btn-danger"><?=number_format($tot_usulan1);?></button></a> 
										</td>
										<td align='right'>
										<?=number_format($tot_pagu1);?>
										</td>
								<td align='right'>
										
										<a href="index.php?r=dashboard%2Fhasil-forum-opd&Setuju=2&Urusan=<?=$rows['Kd_Urusan'];?>&Bidang=<?=$rows['Kd_Bidang'];?>&Unit=<?=$rows['Kd_Unit'];?>&Sub=<?=$rows['Kd_Sub_Unit'];?>"><button class="btn btn-danger"><?=number_format($tot_usulan2);?></button></a> 
										</td>
										<td align='right'>
										<?=number_format($tot_pagu2);?>
										</td>
										<td align='right'>
										
										<a href="index.php?r=dashboard%2Fhasil-forum-opd&Setuju=3&Urusan=<?=$rows['Kd_Urusan'];?>&Bidang=<?=$rows['Kd_Bidang'];?>&Unit=<?=$rows['Kd_Unit'];?>&Sub=<?=$rows['Kd_Sub_Unit'];?>"><button class="btn btn-danger"><?=number_format($tot_usulan3);?></button></a> 
										</td>
										<td align='right'>
										<?=number_format($tot_pagu3);?>
										</td>
									</tr>
									<?php $jum_usulan=$jum_usulan+$tot_usulan; ?>
									<?php $jum_pagu=$jum_pagu+$tot_pagu; ?>
									<?php $jum_usulan1=$jum_usulan1+$tot_usulan1; ?>
									<?php $jum_pagu1=$jum_pagu1+$tot_pagu1; ?>
									<?php $jum_usulan2=$jum_usulan2+$tot_usulan2; ?>
									<?php $jum_pagu2=$jum_pagu2+$tot_pagu2; ?>
									
									<?php $jum_usulan3=$jum_usulan3+$tot_usulan3; ?>
									<?php $jum_pagu3=$jum_pagu3+$tot_pagu3; ?>
								<?php $no++; endforeach; ?>
								<th>
									<td colspan='6'align='center'> 
									TOTAL</td>
									<td align='right' width="5%">
									<?=number_format($jum_usulan);?> 
									
									</td align='right'>
									<td align='right'>
									 <?=number_format($jum_pagu);?>
									</td>
									<td align='right' width="5%">
									<?=number_format($jum_usulan1);?> 
									
									</td align='right'>
									<td align='right'>
									 <?=number_format($jum_pagu1);?>
									</td>
									<td align='right' width="5%">
									<?=number_format($jum_usulan2);?> 
									
									</td>
									<td align='right'>
									 <?=number_format($jum_pagu2);?>
									</td>
									<td align='right' width="5%">
									<?=number_format($jum_usulan3);?> 
									
									</td>
									<td align='right'>
									 <?=number_format($jum_pagu3);?>
									</td>
								</th>
								</tbody>
								
							</table>
							
							
                        </div>
                    </div>
                </div>
				
				