
<div class="box-header with-border">
 	<div class="col-md-1"></div><div class="col-md-10"  style="text-align:center;"><h3>Rekapitulasi Hasil Evaluasi Pelaksanaan Renja  OPD sampai dengan Tahun Berjalan <br> Kabupaten/Kota *) ………………  </h3></div><div class="col-md-1"></div>
	<br>
  <div class="col-xs-12">Nama SKPD : .....</div>
	<div class="col-xs-12">
		<table class="table table-bordered table-striped">
			<thead>
    			<tr>
                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Kode</th>
                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan </th>
                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Indikator  Kinerja Program (outcome)/ Kegiatan (output)</th>
                    <th style="text-align:center;vertical-align:middle;" rowspan="2">target capaian kinerja Renstra OPD Tahun ........ (akhir periode Renstra OPD)</th>
                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Realisasi target kinerja hasil program dan keluaran kegiatan s/d tahun ......  (tahun n-3) </th>
                    <th style="text-align:center;vertical-align:middle;" colspan="3">Target dan realisasi kinerja program dan keluaran kegiatan OPD tahun ....... (tahun lalu /n-2) </th>
                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Target program / kegiatan  Renja  OPD tahun berjalan (tahun n-1) </th>
                    <th style="text-align:center;vertical-align:middle;" colspan="2">Perkiraan realisasi capaian target program/kegiatan Renstra OPD s/d dengan tahun ..... ... (tahun berjalan/n-1)</th>
                    <th style="text-align:center;vertical-align:middle;" rowspan="2">Catatan</th>
    			</tr>
                <tr>
                    <td style="text-align:center;vertical-align:middle;">Target</td>
                    <td style="text-align:center;vertical-align:middle;">Realisasi</td>
                    <td style="text-align:center;vertical-align:middle;">Tingkat Realisasi (%)</td>
                    <td style="text-align:center;vertical-align:middle;">Realisasi Capaian</td>
                    <td style="text-align:center;vertical-align:middle;">Tingkat capaian (%)</td>
                </tr>
			</thead>
			<tbody>
				<tr>
					<?php for($i=1;$i<=12;$i++): ?>
					<td style="text-align:center;"><?= $i==8 ? $i.'(7/6)' : ($i==10 ? $i.'(5+7+9)*' : ($i==11 ? $i.'*' : $i)) ?></td>
					<?php endfor; ?>
				</tr>
			</tbody>
		</table>
	</div>
</div>