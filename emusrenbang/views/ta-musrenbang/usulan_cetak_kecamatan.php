<!DOCTYPE html>
<html>
<head> </head>
<body>
<h2 class="judul2" style="text-align: center;">Usulan Musrenbang Kecamatan</h2>
<table class="table table-hover table-bordered">
    <tr>
        <th>No. </th>
        <th>Kecamatan</th>
        th>Desa/Kelurahan</th>
        <th>Dusun/Lk.</th>
        <th>Jalan</th>
        <th>Detail Lokasi</th>
        <th>Permasalahan</th>
        <th>Jenis Usulan</th>
        <th>Volume</th>
        <th>Satuan</th>
        <th>Total</th>
        <th>Prioritas</th>


    </tr>
    <?php 
        $no=0;
        foreach ($data as $key => $value) :
            $no++;  
            $lingkungan = $value->lingkungan == null ? "-" : $value->lingkungan->Nm_Lingkungan;
            $kelurahan = $value->kelurahan == null ? "-" : $value->kelurahan->Nm_Kel;

            if (isset($value->kdJalan->Nm_Jalan))
                    $jalan = $value->kdJalan->Nm_Jalan;
                  else
                    $jalan = '';

            if($value->Status_Prioritas) $stat = 'Prioritas';else $stat = 'Cadangan';
                echo '<tr>
                        <td>'.$no.' </td>     
                        <td>'.$value->kecamatan->Nm_Kec.'</td>
                        <td>'.$kelurahan.'</td>
                        <td>'.$lingkungan.'</td>
                        <td>'.$jalan.' </td>
                        <td>'.$value->Detail_Lokasi.'</td>
                        <td>'.$value->Nm_Permasalahan.'</td>
                        <td>'.$value->Jenis_Usulan.'</td>
                        <td align="right"> '.$value->Jumlah.' </td>
                        <td align="left"> '.$value->satuan->Uraian.'</td>
                        <td align="right"> '.number_format($value->Harga_Total,0, ',', '.').' </td>
                        <td> '.$stat.'</td>
                    </tr>
                ';
    endforeach;?>
</table>
</body>
</html>