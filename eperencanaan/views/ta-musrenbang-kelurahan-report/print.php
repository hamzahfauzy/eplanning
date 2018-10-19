<?php
use yii\helpers\Html;
    
$PC_Kelompok = Yii::$app->levelcomponent->getKelompok();

$daftar_kode='';

$a=0;
foreach ($rpjmd as $datar){
    $a++;
    if ($a>1) {
        $daftar_kode=',';
    }
    $Kd_Prioritas_Pembangunan_Kota = $datar->Kd_Prioritas_Pembangunan_Kota;
    $daftar_kode .= $Kd_Prioritas_Pembangunan_Kota;
}

?>
<table class="">
    <tr><td>Digolongkan berdasarkan</td><td> </td><td> </td></tr>
    <tr><td>Kelurahan</td><td>:</td><td><?= $PC_Kelompok->kdKel->Nm_Kel ?></td></tr>
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
                Lingkungan
            </th>
            <th style="vertical-align: middle">
                Usulan
            </th>
            <th style="vertical-align: middle">
                Jumlah/vol
            </th>
            <th style="vertical-align: middle">
                Biaya (Rp)
            </th>
            <th style="vertical-align: middle">
                Lokasi
            </th>
            <th style="vertical-align: middle">
                Prioritas Pembangunan (<?= $daftar_kode ?>)<p color="red">*</p>
            </th>
            <th style="vertical-align: middle">
                Status Penerimaan
            </th>
            <th style="vertical-align: middle">
                Keterangan Penerimaan
            </th>

        </tr>
    </thead>
    <tbody id="body-tabel">
        <?php
        $no = 1;
        foreach ($ZULusulan as $value) :
            ?>
            <tr><td><?php echo $no++; ?></td>
                <td><p><?php echo $value->kdLink->Nm_Lingkungan; ?></p>
                    (Kode Usulan: <?php echo $value->Kd_Ta_Forum_Lingkungan; ?>)</td>
                <td> <b>Permasalahan:</b><br/>
                    <p><?php echo $value->Nm_Permasalahan ?></p>
                    <b>Usulan:</b>
                    <p><?php echo $value->Jenis_Usulan ?></p>
                    (<?php echo $value->kdPem->Bidang_Pembangunan ?>)
                </td>
                <td><?php echo ($value->Jumlah . ' ' . $value->kdSatuan->Uraian) ?></td>
                <td style="text-align: right;"><?= number_format( $value->Harga_Total,0, ',', '.') ?></td>
                <td><?php echo $value->Detail_Lokasi ?></td>
                <td> </td>
                <td> </td>
                <td> </td>


            </tr>

<?php endforeach; ?>

    </tbody>
</table>

<table>
    <tr><td><p color="red">*)</p></td><td>Keterangan nomor prioritas pembangunan daerah</td></tr>
    <?php $no = 1;foreach ($rpjmd as $data) : ?>
    <tr><td><?= $no++; ?>.</td><td><?= $data->Nm_Prioritas_Pembangunan_Kota ?></td></tr>
    <?php                endforeach; ?>
</table>