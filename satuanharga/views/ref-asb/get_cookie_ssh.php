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
        if (count($data) != 0):
        foreach ($data as $key => $value) :
            $Kd_Hspk_Ssh1 = $value['Kd_Hspk_Ssh1'];
            $Kd_Hspk_Ssh2 = $value['Kd_Hspk_Ssh2'];
            $Kd_Hspk_Ssh3 = $value['Kd_Hspk_Ssh3'];
            $Kd_Hspk_Ssh4 = $value['Kd_Hspk_Ssh4'];
            $Kd_Ssh5 = $value['Kd_Ssh5'];
            $Kd_Ssh6 = $value['Kd_Ssh6'];
            $Harga_Satuan = $value['Harga_Satuan'];
            $Kd_Satuan = $value['Kd_Satuan'];
            $Koefisien = $value['Koefisien'];
            $Jumlah_Harga = $value['Jumlah_Harga'];
            $Kategori_Pekerjaan = $value['Kategori_Pekerjaan'];
            $Uraian_ss = $value['Uraian_ss'];
            $Satuan_ss = $value['Satuan_ss'];

            $nomor = $Kd_Hspk_Ssh1.".".$Kd_Hspk_Ssh2.".".$Kd_Hspk_Ssh3.".".$Kd_Hspk_Ssh4.".".$Kd_Ssh5.".".$Kd_Ssh6;
            $tot_harga += $Jumlah_Harga;

            // if ($Kategori==1) {
            //   $Nama_Kategori='Upah';
            // }
            // else if($Kategori==2){
            //   $Nama_Kategori='Bahan / Material';
            // }
            // else if($Kategori==3){
            //   $Nama_Kategori='Sewa Peralatan';
            // }


          ?>

            <tr><!-- kategori -->
              <td><button type="button" class="btn btn-danger btn-xs hapus_ssh" data-key=<?= $key ?>><i class="fa fa-trash"></i></button></td>
              <td><?= $nomor ?></td>
              <td><?= $Kategori_Pekerjaan ?></td>
              <td><?= $Uraian_ss ?></td>
              <td><?= $Koefisien ?></td>
              <td><?= $Satuan_ss ?></td>
              <td><?= $Harga_Satuan ?></td>
              <td><?= $Jumlah_Harga ?></td>
            </tr>
          <?php
        endforeach;
        endif;  
      ?>
      <tr class="akhir"> <!-- toal akhir semua jumlah -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right text-bold">Nilai ASB</td>
        <td class="uang jumlah" id="jumlah_asb"><?= $tot_harga ?></td>
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
      url:'index.php?r=ref-asb/del-cookie',
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
