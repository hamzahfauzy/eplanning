<?php
  $filename = 'Data-'.Date('YmdGis').'-Usulan_Kelurahan.xls';
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=".$filename);
?>
<div class="col-md-12">
	<div class="portlet box blue-hoki">
        <div class="portlet-title">
			  <div class="portlet-body">
				<table class="table table-bordered">
					<thead>
						<tr>

						<th></th>
						<th>Usulan Musrenbang Kabupaten</th>
						<th></th>
						
						</tr>
						
						<tr>
							<th class="vcenter text-center">No</th>
							<th class="vcenter text-center">Program</th>
							<th class="vcenter text-center">Kegiatan</th>
							<th class="vcenter text-center">Rincian Obyek</th>
							<th class="vcenter text-center">Volume</th>
							<th class="vcenter text-center">Satuan</th>
							<th class="text-right">Biaya</th>
							<th class="vcenter text-center">Asal Usulan</th>
						</tr>
					</thead>
					<tbody id="isi-wrap">

					
					<?php 

						$no=1;
						foreach ($modelBelanja as $value) : 
					?>

					<tr>
						<td><?= $no++ ?></td>
						<td><?= $value->refProgram['Ket_Program']; ?></td>
						<td><?= $value->kegiatan['Ket_Kegiatan']; ?></td>
						<td><?= $value['Keterangan'] ?></td>
						<td><?= $value['Jml_Satuan']?></td>
						<td><?= $value['Satuan123']?></td>
						<td><?= number_format($value['Total'],0, ',', '.')?>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div>