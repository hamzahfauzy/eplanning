<?php 
    $no = 0;
    foreach ($data as $val):
    $no++;
	?>
        <tr>
            <td><?=$no?></td>
            <td>
                <b>Permasalahan:</b><br/>
                <p><?= $val->Nm_Permasalahan ?></p>
                <b>Usulan:</b>
                <p><?= $val->Jenis_Usulan ?></p>
                (<?= $val->bidangPembangunan->Bidang_Pembangunan ?>)
            </td>
            <td>
                <b>Kelurahan:</b><br/>
                <p><?php if($val->Kd_Kel) echo $val->kelurahan->Nm_Kel ?></p>
                <b>Lingkungan:</b>
                <p><?php if($val->Kd_Lingkungan) echo $val->lingkungan->Nm_Lingkungan ?></p>
                <b>Jalan:</b>
                <p><?php if ($val->Kd_Jalan) echo $val->kdJalan->Nm_Jalan ?></p>
                <b>Detail Lokasi:</b>
                <p><?= $val->Detail_Lokasi ?></p>
            </td>
            <td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
            <td><?= $val->Alasan_Kecamatan; ?></td>
        </tr>
	<?php
	endforeach; 
?>