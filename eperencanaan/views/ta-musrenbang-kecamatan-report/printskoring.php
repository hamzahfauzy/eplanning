<table class="">
    <tr><td>Digolongkan berdasarkan</td><td> </td><td> </td></tr>
    <tr><td>Kelurahan</td><td>:</td><td><?= $kelurahan ?></td></tr>
    <tr><td>Prioritas Bidang</td><td>:</td><td><?= $bid_pem ?></td></tr>
    <tr><td>Kata Kunci</td><td>:</td><td><?= $kata_kunci ?></td></tr>
</table>
<table class="table table-bordered data-table tabel-data">
    <thead>
        <tr >
            <th style="vertical-align: middle">
                No
            </th>

            <th style="vertical-align: middle">
                Prioritas Kota (1,2,3,4,5,6,7,8)<p color="red">*</p>
            </th>

            <th style="vertical-align: middle">
                Sasaran Daerah
            </th>

            <th style="vertical-align: middle">
                Program
            </th>

            <th style="vertical-align: middle">
                Kegiatan Prioritas
            </th>

            <th style="vertical-align: middle">
                Sasaran Kegiatan
            </th>

            <th style="vertical-align: middle">
                Kelurahan
            </th>
            
            <th style="vertical-align: middle">
                Jumlah/vol
            </th>

            <!-- <th style="vertical-align: middle">
                Biaya (Rp)
            </th> -->

            <th style="vertical-align: middle">
                Pagu Indikatif
            </th>

            <th style="vertical-align: middle">
                SKPD Penanggung Jawab
            </th>
           

        </tr>
    </thead>
    <tbody id="body-tabel">
      <!--   <?php
        $no = 1;
        foreach ($ZULusulan as $value) :
       
            ?>
            <tr><td><?php echo $no++; ?></td>
                <td><p><?php //ISI DISINI NAMA KELURAHANNYA?></p>
                    (Kode Usulan: <?php echo $value->Kd_Ta_Musrenbang_Kelurahan; ?>)</td>
                <td> <b>Permasalahan:</b><br/>
                    <p><?php echo $value->Nm_Permasalahan ?></p>
                    <b>Usulan:</b>
                    <p><?php echo $value->Jenis_Usulan ?></p>
                    (<?php echo $value->kdPem->Bidang_Pembangunan ?>)
                </td>
                <td><?php echo ($value->Jumlah . ' ' . $value->kdSatuan->Uraian) ?></td>
                <td><?php echo $value->Harga_Total ?></td>
                <td><?php echo $value->Detail_Lokasi ?></td>
                <td> </td>
                <td> </td>
                <td> </td>


            </tr>

<?php endforeach; ?> -->

    </tbody>
</table>

<table>
    <tr><td><p color="red">*)</p></td><td>Keterangan nomor prioritas pembangunan daerah</td></tr>
    <?php $no = 1;foreach ($rpjmd as $data) : ?>
    <tr><td><?= $no++; ?>.</td><td><?= $data->Nm_Prioritas_Pembangunan_Kota ?></td></tr>
    <?php                endforeach; ?>
</table>