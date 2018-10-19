
<div class="box-header with-border">
 	<div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Penggabungan Prioritas Kabupaten/Kota dengan<br>Rancangan Renja OPD <?=$unit->kdUnit->Nm_Unit?> Provinsi <?=$kelompok->kdProv->Nm_Prov?></h3></div><div class="col-md-1"></div>
	<br>
	<div class="col-xs-12"><h3>Nama OPD : <?=$unit->kdUnit->Nm_Unit?></h3></div>
	<div class="col-xs-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th rowspan="2" style="vertical-align:middle;text-align:center;">No</th>
					<th colspan="5" style="vertical-align:middle;text-align:center;">Rancangan Kerja</th>
					<th colspan="5" style="vertical-align:middle;text-align:center;">Hasil Prioritas Kabupaten/ Kota</th>
					<th rowspan="2" style="vertical-align:middle;text-align:center;">Catatan Penting</th>
				</tr>
				<tr>
    				<th style="text-align:center;">Program/ Kegiatan</th>
    				<th style="text-align:center;">Lokasi</th>
    				<th style="text-align:center;">Indikator Kerja</th>
    				<th style="text-align:center;">Target Capaian</th>
    				<th style="text-align:center;">Pagu Indikatif (Rp.000)</th>
    				<th style="text-align:center;">Program/ Kegiatan</th>
    				<th style="text-align:center;">Lokasi</th>
    				<th style="text-align:center;">Indikator Kerja</th>
    				<th style="text-align:center;">Target Capaian</th>
    				<th style="text-align:center;">Pagu Indikatif (Rp.000)</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php for($i=1;$i<=12;$i++): ?>
					<td style="text-align:center;">(<?=$i?>)</td>
					<?php endfor; ?>
				</tr>
				<tr>
					<?php for($i=1;$i<=12;$i++): ?>
					<td></td>
					<?php endfor; ?>
				</tr>
			</tbody>
		</table>
	</div>
</div>