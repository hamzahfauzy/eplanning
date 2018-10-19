<div class="box-header with-border">
    <div class="col-xs-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;vertical-align: middle;" rowspan="2">No</th>
                    <th style="text-align:center;vertical-align: middle;" rowspan="2">Prioritas Pembangunan Nasional</th>
                    <th style="text-align:center;vertical-align: middle;" colspan="2">Uraian</th>
                    <th style="text-align:center;vertical-align: middle;" colspan="3">Alokasi Anggaran Belanja dalam Rancangan APBD</th>
                </tr>
                <tr>
                    <th style="text-align:center;vertical-align: middle;">Program</th>
                    <th style="text-align:center;vertical-align: middle;">Belanja, Pegawai, Bunga, Subsidi, Hibah, Sosial, Bagi, Hasil, Bantuan, Keuangan, Belanja Tidak Terduga</th>
                    <th style="text-align:center;vertical-align: middle;">Program m (Rp)</th>
                    <th style="text-align:center;vertical-align: middle;">Belanja, Pegawai, Bunga, Subsidi, Hibah, Sosial, Bagi, Hasil, Bantuan, Keuangan, Belanja Tidak Terduga (Rp)</th>
                    <th style="text-align:center;vertical-align: middle;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php for($i=1;$i<=7;$i++): ?>
                    <td style="text-align:center;"><?= ($i==7) ? $i.'=5+6' : $i ?></td>
                    <?php endfor; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>