<div class="box-header with-border">
    <div class="col-xs-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="text-align:center;vertical-align: middle;" rowspan="2">No</th>
                    <th style="text-align:center;vertical-align: middle;" rowspan="2">Prioritas Provinsi</th>
                    <th style="text-align:center;vertical-align: middle;" colspan="2">Anggaran Belanja dalam Rancangan APBD</th>
                    <th style="text-align:center;vertical-align: middle;" rowspan="2">Jumlah</th>
                </tr>
                <tr>
                    <th style="text-align:center;vertical-align: middle;">Belanja Langsung</th>
                    <th style="text-align:center;vertical-align: middle;">Belanja Tidak Langsung</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php for($i=1;$i<=5;$i++): ?>
                    <td style="text-align:center;"><?= ($i==7) ? $i.'=3+4' : $i ?></td>
                    <?php endfor; ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>