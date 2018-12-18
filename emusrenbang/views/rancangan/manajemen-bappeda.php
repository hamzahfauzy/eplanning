<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = "Manajemen Rencana Kerja Perangkat Daerah";
$js='$(".btn-selesai").click(function(){
		urusan = $(this).data("urusan");
		bidang = $(this).data("bidang");
		unit = $(this).data("unit");
		sub = $(this).data("sub");
		jenis = $(this).data("jenis");
		
		$("#urusan").val(urusan);
		$("#bidang").val(bidang);
		$("#unit").val(unit);
		$("#sub").val(sub);
		$("#jenis").val(jenis);
});
';
$this->registerJs($js, 4, 'My');
?>
<div class="container-fluid" style="background:#FFF">
<h2>Manajemen Renja Perangkat Daerah</h2>
<div class="row">
	<div class="col-sm-12 table-responsive">
	<table class="table table-bordered">
		<tr>
			<td><b>No</b></td>
			<td><b>Nama OPD</b></td> 
			<td><b>Rancangan Awal</b></td>
			<td><b>Rancangan</b></td>
			<td><b>Rancangan Akhir</b></td>
			<td><b>Pra RKA</b></td>
		</tr>
		<?php
		$no=1;
		foreach($subunit as $val){
			$thn_awal=date("Y")+1;
			$tahun = date("Y");
			if($ranwal($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)>0){
				
			}
			$s_ranwal = ($ranwal($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)>0) ? "No. SK : <br>".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan Awal")->No_Sk_Penetapan. "<br>Tgl: ".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan Awal")->Tanggal."<br><a href='index.php?r=rancangan/lihat-ranwal&Kd_Urusan=".$val->Kd_Urusan."&Kd_Bidang=".$val->Kd_Bidang."&Kd_Unit=".$val->Kd_Unit."&Kd_Sub=".$val->Kd_Sub."'>Lihat</a>" : "<button class='btn btn-warning btn-selesai' data-urusan='".$val->Kd_Urusan."' data-bidang='".$val->Kd_Bidang."' data-unit='".$val->Kd_Unit."' data-sub='".$val->Kd_Sub."' data-jenis='Rancangan Awal' data-toggle='modal' data-target='#myModal'>Selesai</button>";
			$s_rancangan = ($ranwal($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)>0 && 
							$rancangan($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)>0) ? "No. SK : <br>".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan")->No_Sk_Penetapan."<br>Tgl: ".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan")->Tanggal."<br><a href='index.php?r=rancangan/lihat-rancangan&Kd_Urusan=".$val->Kd_Urusan."&Kd_Bidang=".$val->Kd_Bidang."&Kd_Unit=".$val->Kd_Unit."&Kd_Sub=".$val->Kd_Sub."'>Lihat</a>"  : (($ranwal($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)==0 && $rancangan($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)==0) ? "Rancangan Awal Belum Selesai" : "<button class='btn btn-warning btn-selesai' data-urusan='".$val->Kd_Urusan."' data-bidang='".$val->Kd_Bidang."' data-unit='".$val->Kd_Unit."' data-sub='".$val->Kd_Sub."' data-jenis='Rancangan' data-toggle='modal' data-target='#myModal'>Selesai</button>");
			if($ranwal($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)>0 && 
			   $rancangan($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)>0 &&
			   $akhir($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)>0
			   ){ 
			   $s_ran_akhir="No. SK : <br>".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan Akhir")->No_Sk_Penetapan."<br>Tgl: ".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan Akhir")->Tanggal."<br><a href='index.php?r=rancangan/lihat-rancangan-akhir&Kd_Urusan=".$val->Kd_Urusan."&Kd_Bidang=".$val->Kd_Bidang."&Kd_Unit=".$val->Kd_Unit."&Kd_Sub=".$val->Kd_Sub."'>Lihat</a>";
			}else if($ranwal($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)!==0 && 
					 $rancangan($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)==0 &&
					 $akhir($tahun,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub)==0){
				$s_ran_akhir = "Rancangan Belum Selesai";
			}else{
				$s_ran_akhir = "<button class='btn btn-warning btn-selesai' data-urusan='".$val->Kd_Urusan."' data-bidang='".$val->Kd_Bidang."' data-unit='".$val->Kd_Unit."' data-sub='".$val->Kd_Sub."' data-jenis='Rancangan Akhir' data-toggle='modal' data-target='#myModal'>Selesai</button>";
			}
			if(isset($penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan Akhir")->No_Sk_Penetapan)
				&&
			   !isset($penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA")->No_Sk_Penetapan)
				){
				$rka = "<button class='btn btn-warning btn-selesai' data-urusan='".$val->Kd_Urusan."' data-bidang='".$val->Kd_Bidang."' data-unit='".$val->Kd_Unit."' data-sub='".$val->Kd_Sub."' data-jenis='Pra RKA' data-toggle='modal' data-target='#myModal'>Selesai</button>";
			}else if(isset($penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA")->No_Sk_Penetapan)
				&&
			 !isset($penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA Perubahan")->No_Sk_Penetapan)
				){
				$rka = "No. SK : <br>".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA")->No_Sk_Penetapan."<br> Tgl: ".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA")->Tanggal."<br><a href='index.php?r=rancangan/lihat-pra-rka&urusan=".$val->Kd_Urusan."&bidang=".$val->Kd_Bidang."&unit=".$val->Kd_Unit."&sub=".$val->Kd_Sub."&tahapan=Pra RKA&peraturan=".$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA")->No_Sk_Penetapan."'>Lihat</a>";
			//	$rka = "No. SK : <br>".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA")->No_Sk_Penetapan."<br><a href='index.php?r=rancangan/lihat-pra-rka&urusan=".$val->Kd_Urusan."&bidang=".$val->Kd_Bidang."&unit=".$val->Kd_Unit."&sub=".$val->Kd_Sub."&tahapan=Pra RKA&peraturan=".$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA")->No_Sk_Penetapan."'>Lihat</a>";
 ////$s_ran_akhir= "No. SK : <br>".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan Akhir")->No_Sk_Penetapan."<br> Tgl: ".@$penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Rancangan Akhir")->Tanggal."<br><a href='index.php?r=rancangan/lihat-rancangan-akhir&Kd_Urusan=".$val->Kd_Urusan."&Kd_Bidang=".$val->Kd_Bidang."&Kd_Unit=".$val->Kd_Unit."&Kd_Sub=".$val->Kd_Sub."'>Lihat</a>";
				 $rka .= "<br><button class='btn btn-warning btn-selesai' data-urusan='".$val->Kd_Urusan."' data-bidang='".$val->Kd_Bidang."' data-unit='".$val->Kd_Unit."' data-sub='".$val->Kd_Sub."' data-jenis='Pra RKA Perubahan' data-toggle='modal' data-target='#myModal'>Perubahan</button>";
			
				
				// $rka .= "<br><button class='btn btn-warning btn-selesai' data-urusan='".$val->Kd_Urusan."' data-bidang='".$val->Kd_Bidang."' data-unit='".$val->Kd_Unit."' data-sub='".$val->Kd_Sub."' data-jenis='Pra RKA Perubahan' data-toggle='modal' data-target='#myModal'>Perubahan</button>";
			
			}else if(isset($penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA Perubahan")->No_Sk_Penetapan)){
				$_penetapan_sebelum = $penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA");
				$_penetapan = $penetapan($thn_awal,$val->Kd_Urusan,$val->Kd_Bidang,$val->Kd_Unit,$val->Kd_Sub,"Pra RKA Perubahan");
				// print_r($_penetapan_sebelum);
				$rka = 1;
				$rka = "No. SK : <br>".$_penetapan_sebelum->No_Sk_Penetapan."<br> Tgl: ".$_penetapan_sebelum->Tanggal."<br><a href='index.php?r=rancangan/lihat-pra-rka&urusan=".$val->Kd_Urusan."&bidang=".$val->Kd_Bidang."&unit=".$val->Kd_Unit."&sub=".$val->Kd_Sub."&tahapan=Pra RKA&peraturan=".$_penetapan_sebelum->No_Sk_Penetapan."'>Lihat</a><br>";
				$rka .= "No. SK Perubahan : <br>".$_penetapan->No_Sk_Penetapan."<br> Tgl: ".$_penetapan->Tanggal."<br><a href='index.php?r=rancangan/lihat-pra-rka&urusan=".$val->Kd_Urusan."&bidang=".$val->Kd_Bidang."&unit=".$val->Kd_Unit."&sub=".$val->Kd_Sub."&tahapan=Pra RKA Perubahan&peraturan=".$_penetapan->No_Sk_Penetapan."'>Lihat</a>";
			}else{
				$rka = "Rancangan Akhir Belum Selesai";
			}
			?>
		<tr>
			<td><?=$no;$no++;?></td>
			<td width="35%"><?=$val->Nm_Sub_Unit;?></td>
			<td align="center"><?=$s_ranwal;?></td>
			<td><?=$s_rancangan;?></td>
			<td><?=$s_ran_akhir;?></td>
			<td><?=$rka;?></td>
		</tr>
		<?php } ?>
	</table>
	</div>
</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	<?php $form = ActiveForm::begin(["action"=>"index.php?r=rancangan/finish"]); ?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Peraturan</h4>
      </div>
      <div class="modal-body">
		<input type="hidden" name="urusan" id="urusan">
		<input type="hidden" name="bidang" id="bidang">
		<input type="hidden" name="unit" id="unit">
		<input type="hidden" name="sub" id="sub">
		<input type="hidden" name="jenis" id="jenis">
        No. Peraturan :
		<input type="text" name="no_sk" class="form-control">
		Tanggal :
		<input type="text" name="tanggal" class="form-control">
		Keterangan :
		<textarea name="keterangan" class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
	<?php ActiveForm::end(); ?>
  </div>
</div>