<table class="">
    <tr><td>Digolongkan berdasarkan</td><td> </td><td> </td></tr>
    <tr><td>Prioritas Bidang</td><td>:</td><td><?= "" ?></td></tr>
    <tr><td>Bidang Pembangunan</td><td>:</td><td><?= $bid_pem ?></td></tr>
    <tr><td>Kata Kunci</td><td>:</td><td><?= $kata_kunci ?></td></tr>
</table>
<table class="table table-bordered data-table tabel-data">
    <thead>
        <tr>
            <th>
                No
            </th>

            <th>
                Usulan
            </th>
            <th>
                Jumlah/vol
            </th>
            <th>
                Biaya (Rp)
            </th>
            <th>
                Lokasi
            </th>
            <th>
                Prioritas Pembangunan
            </th>
            

        </tr>
    </thead>
    <tbody id="body-tabel">
        <?php
        $no = 1;
        foreach ($ZULusulan as $value) :
            ?>
            <tr><td><?php echo $no++; ?></td>
                <!-- <td> </td> -->
                <td> <b>Permasalahan:</b><br/>
                    <p><?php echo $value->Nm_Permasalahan ?></p>
                    <b>Usulan:</b>
                    <p><?php echo $value->Jenis_Usulan ?></p>
                    (<?php echo $value->kdPem->Bidang_Pembangunan ?>)
                </td>
                <td><?php echo ($value->Jumlah . ' ' . $value->kdSatuan->Uraian) ?></td>
                <td><?php echo $value->Harga_Total ?></td>
                <td><?php echo $value->Detail_Lokasi ?></td>
                <td><?php echo $value->tahun->Nm_Prioritas_Pembangunan_Kota ?></td>

            </tr>

<?php endforeach; ?>

    </tbody>
</table>
