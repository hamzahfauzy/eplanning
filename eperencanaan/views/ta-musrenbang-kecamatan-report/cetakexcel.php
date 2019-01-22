<?php
  $filename = 'Data-'.Date('YmdGis').'-Usulan_Kelurahan.xls';
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=".$filename);
?>
<table border="1" width="100%">
<thead>
  <tr>
    <th></th>
    <th> Digolongkan berdasarkan: </th>
  </tr>

  <tr>
    <th></th>
    <th>Kelurahan : <?= $kelurahan ?></th>
  </tr> 

  <tr>
    <th></th>
    <th>Bidang Pembangunan : <?= $bid_pem ?> </th>
  </tr>

  <tr></tr>

  <tr>   
    <th>No</th>
    <th>Permasalahan</th>
    <th>Kegiatan Prioritas</th>
    <th> Bidang Pembangunan </th>
    <th>Prioritas Pembangunan </th>
    <th>Desa/Kelurahan</th>
    <th>Dusun/Lingkungan</th>
    <th>Jalan</th>
    <th>Volume</th>
    <th>Pagu Indikatif</th>
    <th>OPD Penanggung Jawab</th>
    <th>Status Penerimaan </th>
    <th>Alasan </th>
    <th>
  </tr>
</thead>
<tbody>
  <?php
  $no = 1;
    foreach($usulan1 as $value):
      ?>
      <tr>
         <td> <?= $no++ ?></td>
         <td> <?= $value->Nm_Permasalahan ?> </td>
         <td> <?= $value->Jenis_Usulan ?> </td>
         <td>  <?php echo $value->kdPem->Bidang_Pembangunan;?> </td>    
         <td><?= @$value->tahun->Nm_Prioritas_Pembangunan_Kota ?></td>
         <td><?= $value->kdProv->Nm_Kel ?></td>
         <td></td>
         <td></td>
         <td><?= $value->Jumlah." ".$value->kdSatuan->Uraian ?></td>
         <td style="text-align: right"> <?= \Yii::$app->zultanggal->ZULgetcurrency($value->Harga_Total) ?> </td>
         <td></td>
         <td></td>
         <td></td>
      </tr>
      <?php
    endforeach;
    ?>
    <?php
    foreach($usulan2 as $value):
      ?>
      <tr>
         <td> <?= $no++ ?></td>
         <td>
              <?= $value->Nm_Permasalahan ?> </td>
          <td><?= $value->Jenis_Usulan ?> </td>
         <td> <?php echo $value->kdPem->Bidang_Pembangunan;?> </td>
         <td><?= $value->tahun->Nm_Prioritas_Pembangunan_Kota ?></td>
         <td><?= $value->kdProv->Nm_Kel ?></td>
         <td><?= $value->lingkungan->Nm_Lingkungan?></td>
         <td><?= $value->kdJalan->Nm_Jalan  ?></td>
         <td><?= $value->Jumlah." ".$value->kdSatuan->Uraian ?></td>
         <td style="text-align: right"> <?= \Yii::$app->zultanggal->ZULgetcurrency($value->Harga_Total) ?> </td>
           <<td><?=$opd(1,4);?> </td>
           <td>
           <?php if ($value->Status_Penerimaan == 1): ?>
                 Diterima
            <?php elseif ($value->Status_Penerimaan == 2) : ?>
                 Diterima dengan Perubahan
            <?php endif ?> </td>
           <td><?php echo $value->Keterangan ?></td>
           
      </tr>
      <?php
    endforeach;
  ?>
</tbody>
</table>