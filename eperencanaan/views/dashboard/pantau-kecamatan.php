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
							
                                <h3>PANTAUAN KEGIATAN MUSRENBANG KECAMATAN</h3>
                            </div>
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<!--<th style="text-align:center">Kecamatan</th>-->
										<th style="text-align:center">KECAMATAN</th>
										<th style="text-align:center">Unduh Absen</th>
										<th style="text-align:center">Mulai</th>
										<th style="text-align:center">Selesai</th>
										<th style="text-align:center">Unduh BA</th>
										<th style="text-align:center">Lokasi Musrenbang</th>
										<th style="text-align:center">Usulan Diproses</th>
										<th style="text-align:center">Pagu (Rp.)</th>
										<th style="text-align:center">Usulan Ditolak</th>
										<th style="text-align:center">Pagu (Rp.)</th>
										
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;$jum_usulan=0;$jum_pagu=0;$jum_usulan1=0;$jum_pagu1=0;
								foreach($data as $rows): 
									 
								?>
									<tr>
										<td align='right'><?=$no;?></td>
										<!--<td>
										<?=@$nama_kec($rows['Kd_Kec']);?>
										</td> -->
										
										<td>
										 <?=@$nama_kec($rows['Kd_Kec']);?>

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
                ->andwhere(['Kd_Kec' => $rows['Kd_Kec']])
				->andWhere(['or',
									['Kd_Asal_Usulan'=>'1'],
									['Kd_Asal_Usulan'=>'2'],
									['Kd_Asal_Usulan'=>'3'],
								])
                ->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>'2'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				->andwhere(["NOT",["Skor"=>NULL]])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["NOT",["Skor"=>0]])
				//->andwhere(">","Kd_Prioritas_Pembangunan_Daerah",0)
				->count();
			?>
	
					<?php 
										$tot_pagu = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $rows['Kd_Kec']])
                ->andwhere(['or',
									['Status_Penerimaan_Kecamatan'=>'1'],
									['Status_Penerimaan_Kecamatan'=>'2'],
									//['Status_Penerimaan_Kecamatan'=>'3'],
								])
				->andwhere(["NOT",["Skor"=>NULL]])
				->andwhere(["<>","Kd_Prioritas_Pembangunan_Daerah",0])
				->andwhere(["NOT",["Skor"=>0]])
				->sum('Harga_Total');
			?>			
			<?php 
										$tot_usulan1 = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $rows['Kd_Kec']])
				->andWhere(['or',['Kd_Asal_Usulan'=>'1'],['Kd_Asal_Usulan'=>'2'],['Kd_Asal_Usulan'=>'3']])
				->andWhere(["or",["Status_Penerimaan_Kecamatan"=>NULL],
							  ["Status_Penerimaan_Kecamatan"=>'0'],
							  ["Status_Penerimaan_Kecamatan"=>'3'],
							  ["Skor"=>NULL],
							  ["Skor"=>0],
							  ["Kd_Prioritas_Pembangunan_Daerah"=>0]])
				
				->COUNT();
			?>			
			<?php 
										$tot_pagu1 = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $rows['Kd_Kec']])
				->andWhere(['or',['Kd_Asal_Usulan'=>'1'],['Kd_Asal_Usulan'=>'2'],['Kd_Asal_Usulan'=>'3']])
               ->andWhere(["or",["Status_Penerimaan_Kecamatan"=>NULL],
							  ["Status_Penerimaan_Kecamatan"=>'0'],
							  ["Status_Penerimaan_Kecamatan"=>'3'],
							   ["Skor"=>NULL],
							  ["Skor"=>0],
							  ["Kd_Prioritas_Pembangunan_Daerah"=>0]])
				//->andWhere(['or',['Skor'=>0],['Skor'=>NULL]])
				->sum('Harga_Total');
			?>			
			
							<td align='right'>
										<a href="index.php?r=dashboard%2Fusulan-kecamatan&Setuju=1&kec=<?=$rows['Kd_Kec'];?>"><button class="btn btn-success"><?=number_format($tot_usulan);?></button> </a>
										</td>
										<td align='right'>
										<?=number_format($tot_pagu);?>
										</td>
										<td align='right'>
										<a href="index.php?r=dashboard%2Fusulan-kecamatan&Setuju=0&kec=<?=$rows['Kd_Kec'];?>"><button class="btn btn-success"><?=number_format($tot_usulan1);?></button> </a>
										</td>
										<td align='right'>
										<?=number_format($tot_pagu1);?>
										</td>
										
									</tr>
									<?php $jum_usulan=$jum_usulan+$tot_usulan; ?>
									<?php $jum_pagu=$jum_pagu+$tot_pagu; ?>
									<?php $jum_usulan1=$jum_usulan1+$tot_usulan1; ?>
									<?php $jum_pagu1=$jum_pagu1+$tot_pagu1; ?>
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
								</th>
								</tbody>
								
							</table>
							
							
                        </div>
                    </div>
                </div>
				
				