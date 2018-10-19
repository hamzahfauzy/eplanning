<?php include"header.php"; ?>
<div class="row">
	<h2><i class="fa fa-book"></i> Kamus Usulan</h2>
</div>
						<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<th style="text-align:center">Uraian</th>
										<th style="text-align:center">Definisi Operasional</th>
										<th style="text-align:center">Harga <br>(Rp.)</th>
										<th style="text-align:center">Satuan</th>
										<th style="text-align:center">OPD Penanggung Jawab</th>
										<th style="text-align:center">Tipe</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;
								foreach($kamus as $rows):
									$tipe = ($rows['tipe'] == 1) ? "Fisik" : "Non-Fisik";
								?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$rows['nama_kamus'];?></td>
										<td><?=$rows['Defenisi_Operasional'];?></td>
										<td align="right"><?=number_format($rows['harga_kamus']);?></td>
										<td><?=$satuan($rows['satuan_kamus']);?></td>
										<td><?=@$opd($rows['SKPD']);?></td>
										<td><?=$tipe;?></td>
									</tr>
								<?php $no++; endforeach; ?>
								</tbody>
							</table>
				<script src="/kamususulan/views/js/jquery.js"></script>
				<script src="/kamususulan/views/js/datatables.js"></script>
				<script src="/kamususulan/views/js/bootstrap.datatables.js"></script>
				<script>
					$('#example').DataTable();
				</script>
<?php include"footer.php"; ?>