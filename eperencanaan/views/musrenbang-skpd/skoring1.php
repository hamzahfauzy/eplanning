<?php
$skor = [];
$skor[1]=[ //Infrastruktur
	1 => "< 10 KK",
	2 => 	"10 <= 20 KK",
	3 => 	"21 <= 30 KK",
	4 => 	"31 <= 40 KK",
	5 => 	">40 KK",
];

$skor[2]=[ //sosialbudaya
	1 => "< 20 KK",
	2 => "20 <= 40 KK",
	3 => "41 <= 60 KK",
	4 => "61 <= 80 KK",
	5 => ">80 KK",
];

$skor[3]=[ //ekonnomi
	1 => "< 20 KK",
	2 => "20 <= 40 KK",
	3 => "41 <= 60 KK",
	4 => "61 <= 80 KK",
	5 => ">80 KK",
];

?>

<style type="text/css">
	.tabelskor > thead > tr > th, .tabelskor > tbody > tr > th, .tabelskor > tfoot > tr > th, .tabelskor > thead > tr > td, .tabelskor > tbody > tr > td, .tabelskor > tfoot > tr > td {
		padding: 5px;
		font-size: 12px;
	}

	.tabelskor > tbody > .kecil > td{
		height: 5px;
		line-height: 0px;
	}

	.tabelskor > tbody > .kecil{
		height: 5px;
		line-height: 0px;
	}
</style>
<h3>Pembobotan</h3>
<form id="skoring_form">
	<input type="hidden" name="id" value="<?= $id ?>" id="id_skoring">
	<table class='table table-bordered tabelskor'>
		<thead>
			<tr>
				<td>No.</td>
				<td>Kriteria</td>
				<!-- <td>Bobot</td> -->
				<td>Range</td>
				<!-- <td>Skor</td> -->
				<td>Pilih</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				$no=0;
				foreach ($kriteria as $val) :
					$no++;
					$bobot = $val->getRefKecamatanKriteriaBobots()->all();
					$baris=0;
					foreach ($bobot as $bobot) :
						$baris++;
						?>
							<tr>
								<?php
									if ($baris == 1) {
										?> 
											<td><?= $no ?></td> 
										<?php
									}
									else{
										?> 
											<td></td> 
										<?php
									}
								?>
								<?php
									if ($baris == 1) {
										if ($val->Kriteria == 'MANFAAT/DAMPAK') {
											?>
												<td>
													<?= $val->Kriteria." ".$Bidang_Pembangunan ?>
												</td>
											<?php
										}
										else{
											?> 
												<td><?= $val->Kriteria ?></td> 
											<?php
										}
										
									}
									else{
										?> 
											<td></td> 
										<?php
									}
								?>
								<!-- <td><?= $val->Bobot ?> %</td> -->
								<?php
									if ($val->Kriteria == 'MANFAAT/DAMPAK') {
										?>
											<td>
												<?= $skor[$Kd_Pem][$bobot->Range] ?>
											</td>
										<?php
									}
									else{
										?>
											<td><?= $bobot->Range ?></td>
										<?php
									}
								?>
								
								<!-- <td><?= $bobot->Skor ?></td> -->
								<td><input type="radio" name="bobot[<?= $val->Kd_Kriteria ?>]" value="<?= $bobot->Skor ?>"></td>
							</tr>	
						<?php
					endforeach;
					?>
						<tr class="kecil">
							<td></td>
							<td></td>
							<!-- <td></td> -->
							<td></td>
							<!-- <td></td> -->
							<td></td>
						</tr>
					<?php
				endforeach;
			?>
			<!--
			<tr>
				<td></td>
				<td></td>
				<td>Total</td>
				<td id="totalScore"></td>
			</tr>
			-->
		</tbody>
	</table>
	*) Semua Kriteria Skoring Harus Dipilih untuk mengaktifkan tombol
	<input type="hidden" name="skor" id="isi_skor">
</form>
<input type="hidden" id="jumlah_kriteria" value="<?= $no ?>">
<script type="text/javascript">
	$("input[type='radio']").click(function(){
		var sum = parseFloat(0.00);
		$("#skoring_form")
			.find("input[type='radio']:checked")
			.each(function (i, e){
				sum+=parseFloat($(e).val());
			});

		$("#isi_skor").val(sum.toFixed(2));

		var jumlah_kriteria = $("#jumlah_kriteria").val();
		var jlh_pilih = $('input:radio:checked').length;
		//alert(jumlah_kriteria+' '+jlh_pilih);
		if (jumlah_kriteria == jlh_pilih) {
			$('#btn_skoring_simpan').attr('disabled', false);
		}
	});

	$('#btn_skoring_simpan').attr('disabled', true);
</script>