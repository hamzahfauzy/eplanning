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
use eperencanaan\models\TaMusrenbangKelurahan;
setlocale(LC_ALL, 'INDONESIA');
include"header.php";


?>
					
								<?php 
								$nox=1;$noz=0;
								foreach($data1 as $rows): 
									 
								?>
									
										
									
										
										
										<?php $xDesa=@$nama_desa($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut']);
										$xKec=$rows['Kd_Kec'];$xKel=$rows['Kd_Kel'];$xUrut=$rows['Kd_Urut'];
										
											?>
										
										
										
										<?php 
								$nox1=1;
								foreach($data as $rows): 
								
								?>
								
								<?php if ($xKec==$rows['Kd_Kec'] && $xKel==$rows['Kd_Kel'] && $xUrut==$rows['Kd_Urut_Kel'])
								{
										
										goto xx;
									
								}
									
								?> 
										
										<?php $nox1++; endforeach; ?>
										<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<!--<th style="text-align:center">Kecamatan</th>-->
										<th style="text-align:center">Desa/Kelurahan</th>
										<th style="text-align:center">Kecamatan</th>
										<th style="text-align:center">Status</th>
										
										
									</tr>
								</thead>
								<tbody>
										<tr>
										<td><?=$noz=$noz+1;?></td>
										<td>
											<?= $xDesa;?> 
										</td>
										<td>
										<?= @$nama_kec($xKec);?>
										</td>
										<td>
											<font color='red'> Belum Musrenbang </font>
										</td>
										<?php 
										xx:
										
										?>
	
									<?php $nox++; endforeach; ?>
								</th>
								</tbody>
								
							</table>
			
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
							<?php $u = ($untuk == "kelurahan") ? "Desa/Kelurahan" : "Kecamatan"; ?>
                                <h3>PANTAUAN KEGIATAN MUSRENBANG DESA/KELURAHAN</h3>
                            </div>
							<form>
							 <div class="col-md-2">
									<div class="form-group">
								<input type="hidden" name="r" value="dashboard/pantaumusrenbang">
								<b>Jumlah Record:</b>
								<select class="form-control" name="jumlah_record" type ="hidden">
									
									<option value="*" <?php if(isset($_GET['jumlah_record']) && $_GET['jumlah_record']=='*') echo "selected"; ?>>Semua</option>
								</select>
								</div>
                                    </div>
									
								
								 <div class="col-md-3">
								 <div class="form-group">
								 <b>Kecamatan:</b>
								<select  class="form-control" id="kecamatan" name="Kd_Kec">
									<option value="*">Semua</option>
									<?php
									foreach($model_kec as $kec){
									?>
									<option value="<?=$kec->Kd_Kec;?>" <?php if(isset($_GET['Kd_Kec']) && $_GET['Kd_Kec'] == $kec->Kd_Kec) echo "selected"; ?>><?=$kec->Nm_Kec;?></option>
									<?php } ?>
								</select>
								</div>
                                    </div>
									
									
									<br>
									<button class="btn btn-success">Cari</button>
								
								</form>
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<!--<th style="text-align:center">Kecamatan</th>-->
										<th style="text-align:center">Desa/Kelurahan</th>
										<th style="text-align:center">Unduh Absen</th>
										<th style="text-align:center">Mulai</th>
										<th style="text-align:center">Selesai</th>
										<th style="text-align:center">Unduh BA</th>
										<th style="text-align:center">Lokasi Musrenbang</th>
										<th style="text-align:center">Jlh Usulan</th>
										<th style="text-align:center">Pagu (Rp.)</th>
										
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;$jum_usulan=0;$jum_pagu=0;
								foreach($data as $rows): 
									 
								?>
									<tr>
										<td align='right'><?=$no;?></td>
										<!--<td>
										<?=@$nama_kec($rows['Kd_Kec']);?>
										</td> -->
										
										<td>
										<?=@$nama_desa($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel']);?>
										<br>Kec. <?=@$nama_kec($rows['Kd_Kec']);?>

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
										
										<?php if ($rows['Status_Pembahasan_Usulan']==0) { ?>
										<div style="color: white; background: red"> Belum Verifikasi </div>
											<br>
										<?php
										}
										
										?>
										
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
										$tot_usulan = TaMusrenbangKelurahan::find()  
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $rows['Kd_Kec']])
                ->andwhere(['Kd_Kel' => $rows['Kd_Kel']])
                ->andwhere(['Kd_Urut_Kel' => $rows['Kd_Urut_Kel']])
				->count();
			?>
	
					<?php 
										$tot_pagu = TaMusrenbangKelurahan::find()
				->where(['Kd_Prov' => 12])
                ->andwhere(['Kd_Kab' => 9])
                ->andwhere(['Kd_Kec' => $rows['Kd_Kec']])
                ->andwhere(['Kd_Kel' => $rows['Kd_Kel']])
                ->andwhere(['Kd_Urut_Kel' => $rows['Kd_Urut_Kel']])
				->sum('Harga_Total');
			?>			
		
			
							<td align='right'>
										<?=number_format($tot_usulan);?>
										</td>
										<td align='right'>
										<?=number_format($tot_pagu);?>
										</td>
										
									</tr>
									<?php $jum_usulan=$jum_usulan+$tot_usulan; ?>
									<?php $jum_pagu=$jum_pagu+$tot_pagu; ?>
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
									
								</th>
								</tbody>
								
							</table>
							
							
                        </div>
                    </div>
                </div>
				
				<script src="/kamususulan/views/js/jquery.js"></script>
				<script>
					$("#kecamatan").change(function(){
						var kd = $(this).val();
						$.get("index.php?r=dashboard/get-desa&Kd_Kec="+kd,function(response){
							$('#desa').children().remove();
							$('#desa').append(response);
						});
					});
					function showmodaldokumen(kd){
						$.get("index.php?r=dashboard/media-<?=$untuk;?>&Kd="+kd, function(response){
							$("#response-modal").html(response);
							$("#modaldokumen").modal();
						});
					}
				</script>

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