<table width="100%">
	<?php
	//====================infrastruktur=========================//
	$nama_bidang = 'Infrastruktur';
	$batas = 8; //jlh data per halaman
	$jlh_data = $data_infrastruktur->count();
	$jlh_hal = ceil($jlh_data/$batas);
	$no=0;
	for($hal=1; $hal<=$jlh_hal; $hal++):
		?>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td align="center">
								<h1>Usulan Prioritas</h1>
								<h2>Kecamatan <?= $Nm_Kec?></h2>
							</td>
						</tr>
					</table>
					<table class="table table-bordered">
						<thead>
							<tr>
								<td colspan="11"><?= $nama_bidang  ?></td>
							</tr>
							<tr>
								<th>No</th>
								<th>Asal Usulan</th>
								<th>Kegiatan Prioritas</th>
								<th>Kelurahan</th>
								<th>Lingkungan</th>
								<th>Jalan</th>
								<th>Jumlah/vol</th>
								<th>Pagu (Rp)</th>
								<th>SKPD Penanggung Jawab</th>
								<th>Prioritas Pembangunan</th>
								<th>Bobot</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$limit = $batas;
								$offset = $hal-1*$batas;
								$lihat_infrastruktur = $data_infrastruktur //ambil data infrastruktur dengan pembatasan
																			->limit($limit)
																			->offset($offset)
																			->all();
								foreach ($lihat_infrastruktur as $key => $val) :
									$no++;
									if ($val->Kd_Jalan)
										$jalan = $val->kdJalan->Nm_Jalan;
									else
										$jalan = '';

									if($val->Kd_Prioritas_Pembangunan_Daerah)
										$rpjmd_pilih = $val->rpjmd->Nm_Prioritas_Pembangunan_Kota;
									else
										$rpjmd_pilih = 'Non Prioritas';

									if ($val->Kd_Asal_Usulan == 1) {
										$asal_usulan = "Lingkungan";
									}
									else if ($val->Kd_Asal_Usulan == 2) {
										$asal_usulan = "Kelurahan";
									}
									else if ($val->Kd_Asal_Usulan == 3) {
										$asal_usulan = "Kecamatan";
									}
									else {
										$asal_usulan = "Tidak Ditemukan";
									}

									//$val->Status_Penerimaan_Kecamatan
									
								?>
									<tr>
										<td>
											<?= $no ?>
										</td>
										<td>
											<?= $asal_usulan ?>
										</td>
										<td>
											<b>Permasalahan:</b><br/>
									    <p><?= $val->Nm_Permasalahan ?></p>
									    <b>Usulan:</b>
									    <p><?= $val->Jenis_Usulan ?></p>
										</td>
									  <td>
									  	<?php if($val->Kd_Kel) echo $val->kelurahan->Nm_Kel ?>
									  </td>
									  <td>
									  	<?php if($val->Kd_Lingkungan) echo $val->lingkungan->Nm_Lingkungan ?>
									  </td>
									  <td>
									  	<?php if ($val->Kd_Jalan) echo $val->kdJalan->Nm_Jalan ?> <br/>
									  	<?= $val->Detail_Lokasi ?>
									  </td>
										<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
										<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
										<td align='center'>
									    	<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo $val->refSubUnit->Nm_Sub_Unit ?>
										</td>
										<td align="center">
									    	<?= $rpjmd_pilih ?>
										</td>
										<td align="center">
												<?php if($val->Skor != null) echo $val->Skor ?>
										</td>
									</tr>
								<?php
								endforeach;
							?>
						</tbody>
					</table>
				</td>
			</tr>
		<?php
	endfor;
	//====================SOSBUD=========================//
	$nama_bidang = 'Sosbud';
	$batas = 8; //jlh data per halaman
	$jlh_data = $data_sosbud->count();
	$jlh_hal = ceil($jlh_data/$batas);
	$no=0;
	for($hal=1; $hal<=$jlh_hal; $hal++):
		?>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td align="center">
								<h1>Usulan Prioritas</h1>
								<h2>Kecamatan <?= $Nm_Kec?></h2>
							</td>
						</tr>
					</table>
					<table class="table table-bordered">
						<thead>
							<tr>
								<td colspan="11"><?= $nama_bidang  ?></td>
							</tr>
							<tr>
								<th>No</th>
								<th>Asal Usulan</th>
								<th>Kegiatan Prioritas</th>
								<th>Kelurahan</th>
								<th>Lingkungan</th>
								<th>Jalan</th>
								<th>Jumlah/vol</th>
								<th>Pagu (Rp)</th>
								<th>SKPD Penanggung Jawab</th>
								<th>Prioritas Pembangunan</th>
								<th>Bobot</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$limit = $batas;
								$offset = $hal-1*$batas;
								$lihat_sosbud = $data_sosbud //ambil data infrastruktur dengan pembatasan
																			->limit($limit)
																			->offset($offset)
																			->all();
								foreach ($lihat_sosbud as $key => $val) :
									$no++;
									if ($val->Kd_Jalan)
										$jalan = $val->kdJalan->Nm_Jalan;
									else
										$jalan = '';

									if($val->Kd_Prioritas_Pembangunan_Daerah)
										$rpjmd_pilih = $val->rpjmd->Nm_Prioritas_Pembangunan_Kota;
									else
										$rpjmd_pilih = 'Non Prioritas';

									if ($val->Kd_Asal_Usulan == 1) {
										$asal_usulan = "Lingkungan";
									}
									else if ($val->Kd_Asal_Usulan == 2) {
										$asal_usulan = "Kelurahan";
									}
									else if ($val->Kd_Asal_Usulan == 3) {
										$asal_usulan = "Kecamatan";
									}
									else {
										$asal_usulan = "Tidak Ditemukan";
									}

									//$val->Status_Penerimaan_Kecamatan
									
								?>
									<tr>
										<td>
											<?= $no ?>
										</td>
										<td>
											<?= $asal_usulan ?>
										</td>
										<td>
											<b>Permasalahan:</b><br/>
									    <p><?= $val->Nm_Permasalahan ?></p>
									    <b>Usulan:</b>
									    <p><?= $val->Jenis_Usulan ?></p>
										</td>
									  <td>
									  	<?php if($val->Kd_Kel) echo $val->kelurahan->Nm_Kel ?>
									  </td>
									  <td>
									  	<?php if($val->Kd_Lingkungan) echo $val->lingkungan->Nm_Lingkungan ?>
									  </td>
									  <td>
									  	<?php if ($val->Kd_Jalan) echo $val->kdJalan->Nm_Jalan ?> <br/>
									  	<?= $val->Detail_Lokasi ?>
									  </td>
										<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
										<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
										<td align='center'>
									    	<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo $val->refSubUnit->Nm_Sub_Unit ?>
										</td>
										<td align="center">
									    	<?= $rpjmd_pilih ?>
										</td>
										<td align="center">
												<?php if($val->Skor != null) echo $val->Skor ?>
										</td>
									</tr>
								<?php
								endforeach;
							?>
						</tbody>
					</table>
				</td>
			</tr>
		<?php
	endfor;
	//====================EKONOMI=========================//
	$nama_bidang = 'Ekonomi';
	$batas = 8; //jlh data per halaman
	$jlh_data = $data_ekonomi->count();
	$jlh_hal = ceil($jlh_data/$batas);
	$no=0;
	for($hal=1; $hal<=$jlh_hal; $hal++):
		?>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td align="center">
								<h1>Usulan Prioritas</h1>
								<h2>Kecamatan <?= $Nm_Kec?></h2>
							</td>
						</tr>
					</table>
					<table class="table table-bordered">
						<thead>
							<tr>
								<td colspan="11"><?= $nama_bidang  ?></td>
							</tr>
							<tr>
								<th>No</th>
								<th>Asal Usulan</th>
								<th>Kegiatan Prioritas</th>
								<th>Kelurahan</th>
								<th>Lingkungan</th>
								<th>Jalan</th>
								<th>Jumlah/vol</th>
								<th>Pagu (Rp)</th>
								<th>SKPD Penanggung Jawab</th>
								<th>Prioritas Pembangunan</th>
								<th>Bobot</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$limit = $batas;
								$offset = $hal-1*$batas;
								$lihat_ekonomi = $data_ekonomi //ambil data infrastruktur dengan pembatasan
																			->limit($limit)
																			->offset($offset)
																			->all();
								foreach ($lihat_ekonomi as $key => $val) :
									$no++;
									if ($val->Kd_Jalan)
										$jalan = $val->kdJalan->Nm_Jalan;
									else
										$jalan = '';

									if($val->Kd_Prioritas_Pembangunan_Daerah)
										$rpjmd_pilih = $val->rpjmd->Nm_Prioritas_Pembangunan_Kota;
									else
										$rpjmd_pilih = 'Non Prioritas';

									if ($val->Kd_Asal_Usulan == 1) {
										$asal_usulan = "Lingkungan";
									}
									else if ($val->Kd_Asal_Usulan == 2) {
										$asal_usulan = "Kelurahan";
									}
									else if ($val->Kd_Asal_Usulan == 3) {
										$asal_usulan = "Kecamatan";
									}
									else {
										$asal_usulan = "Tidak Ditemukan";
									}

									//$val->Status_Penerimaan_Kecamatan
									
								?>
									<tr>
										<td>
											<?= $no ?>
										</td>
										<td>
											<?= $asal_usulan ?>
										</td>
										<td>
											<b>Permasalahan:</b><br/>
									    <p><?= $val->Nm_Permasalahan ?></p>
									    <b>Usulan:</b>
									    <p><?= $val->Jenis_Usulan ?></p>
										</td>
									  <td>
									  	<?php if($val->Kd_Kel) echo $val->kelurahan->Nm_Kel ?>
									  </td>
									  <td>
									  	<?php if($val->Kd_Lingkungan) echo $val->lingkungan->Nm_Lingkungan ?>
									  </td>
									  <td>
									  	<?php if ($val->Kd_Jalan) echo $val->kdJalan->Nm_Jalan ?> <br/>
									  	<?= $val->Detail_Lokasi ?>
									  </td>
										<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
										<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
										<td align='center'>
									    	<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo $val->refSubUnit->Nm_Sub_Unit ?>
										</td>
										<td align="center">
									    	<?= $rpjmd_pilih ?>
										</td>
										<td align="center">
												<?php if($val->Skor != null) echo $val->Skor ?>
										</td>
									</tr>
								<?php
								endforeach;
							?>
						</tbody>
					</table>
				</td>
			</tr>
		<?php
	endfor;
	?>
</table>