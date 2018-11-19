<?php
  $no=0;
  foreach ($data as $key => $value) :
    $no++;
    $Kd_Ta_Forum_Lingkungan = $value["Kd_Ta_Forum_Lingkungan"];
    $Kd_Ta_Musrenbang_Kelurahan_Verifikasi = $value["Kd_Ta_Musrenbang_Kelurahan_Verifikasi"];
    $jenis_usulan = $value["Jenis_Usulan"];
    $permasalahan = $value["Nm_Permasalahan"];
    $bidang_pembangunan = $value->kdPem->Bidang_Pembangunan;
    $jumlah = $value["Jumlah"];
    $satuan = $value->kdSatuan->Uraian;
    $harga_total = $value["Harga_Total"];
    $jalan = $value->kdJalan->Nm_Jalan;
    $lat = $value["Latitute"];
    $lon = $value["Longitude"];
    $status = $value->statusSurvey->Nm_Status;
    $keterangan = $value["Keterangan"];
    $status_revisi = $value["Status_Revisi"];
  ?>
    <tr>
      <td><?= $no ?></td>
      <td>
        <b>Permasalahan:</b><br/>
        <p><?= $permasalahan ?></p>
        <b>Usulan:</b>
        <p><?= $jenis_usulan ?></p>
        (<?= $bidang_pembangunan ?>)
      </td>
      <td><?= $jumlah.' '.$satuan ?></td>
      <td class="uang"><?= $harga_total ?></td>
      <td>
        <?= $jalan ?> <br/>
        Lat: <?= $lat ?><br/>
        Long: <?= $lon ?>
      </td>
      <td><?= $status ?></td>
      <td class="text-center">
        <button class="btn btn-primary">Detail</button> <br/>
        <button class="btn btn-primary">Peta</button> <br/>
        <button class="btn btn-primary">Dokumen</button> <br/>
      </td>
      <td class="text-center">
        <?= $keterangan ?>
      </td>
      <td>
        <?php
          if($status_revisi == '2'):
            ?>
            <button class="btn btn-success btn-terima" data-kd="<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>" data-toggle="modal" data-target="#modal_terima">Terima</button> <br/>
            <button class="btn btn-warning btn-revisi" data-kd="<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>" data-toggle="modal" data-target="#modal_revisi">Revisi</button> <br/>
            <button class="btn btn-danger btn-tolak" data-kd="<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>" data-toggle="modal" data-target="#modal_tolak">Tolak</button> <br/>
            <?php
          endif;
        ?>
      </td>
    </tr>
  <?php
  endforeach;
?>

<script type="text/javascript">
  $(".btn-terima").click(function(){
    var kode = $(this).data('kd');
    $('#kd_usulan_diterima').val(kode);
  });

  $(".btn-revisi").click(function(){
    var kode = $(this).data('kd');
    $('#kd_usulan_direvisi').val(kode);
  });

  $(".btn-tolak").click(function(){
    var kode = $(this).data('kd');
    $('#kd_usulan_ditolak').val(kode);
  });

  $('.uang').number( true, 2, ',', '.' );
</script>