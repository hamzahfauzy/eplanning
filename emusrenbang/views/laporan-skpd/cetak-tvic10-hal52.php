<div class="box-header with-border">
 	<div class="col-md-1"></div>
    <div class="col-md-10" style="text-align:center;">
        <h3>Daftar Kegiatan Lintas OPD dan Lintas Wilayah <br> OPD <?= $subunit->Nm_Sub_Unit ?>, Tahun <?= date('Y') ?> </h3>
    </div>
    <div class="col-md-1"></div>
	<br>
	<div class="col-xs-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
                    <th></th>
                    <th style="text-align:center;vertical-align:center;">NO </th>
                    <th style="text-align:center;vertical-align:center;">Kegiatan </th>
                    <th style="text-align:center;vertical-align:center;">Lokasi </th>
                    <th style="text-align:center;vertical-align:center;">Volume </th>
                    <th style="text-align:center;vertical-align:center;">Alasan </th>
				</tr>
			</thead>
			<tbody>
                <tr>
                <?php for ($i=1; $i <=6 ; $i++): ?>
                    <td style="text-align:center;vertical-align:center;">(<?= $i ?>)</td>

                <?php endfor; ?>
                </tr>
			</tbody>
		</table>
	</div>
</div>