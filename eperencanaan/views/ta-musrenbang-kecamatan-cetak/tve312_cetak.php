<table class="">
    <tr><td>Digolongkan berdasarkan</td><td> </td><td> </td></tr>
    <tr><td>Kelurahan</td><td>:</td><td><?= $kelurahan ?></td></tr>
    <tr><td>Prioritas Bidang</td><td>:</td><td><?= $bid_pem ?></td></tr>
   
</table>
<table class="table table-bordered data-table tabel-data">
    <thead>
        <tr >
            <th style="vertical-align: middle">
                No
            </th>
            <th style="vertical-align: middle">
                Kegiatan
            </th>
            <th style="vertical-align: middle">
                Lokasi Kelurahan
            </th>
            
            <th style="vertical-align: middle">
                Keseusaian Dengan Prioritas Daerah Ke..
            </th>
            <th style="vertical-align: middle">
                Status Usulan
            </th>

        </tr>
    </thead>
    <tbody id="body-tabel">
        <?php
        $no = 1;
        foreach ($usulan as $value) :
            ?>
            <tr><<td><?php echo $no++; ?></td>
                <td><?php echo $value->Nm_Permasalahan; ?></td>
                <td><?php echo $value->kelurahan->Nm_Kel; ?> </td>
                <td><?php if($value->Kd_Prioritas_Pembangunan_Daerah) echo $value->rpjmd->Nm_Prioritas_Pembangunan_Kota; ?> </td>
                <td>0</td>

          </tr>

<?php endforeach; ?>

    </tbody>
</table>

