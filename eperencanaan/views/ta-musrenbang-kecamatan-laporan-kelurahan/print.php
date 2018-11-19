<table class="">
    <tr><td>Digolongkan berdasarkan</td><td> </td><td> </td></tr>
    <tr><td>Kelurahan</td><td>:</td><td><?= $kelurahan ?></td></tr>
    <tr><td>Prioritas Bidang</td><td>:</td><td><?= $bid_pem ?></td></tr>
    <tr><td>Kata Kunci</td><td>:</td><td><?= $kata_kunci ?></td></tr>
</table>
<table class="table table-bordered data-table tabel-data">
    <thead>
        <tr >
              <th>
                    No
                </th>

                <th>
                    Kegiatan Prioritas
                </th>

                <th>
                    Kriteria 1
                </th>

                <th>
                    Kriteria 2
                </th>

                <th>
                    Kriteria 3
                </th>

                <th>
                    Kriteria 4
                </th>

                <th>
                    Kriteria 5
                </th>

                <th>
                    Kriteria 6
                </th>
                <th>
                    Kriteria 7
                </th>

                <th>
                   Kriteria 8
                </th>

                <th>
                    Total SKOR
                </th>
        </tr>
    </thead>
    <tbody id="body-tabel">
      <?php
$no = 1;

    foreach ($NASUsulan as $value) : ?>
        <tr><td><?php echo $no++;?></td>
            <td><b>Permasalahan:</b><br/>
                <p><?php echo $value->Nm_Permasalahan;?></p>
                <b>Usulan:</b>
                <p><?php echo $value->Jenis_Usulan;?></p>
            (<?php echo  $value->kdPem->Bidang_Pembangunan;?>) </td>
            <td> <!-- 1 --> </td>
            <td> <!-- 2 --> </td>
            <td> <!-- 3 --></td>
            <td> <!-- 4 --></td>
            <td> <!-- 5 --></td> 
            <td><!-- 6 --></td>
            <td> <!-- 7 --> </td>
            <td><!-- 8 --> </td>
            <td> <!-- Total -->  </td>
            <tr>
                  
<?php endforeach;?>
    </tbody>
</table>

<!-- <table>
    <tr><td><p color="red">*)</p></td><td>Keterangan nomor prioritas pembangunan daerah</td></tr>
    <?php $no = 1;foreach ($rpjmd as $data) : ?>
    <tr><td><?= $no++; ?>.</td><td><?= $data->Nm_Prioritas_Pembangunan_Kota ?></td></tr>
    <?php                endforeach; ?>
</table> -->