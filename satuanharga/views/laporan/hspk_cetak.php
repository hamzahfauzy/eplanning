<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.tabel-hasil{
		    border-collapse: collapse;
		    width: 100%;
		    border: 1px solid #000;
		}

		.tabel-hasil th{
		    border: 1px solid #000;
		    text-align: center;
		}

		.tabel-hasil td{
		    border-left: 1px solid #000;
		    border-right: 1px solid #000;
		}

		.tabel-hasil th, .tabel-hasil td{
			padding: 0 5px;
		}

		.tabel-hasil .uraian_kegiatan{
			font-weight: bold;
		}

		.tabel-hasil .kategori_pekerjaan{
			font-weight: bold;
			text-decoration: underline;
		}

		.tabel-hasil .uang, .tabel-hasil .koef, .tabel-hasil .text-right{
			text-align: right;
		}

		.tabel-hasil .text-bold{
			font-weight: bold;
		}

		.tabel-hasil .jumlah{
		    border-top: 1px solid #000;
		    font-weight: bold;
		}

		.tabel-hasil .akhir{
		    border-bottom: 1px solid #000;
		}
	</style>
</head>
<body>
<h1 align="center">Daftar Harga Satuan Pokok Kegiatan</h1>
<h2 align="center">(HSPK)</h2>
<div class="tabel-wrap">
  <table class="tabel-hasil">
    <thead>
      <tr>
        <th>NOMOR</th>
        <th>URAIAN KEGIATAN</th>
        <th>KOEF.</th>
        <th>SAT</th>
        <th>HARGA SATUAN</th>
        <th>HARGA</th>
      </tr>
    </thead>
    <tbody>
      <!-- mulai kegiatan -->
      <?php
      	foreach ($dataHspk as $hspk1) : //hspk1
      		$Kd_Hspk1 = $hspk1->Kd_Hspk1;
      		?>
						<!-- mulai html hspk 1-->
      			<tr class="akhir"><!-- judul kegiatan -->
			        <td><?= $Kd_Hspk1 ?></td>
			        <td class="uraian_kegiatan"><?= $hspk1->Nm_Hspk1 ?></td>
			        <td></td>
			        <td></td>
			        <td></td>
			        <td></td>
			      </tr>
			      <?php
			      	$dataHspk2 = $hspk1->getRefHspk2s()->all();
			      	foreach ($dataHspk2 as $hspk2) :
			      		$Kd_Hspk2 = $hspk2->Kd_Hspk2 
			      		?>
									<!-- mulai html hspk 2-->
			      			<tr class="akhir"><!-- judul kegiatan -->
						        <td><?= $Kd_Hspk1.".".$Kd_Hspk2 ?></td>
						        <td class="uraian_kegiatan"><?= $hspk2->Nm_Hspk2 ?></td>
						        <td></td>
						        <td></td>
						        <td></td>
						        <td></td>
						      </tr>
						      <?php
						      	$dataHspk3 = $hspk2->getRefHspk3s()->all();
						      	foreach ($dataHspk3 as $hspk3) :
						      		$Kd_Hspk3 = $hspk3->Kd_Hspk3 
						      		?>
												<!-- mulai html hspk 3-->
						      			<tr class="akhir"><!-- judul kegiatan -->
									        <td><?= $Kd_Hspk1.".".$Kd_Hspk2.".".$Kd_Hspk3 ?></td>
									        <td class="uraian_kegiatan"><?= $hspk3->Nm_Hspk3 ?></td>
									        <td></td>
									        <td></td>
									        <td></td>
									        <td></td>
									      </tr>
									      <?php
									      	$dataHspk4 = $hspk3->getRefHspks()->all();
									      	foreach ($dataHspk4 as $hspk) :
									      		$Kd_Hspk4 = $hspk->Kd_Hspk4 
									      		?>
															<!-- mulai html hspk 4-->
									      			<tr><!-- judul kegiatan -->
												        <td><?= $Kd_Hspk1.".".$Kd_Hspk2.".".$Kd_Hspk3.".".$Kd_Hspk4 ?></td>
												        <td class="uraian_kegiatan"><?= $hspk->Uraian_Kegiatan ?></td>
												        <td></td>
												        <td><?= $hspk->kdSatuan->Uraian ?></td>
												        <td></td>
												        <td></td>
												      </tr>
												      <?php
												        $total_semua=0;
												        $total_kategori_1=0;
												        if($hspk->getTaSshHspks()->where(['Kategori'=>'1'])->count() > 0){
												        	?>
												        	<tr><!-- kategori -->
														        <td></td>
														        <td class="kategori_pekerjaan">Upah:</td>
														        <td></td>
														        <td></td>
														        <td></td>
														        <td></td>
														      </tr>
												        	<?php
													        $ssh = $hspk->getTaSshHspks()->where(['Kategori'=>'1'])->all();
													        foreach ($ssh as $key => $value) :
													          $nomor=$value->Kd_Ssh1.".".$value->Kd_Ssh2.".".$value->Kd_Ssh3.".".$value->Kd_Ssh4.".".$value->Kd_Ssh5.".".$value->Kd_Ssh6;
													          $total_kategori_1+=$value->Harga;
													          $nama_barang='';

													          if (isset($value->kdSsh1->Nama_Barang)) {
													          	$nama_barang=$value->kdSsh1->Nama_Barang;
													          }
													          $Koefisien = $value->Koefisien;
																		$Uraian = $value->kdSatuan->Uraian;
																		$Harga_Satuan = $value->Harga_Satuan;
																		$Harga = $value->Harga;
													          ?>
													            <tr><!-- tambah ssh -->
													              <td><?= $nomor ?></td>
													              <td><?= $nama_barang ?></td>
													              <td><?= $Koefisien ?></td>
													              <td><?= $Uraian ?></td>
													              <td class="uang"><?= $Harga_Satuan ?></td>
													              <td class="uang"><?= $Harga ?></td>
													            </tr>
													          <?php
													        endforeach;
													        $total_semua+=$total_kategori_1;
														      ?>
														      <tr><!-- jumlah ssh -->
														        <td></td>
														        <td></td>
														        <td></td>
														        <td></td>
														        <td class="text-right text-bold">Jumlah</td>
														        <td class="uang jumlah"><?= $total_kategori_1 ?></td>
														      </tr>
														      <?php
													    	}
													    ?>
												      
												      <?php
												      	$total_kategori_2 = 0;
												      	if($hspk->getTaSshHspks()->where(['Kategori'=>'2'])->count() > 0){
												        	?>
											        		<tr><!-- kategori 2 -->
														        <td></td>
														        <td class="kategori_pekerjaan">Bahan/Material:</td>
														        <td></td>
														        <td></td>
														        <td></td>
														        <td></td>
														      </tr>
												        	<?php
													        $ssh = $hspk->getTaSshHspks()->where(['Kategori'=>'2'])->all();
													        foreach ($ssh as $key => $value) :
													          $nomor=$value->Kd_Ssh1.".".$value->Kd_Ssh2.".".$value->Kd_Ssh3.".".$value->Kd_Ssh4.".".$value->Kd_Ssh5.".".$value->Kd_Ssh6;
													          $total_kategori_2+=$value->Harga;
													          $nama_barang='';

													          if (isset($value->kdSsh1->Nama_Barang)) {
													          	$nama_barang=$value->kdSsh1->Nama_Barang;
													          }
													          $Koefisien = $value->Koefisien;
																		$Uraian = $value->kdSatuan->Uraian;
																		$Harga_Satuan = $value->Harga_Satuan;
																		$Harga = $value->Harga;
													          ?>
													            <tr><!-- tambah ssh -->
													              <td><?= $nomor ?></td>
													              <td><?= $nama_barang ?></td>
													              <td><?= $Koefisien ?></td>
													              <td><?= $Uraian ?></td>
													              <td class="uang"><?= $Harga_Satuan ?></td>
													              <td class="uang"><?= $Harga ?></td>
													            </tr>
													          <?php
													        endforeach;
													        $total_semua+=$total_kategori_2;
													      ?>
													      <tr><!-- jumlah ssh -->
													        <td></td>
													        <td></td>
													        <td></td>
													        <td></td>
													        <td class="text-right text-bold">Jumlah</td>
													        <td class="uang jumlah"><?= $total_kategori_2 ?></td>
													      </tr>
													      <?php
													    	}
													    ?>
												      
												      <?php
												      	$total_kategori_3 = 0;
												      	if($hspk->getTaSshHspks()->where(['Kategori'=>'3'])->count() > 0){
												        	?>
												        	<tr><!-- kategori 2 -->
														        <td></td>
														        <td class="kategori_pekerjaan">Sewa Peralatan:</td>
														        <td></td>
														        <td></td>
														        <td></td>
														        <td></td>
														      </tr>
												        	<?php
													        $ssh = $hspk->getTaSshHspks()->where(['Kategori'=>'3'])->all();
													        foreach ($ssh as $key => $value) :
													          $nomor=$value->Kd_Ssh1.".".$value->Kd_Ssh2.".".$value->Kd_Ssh3.".".$value->Kd_Ssh4.".".$value->Kd_Ssh5.".".$value->Kd_Ssh6;
													          $total_kategori_3+=$value->Harga;
													          $nama_barang='';

													          if (isset($value->kdSsh1->Nama_Barang)) {
													          	$nama_barang=$value->kdSsh1->Nama_Barang;
													          }
													          $Koefisien = $value->Koefisien;
																		$Uraian = $value->kdSatuan->Uraian;
																		$Harga_Satuan = $value->Harga_Satuan;
																		$Harga = $value->Harga;
													          ?>
													            <tr><!-- tambah ssh -->
													              <td><?= $nomor ?></td>
													              <td><?= $nama_barang ?></td>
													              <td><?= $Koefisien ?></td>
													              <td><?= $Uraian ?></td>
													              <td class="uang"><?= $Harga_Satuan ?></td>
													              <td class="uang"><?= $Harga ?></td>
													            </tr>
													          <?php
													        endforeach;
													        $total_semua+=$total_kategori_3;
													      ?>
													      <tr>
													        <td></td>
													        <td></td>
													        <td></td>
													        <td></td>
													        <td class="text-right text-bold">Jumlah</td>
													        <td class="uang jumlah"><?= $total_kategori_3 ?></td>
													      </tr>
													      <?php
													    	}
													    ?>
												      <tr class="akhir"> <!-- toal akhir semua jumlah -->
												        <td></td>
												        <td></td>
												        <td></td>
												        <td></td>
												        <td class="text-right text-bold">Nilai HSPK</td>
												        <td class="uang jumlah"><?= $total_semua ?></td>
												      </tr>
															<!-- batas html hspk 4-->
									      		<?php
									      	endforeach;
									      ?>
												<!-- batas html hspk 3-->
						      		<?php
						      	endforeach;
						      ?>
									<!-- batas html hspk 2-->
			      		<?php
			      	endforeach;
			      ?>
						<!-- batas html hspk 1-->
      		<?php
      	endforeach;
      ?>
    </tbody>
  </table>
</div>

</body>
</html>