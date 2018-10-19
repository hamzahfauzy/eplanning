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
use eperencanaan\assets\MapAsset;

include"header.php";
?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
                               
                            </div>
                            <?php $u = ($untuk == "kelurahan") ? "Desa/Kelurahan" : "Kecamatan"; ?>
                                 <h3>Informasi Usulan Forum Perangkat Daerah</h3>
                            </div>
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										

										<th style="text-align:center">No</th>
										<th style="text-align:center">Status Usulan</th>
										<th style="text-align:center">Lokasi</th>
										<th style="text-align:center">Detail Lokasi</th>
										<th style="text-align:center">Permasalahan</th>
										<th style="text-align:center">Usulan</th>
										
										<th style="text-align:center">Jumlah/Vol</th>
										<th style="text-align:center">Perk. Biaya (Rp)</th>
										<th style="text-align:center">OPD Penanggung Jawab</th>
										<th style="text-align:center">Keterangan</th>
										<th style="text-align:center">Dokumen</th>
										<th style="text-align:center">Skor</th>

									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;
								foreach($data as $rows): 
										if($rows['Status_Penerimaan_Skpd'] == 1)
											$status = "Disetujui";
										else if($rows['Status_Penerimaan_Skpd'] == 1)
											$status = "Disetujui dengan revisi";
										else if($rows['Status_Penerimaan_Skpd'] == 3)
											$status = "Ditolak";
										else
											$status = "Belum Dibahas";
								?>
									<tr>
										<td><?=$no;?></td>
										<td align="Center"><?=$status;?>
										<br><b>
										<?=$rows['id'];?>
										</b>
										</td>
										<td>
										<?php  if (empty($rows['Kd_Kel']))
										{
											echo "Kecamatan ".$nama_kec($rows['Kd_Kec']);
										}
										else
										{
											if (($nama_jalan($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel'],$rows['Kd_Lingkungan'],$rows['Kd_Jalan']))=="-" || empty($nama_jalan($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel'],$rows['Kd_Lingkungan'],$rows['Kd_Jalan'])))
											{
												
											}
											else
											{
												echo $nama_jalan($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel'],$rows['Kd_Lingkungan'],$rows['Kd_Jalan']) ." ";
											}

											echo $nama_lingkungan($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel'],$rows['Kd_Lingkungan'])." Desa/Kel ".$nama_desa($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel']).", Kecamatan ".$nama_kec($rows['Kd_Kec']);
										}
										?>
										</td>
										<td><?=$rows['Detail_Lokasi'];?></td>
										<td><?=$rows['Nm_Permasalahan'];?></td>
										<td><?=$rows['Jenis_Usulan'];?> </br>

										</td>
										
										<td align="center"><?=number_format($rows['Jumlah']);?> 
											<?=$satuan($rows['Kd_Satuan']);?></td>
										<td align="right"><?=number_format($rows['Harga_Total']);?></td>
										<td><?=@$rows->refSubUnit->Nm_Sub_Unit;?></td>
										<td><?=@$rows['Alasan_Skpd'];?>
										<br> <center>
										<font style color="Green">
										<?php if ($rows['Status_Penerimaan_Kota']==1 || $rows['Status_Penerimaan_Kota']==2)
										{
											echo "(Masuk Renja OPD)";
										}
										?>
										</font>
								
										</td>	
										</td><td align="Center">									
										<button class="btn btn-success" onclick="showmodaldokumen(<?=$rows->taMusrenbangKelurahan["Kd_Ta_Musrenbang_Kelurahan"];?>);"><span class="glyphicon glyphicon-folder-close"></span></button> </br>
							<!--			<button class="btn btn-danger" data-toggle="modal" data-target="#modallokasi" onclick="showmodallokasi(['<?=$rows->Latitute;?>','<?=$rows->Longitude;?>']);"><span class="glyphicon glyphicon-map-marker"></span></button></td> -->
										<br>
										<?php if ($rows['Kd_Asal_Usulan']<=4):
											  echo "Usulan Kec";
											  else: 
											  echo "Pokir";
											  endif;
										?>
										<td><?=@$rows['Skor'];?>
									</tr>
								<?php $no++; endforeach; ?>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
				<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
				<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
				<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
				<script>
					$('#example').DataTable();
					
					function showmodaldokumen(kd){
						$.get("index.php?r=dashboard/media-kelurahan&Kd="+kd, function(response){
							$("#response-modal").html(response);
							$("#modaldokumen").modal();
						});
					}
					/*
function showmodallokasi(kd){
		$("#lat").html(kd[0]);
		$("#lng").html(kd[1]);	
		var sumber = "https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=600&hl=ru&coord="+kd[0]+","+kd[1]+"&ie=UTF8&t=&z=14&iwloc=B&output=embed";
		$("#frame").attr("src", sumber); 
	} */			</script>
                


<div id="modaldokumen" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Musrenbang</h4>
      </div>
      <div class="modal-body">
        <span id="response-modal"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php include"footer.php"; ?>
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

<!--
<div id="modallokasi" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> -->

    <!-- Modal content-->
    <!--
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Lokasi Usulan</h4>
      </div>
      <div class="modal-body">
		<span>Latitute : <span id="lat"></span></span><br>
		<span>Longitude : <span id="lng"></span></span>
		<div style="width: 100%">
		<iframe id="frame" width="100%" height="600" src="" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> -->