<?php
  $filename = 'Data-'.Date('YmdGis').'-Usulan_Kelurahan.xls';
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=".$filename);
?>
<div class="col-md-12">
	<div class="portlet box blue-hoki">
        <div class="portlet-title">
			  <div class="portlet-body">
				<table class="table table-bordered" border="1">
					<thead>
						<tr>
							<th class="vcenter text-center">No</th>
							<th class="vcenter text-center">Program</th>
							<th class="vcenter text-center">Kegiatan</th>
							<th class="vcenter text-center">Rincian Obyek</th>
							<th class="vcenter text-center">Volume</th>
							<th class="vcenter text-center">Satuan</th>
							<th class="text-right">Biaya</th>
							<!-- <th class="vcenter text-center">Asal Usulan</th> -->
						</tr>

					   <tr>
	                        <th class="text-center">(1)</th>
	                        <th class="text-center">(2)</th>
	                        <th class="text-center">(3)</th>
	                        <th class="text-center">(4)</th>
	                        <th class="text-center">(5)</th>
	                        <th class="text-center">(6)</th>
	                      	<th class="text-center">(7)</th>
	                    </tr>
					</thead>
					<tbody id="isi-wrap">
						<?php 

							$no=1;
							foreach ($modelBelanja as $value) : 
						?>

						<?php 

						if ($value['Ref_Usulan_Rincian'] == 1) {
							
							$asal = "Musrenbang Kecamatan";
						}
						?>

						<tr>
							<td><?= $no++ ?></td>
							<td><?= $value->refProgram['Ket_Program']; ?></td>
							<td><?= $value->kegiatan['Ket_Kegiatan']; ?></td>
							<td><?= $value['Keterangan'] ?></td>
							<td><?= $value['Jml_Satuan']?></td>
							<td><?= $value['Satuan123']?></td>
							<td style="text-align:right;"><?= number_format($value['Total'],0, ',', '.')?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div>