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

include"header.php";
if ($jumlah_record==0) {
	$jumlah_tombol = $total_usulan/1;
}else
{
	$jumlah_tombol = $total_usulan/$jumlah_record	;
}


if($jumlah_tombol > 10){
	$akhir = ceil($jumlah_tombol);
	$jumlah_tombol = 10;
}else
{
	//$jumlah_tombol = ceil(jumlah_tombol);
	$akhir = 0;
	
	}
//$akhir = $jumlah_tombol;
//echo $akhir;
?>

		
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
							<?php $u = ($untuk == "kelurahan") ? "Desa/Kelurahan" : "Kecamatan"; ?>
                                <h3>Informasi Usulan Musrenbang <?=$u;?></h3>
                            </div>
							<form>
							 <div class="col-md-2">
									<div class="form-group">
								<input type="hidden" name="r" value="dashboard/usulan-kelurahan">
								<b>Jumlah Record:</b>
								<select class="form-control" name="jumlah_record">
								<option value="*" <?php if(isset($_GET['jumlah_record']) && $_GET['jumlah_record']=='*') echo "selected"; ?>>Semua</option>
									<option value="10" <?php if($jumlah_record==10) echo "selected"; ?>>10</option>
									<option value="25" <?php if($jumlah_record==25) echo "selected"; ?>>25</option>
									<option value="50" <?php if($jumlah_record==50) echo "selected"; ?>>50</option>
									<option value="100" <?php if($jumlah_record==100) echo "selected"; ?>>100</option>
									
								</select>
								</div>
                                    </div>
									
								
								 <div class="col-md-3">
								 <div class="form-group">
								 <b>Kecamatan:</b>
								<select  class="form-control" id="kecamatan" name="Kd_Kec">
									
									<?php
									foreach($model_kec as $kec){
									?>
									<option value="<?=$kec->Kd_Kec;?>" <?php if(isset($_GET['Kd_Kec']) && $_GET['Kd_Kec'] == $kec->Kd_Kec) echo "selected"; ?>><?=$kec->Nm_Kec;?></option>
									<?php } ?>
									<option value="*">Semua</option>
								</select>
								</div>
                                    </div>
									<div class="col-md-3">
								 <div class="form-group">
								<b>Desa/Kelurahan:</b>
								<select class="form-control" id="desa" name="desa_id">
									<option value="*">Semua</option>
									
								</select>
								</div>
                                    </div>
									<div class="col-md-3">
								 <div class="form-group">
								<b>Kata Kunci:</b>
								<input class="form-control" type="text" name="kata_kunci" value="<?=$kata_kunci;?>">
								</div>
                                    </div>
									<br>
									<button class="btn btn-success">Cari</button>
								
								</form>
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
										<th style="text-align:center">Dokumen</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1+($jumlah_record*($halaman-1));
								$xTotal=0;
								foreach($data as $rows): 
									if($untuk == "kelurahan"){
										
										if($rows['status']==1)
											$status = "Diteruskan";
										else if($rows['status']==2)
											$status = "statusi";
										else if($rows['status']==3)
											$status = "Ditolak";
										else
											$status = "Belum Dibahas";
									}else{
										if($rows['Status_Penerimaan_Kecamatan'] == 1)
											$status = "Diteruskan";
										else if($rows['Status_Penerimaan_Kecamatan'] == 1)
											$status = "Diteruskan dengan revisi";
										else if($rows['Status_Penerimaan_Kecamatan'] == 3)
											$status = "Ditolak";
										else
											$status = "Belum Dibahas";
										
										$for = ucfirst($untuk);
									}
								?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$status;?></td>
										<td>
										<?=@$nama_jalan($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel'],$rows['Kd_Lingkungan'],$rows['Kd_Jalan']);?>
										<br>
										<?=@$nama_lingkungan($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel'],$rows['Kd_Lingkungan']).", Desa/Kel ".$nama_desa($rows['Kd_Kec'],$rows['Kd_Kel'],$rows['Kd_Urut_Kel']).", Kecamatan ".$nama_kec($rows['Kd_Kec']);?>
										</td>
										<td><?=$rows['Detail_Lokasi'];?></td>
										<td><?=$rows['Nm_Permasalahan'];?></td>
										<td><?=$rows['Jenis_Usulan'];?></td>
										
										<td align="center">
										<?=number_format($rows['Jumlah']);?>
										<?=$satuan($rows['Kd_Satuan']);?>
										</td>
										<td align="right"><?=number_format($rows['Harga_Total']);?></td>
										<td><?=@$opd($rows['Kd_Urusan'],$rows['Kd_Bidang']);?></td>
										<td align="Center"><button class="btn btn-success" type="button" onclick="showmodaldokumen(<?=$rows["Kd_Ta_Musrenbang_Kelurahan"];?>);"><span class="glyphicon glyphicon-folder-close"></span> </button></td>
									</tr>
									<?php $xTotal= $xTotal+$rows['Harga_Total']; ?>
								<?php $no++; endforeach; ?>
								</tbody>
							</table>
							<?= "Jumlah Usulan: ".number_format($jumlah_record). " dari ".number_format($total_usulan) ." | 		Total Pagu : Rp. ". number_format($xTotal);?>
							<!--
							<?php if($jumlah_tombol != 1){ ?>
							<?php 
							$link = "&jumlah_record=".$jumlah_record."&Kd_Kec=".$KdKec."&desa_id=".$desa_id."&kata_kunci=".$kata_kunci;
							if($halaman == 1){
								$prev = "#";
								$next = "index.php?r=dashboard/usulan-kelurahan&halaman=".($halaman + 1);
							}else if($halaman == $akhir){
								$prev = "index.php?r=dashboard/usulan-kelurahan&halaman=".($halaman-1);
								$next = "#";
							}else{
								$prev = "index.php?r=dashboard/usulan-kelurahan&halaman=".($halaman - 1);
								$next = "index.php?r=dashboard/usulan-kelurahan&halaman=".($halaman + 1);
							}
							?>
							<table align="center">
								<tr>
									<td><a href="index.php?r=dashboard/usulan-kelurahan&halaman=1<?=$link;?>"><button>First</button></a><td>
									<td><a href="<?=$prev;?><?=$link;?>"><button>Prev</button></a></td>
									<?php 
										if($halaman > 6){
											$ii = $halaman - 6;	
										}else{
											$ii = 1;
										}
										for($i=$ii;$i<=$jumlah_tombol+$ii;$i++){ 
											 $label = $i;
									?>
									<td><a href="index.php?r=dashboard/usulan-kelurahan&halaman=<?=$label;?><?=$link;?>"><button <?php if($halaman==$label) echo "class='btn btn-success'"; ?>><?=$label;?></button></a><td>
									<?php } ?>
									<td><a href="<?=$next;?><?=$link;?>"><button>Next</button></a><td>
									<td><a href="index.php?r=dashboard/usulan-kelurahan&halaman=<?=$akhir;?><?=$link;?>"><button>Last</button></a><td>
								</tr>
							</table>
							<?php } ?> -->
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
                <?php include"footer.php"; ?>
				
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