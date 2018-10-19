<div class="box-header with-border">
    <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Kajian Usulan Program dan Kegiatan dari Kabupaten Asahan Tahun <?= $Tahun ?> <br> Provinsi <?= $kelompok->kdProv->Nm_Prov ?></h3></div><div class="col-md-1"></div>
    <br>
    <div class="col-xs-12"><h3>Nama OPD : <?= $skpd->Nm_Sub_Unit ?></h3></div>
    <div class="col-xs-12">
        <table class="table table-bordered">
            <thead>
                <tr>
          <th style="text-align:center;">No</th>
                    <th style="text-align:center;">Program/ Kegiatan</th>
                    <th style="text-align:center;">Lokasi</th>
                    <th style="text-align:center;">Indikator Kerja</th>
          <th style="text-align:center;">Besaran/ Volume</th>
                    <th style="text-align:center;">Pagu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php for($i=1;$i<=6;$i++): ?>
                    <td style="text-align:center;">(<?=$i?>)</td>
                    <?php endfor; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>