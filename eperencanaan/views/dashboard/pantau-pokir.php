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
use common\models\RefDapil;
use common\models\RefKomisiDprd;
use eperencanaan\models\RefDewan;
use common\models\RefFraksiDprd;
use common\models\TaUserDapil;
use eperencanaan\models\PantauPokir;
setlocale(LC_ALL, 'INDONESIA');
include"header.php";


?>
					
								
								
			
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
							
                                <h3>PANTAUAN KEGIATAN POKIR	<a href="/backoffice"> [Kembali] </a></h3>
                            </div>
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<!--<th style="text-align:center">Kecamatan</th>-->
										<th style="text-align:center">Anggota DPRD</th>
										<th style="text-align:center">Fraksi</th>
										<th style="text-align:center">Komisi</th>
										<th style="text-align:center">Dapil</th>
										<th style="text-align:center">Tanggal Reses</th>
										<th style="text-align:center">Masa Reses</th>
										<th style="text-align:center">Mulai</th>
										<th style="text-align:center">Selesai</th>
										<th style="text-align:center">Unduh BA</th>
										<th style="text-align:center">Lokasi Reses</th>
										<th style="text-align:center">Usulan Diproses</th>
										<th style="text-align:center">Pagu (Rp.)</th>
									
										
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;$jum_usulan=0;$jum_pagu=0;
								
								
								foreach($data as $rows): 
								  //if ($rows['Masa_Reses']==$reseske) {
									
									$data1=TaUserDapil::find()
									 ->where (['Kd_User'=>$rows['Kd_User']])
									 ->andWhere(['Tahun'=>date('Y')])
									 ->one(); 
									
									 $data2=RefDewan::find()
									->where (['Kd_Dewan'=>$data1['Kd_Dewan']])
									 ->andWhere(['Tahun'=>date('Y')])
									 ->one();
									 $data3=RefFraksiDprd::find()
									->where (['Kd_Fraksi'=>$data1['Kd_Fraksi']])
									 ->andWhere(['Tahun'=>date('Y')])
									 ->one();
									  $data4=RefKomisiDprd::find()
									->where (['Kd_Komisi'=>$data1['Kd_Komisi']])
									 ->andWhere(['Tahun'=>date('Y')])
									 ->one();
									 $data5=RefDapil::find()
									->where (['Kd_Dapil'=>$data1['Kd_Dapil']])
									 ->andWhere(['Tahun'=>date('Y')])
									 ->one();
								?>
									
									<tr>
										<td align='right'><?=$no;?>
										
										</td>
										<td>
											<?=$data2['Nm_Dewan']; ?>
											<br><b>
											<?php echo "ID: " .$rows['Kd_User'];?>
											</b>
										</td>
									<td>
											<?=$data3['Nm_Fraksi']; ?>
										</td>
										<td>
											<?=$data4['Nm_Komisi'] . " " . $data4['Keterangan'] ?>
										</td>
										<td align="Center">
											<?=$data5['Nm_Dapil']; ?>
										</td>
										<td>
											<?php echo date('d-m-Y',strtotime($rows['Tanggal_Reses']));?>
											
										</td>
										<td align="Center">
											<?=$rows['Masa_Reses'] ?>
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
                ->andwhere(['Kd_User' => $rows['Kd_User']])
                ->andwhere(['or',
									['Kd_Asal_Usulan'=>'5'],
									['Kd_Asal_Usulan'=>'6'],
									['Kd_Asal_Usulan'=>'7'],
									['Kd_Asal_Usulan'=>'8'],
								]) 
				->count();
			?>
	
					<?php 
										$tot_pagu = TaMusrenbang::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_User' => $rows['Kd_User']])
               ->andWhere(['or',
									['Kd_Asal_Usulan'=>'5'],
									['Kd_Asal_Usulan'=>'6'],
									['Kd_Asal_Usulan'=>'7'],
									['Kd_Asal_Usulan'=>'8'],
								])
				->sum('Harga_Total');
			?>			
			
			<td align='right'>
										<a href="index.php?r=dashboard%2Fusulan-pokir&Setuju=1&kd1=<?=$rows['Kd_User'];?> &dewan=<?=$data2['Nm_Dewan']; ?>"> <button class="btn btn-success"><?=number_format($tot_usulan);?> </button> </a>
										</td>
										<td align='right'>
										<?=number_format($tot_pagu);?>
										</td>
										
										
									</tr>
									<?php $jum_usulan=$jum_usulan+$tot_usulan; ?>
									<?php $jum_pagu=$jum_pagu+$tot_pagu; ?>
									
								  <?php $no++;  endforeach; ?>
								<th>
									<td colspan='10'align='center'> 
									TOTAL</td>
									<td align='right' width="5%">
									<?=number_format($jum_usulan);?>  
									
									</td align='right'>
									<td align='right'>
									 <?=number_format($jum_pagu);?>
									</td>
									
								</th>
								</tbody>
								 
							</table>
							
							
                        </div>
                    </div>
                </div>
				
				