
        <table class="table table-bordered">
            <caption>
                <h3 class="box-tilte" style="text-align: center;">Kajian Usulan Program dan Kegiatan dari <?= $kelompok['Kab'] ?> Tahun <?= $tahun ?> <br> Provinsi <?= $kelompok['Prov'] ?></h3>
                <h5><strong>Nama OPD : <?= $subunit->Nm_Sub_Unit ?></strong></h5>
            </caption>
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