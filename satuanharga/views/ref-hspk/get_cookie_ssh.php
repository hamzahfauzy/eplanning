<?php
$this->registerJsFile(
    '@web/js/form_ssh_hspk.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
  <table class="tabel-hasil">
    <thead>
      <tr>
        <th>Aksi</th>
        <th>NOMOR</th>
        <th>KATEGORI</th>
        <th>URAIAN KEGIATAN</th>
        <th>KOEF.</th>
        <th>SAT</th>
        <th>HARGA SATUAN</th>
        <th>HARGA</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $tot_harga = 0;
        foreach ($data as $key => $value) :
            $Kd_Ssh1 = $value['Kd_Ssh1'];
            $Kd_Ssh2 = $value['Kd_Ssh2'];
            $Kd_Ssh3 = $value['Kd_Ssh3'];
            $Kd_Ssh4 = $value['Kd_Ssh4'];
            $Kd_Ssh5 = $value['Kd_Ssh5'];
            $Kd_Ssh6 = $value['Kd_Ssh6'];
            $Harga_Satuan = $value['Harga_Satuan'];
            $Kd_Satuan = $value['Kd_Satuan'];
            $Koefisien = $value['Koefisien'];
            $Harga = $value['Harga'];
            $Kategori = $value['Kategori'];
            $Uraian_ssh = $value['Uraian_ssh'];
            $Satuan_ssh = $value['Satuan_ssh'];

            $nomor = $Kd_Ssh1.".".$Kd_Ssh2.".".$Kd_Ssh3.".".$Kd_Ssh4.".".$Kd_Ssh5.".".$Kd_Ssh6;
            $tot_harga += $Harga;

            if ($Kategori==1) {
              $Nama_Kategori='Upah';
            }
            else if($Kategori==2){
              $Nama_Kategori='Bahan / Material';
            }
            else if($Kategori==3){
              $Nama_Kategori='Sewa Peralatan';
            }
          ?>
            <tr><!-- kategori -->
              <td><button type="button" class="btn btn-danger btn-xs hapus_ssh" data-key=<?= $key ?>><i class="fa fa-trash"></i></button></td>
              <td><?= $nomor ?></td>
              <td><?= $Nama_Kategori ?></td>
              <td><?= $Uraian_ssh ?></td>
              <td style="text-align:right;"><?= $Koefisien ?></td>
              <td><?= $Satuan_ssh ?></td>
              <td style="text-align:right;"><?= number_format($Harga_Satuan,2,',','.') ?></td>
              <td style="text-align:right;"><?= number_format($Harga,2,',','.') ?></td>
            </tr>
          <?php
        endforeach;
      ?>
      <tr class="akhir"> <!-- toal akhir semua jumlah -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right text-bold">Nilai HSPK</td>
        <td class="uang jumlah" id="jumlah_hspk" style="text-align:right;" hidden><?= $tot_harga ?></td>
        <td class="uang jumlah" style="text-align:right;"><?= number_format($tot_harga,2,',','.') ?></td>
      </tr>
      <!-- akhir kegiatan -->
    </tbody>
  </table>

<script type="text/javascript">
  $(".hapus_ssh").click(function(){
    var key = $(this).data('key');
    //  alert(key);
    $.ajax({
      type: "GET",
      url:'index.php?r=ref-hspk/del-cookie',
      data:{key:key},
      success: function(isi){
        get_ssh();
      },
      error: function(){
        alert("failure");
      }
    });
  });
</script>
