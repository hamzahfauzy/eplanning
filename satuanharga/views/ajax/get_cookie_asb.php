<?php
$this->registerJsFile(
    '@web/js/form_ssh_hspk.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
//print_r($data);
//echo $data[0]['Kategori_Pekerjaan_Nama'];
//die();
if ($data):
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
            $Kd1 = $value['Kd1'];
            $Kd2 = $value['Kd2'];
            $Kd3 = $value['Kd3'];
            $Kd4 = $value['Kd4'];
            $Kd5 = $value['Kd5'];
            $Kd6 = $value['Kd6'];
            $Kategori_Pekerjaan = $value['Kategori_Pekerjaan'];
            $Nama_Pekerjaan = $value['Nama_Pekerjaan'];
            $Satuan = $value['Satuan'];
            $Harga_Satuan = $value['Harga_Satuan'];
            $Koefisien = $value['Koefisien'];
            $Harga = $value['Harga'];
            $Uraian = $value['Uraian'];
            $Kd_Satuan = $value['Kd_Satuan'];
            $Asal = $value['Asal'];

            if ($Asal == 1) {
              $nomor = $Kd1.".".$Kd2.".".$Kd3.".".$Kd4.".".$Kd5.".".$Kd6;
            }
            else if($Asal == 2){
              $nomor = $Kd1.".".$Kd2.".".$Kd3.".".$Kd4;
            }
            else if($Asal == 3){
              $nomor = $Kd1.".".$Kd2.".".$Kd3.".".$Kd4.".".$Kd5;
            }
            $tot_harga += $Harga;

          ?>
            <tr><!-- kategori -->
              <td><button type="button" class="btn btn-danger btn-xs hapus_cookie" data-key=<?= $key ?> data-kdhspkssh1=<?= $Kd1 ?> data-kdhspkssh2=<?= $Kd2 ?> data-kdhspkssh3=<?= $Kd3 ?> data-kdhspkssh4=<?= $Kd4 ?> data-kdssh5=<?= $Kd5 ?> data-kdssh6=<?= $Kd6 ?>><i class="fa fa-trash"></i></button></td>
              <td><?= $nomor ?></td>
              <td><?= $Nama_Pekerjaan ?></td>
              <td><?= $Uraian ?></td>
              <td class="text-right"><?= $Koefisien ?></td>
              <td><?= $Satuan ?></td>
              <td class="text-right"><?= number_format($Harga_Satuan,2,',','.') ?></td>
              <td class="text-right"><?= number_format($Harga,2,',','.') ?></td>
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
        <td class="text-right uang jumlah" id="jumlah_hspk" hidden><?= $tot_harga ?></td>
        <td class="text-right uang jumlah"><?= number_format($tot_harga,2,',','.') ?></td>
      </tr>
      <!-- akhir kegiatan -->
    </tbody>
  </table>

<script type="text/javascript">
  $(".hapus_cookie").click(function(){

    var kdasb1 = $('#Kd_Asb1').val();
    var kdasb2 = $('#Kd_Asb2').val();
    var kdasb3 = $('#Kd_Asb3').val();
    var kdasb4 = $('#Kd_Asb4').val();
    var kdasb5 = $('#Kd_Asb5').val();

    hspkssh1 = $(this).data('kdhspkssh1');
    hspkssh2 = $(this).data('kdhspkssh2');
    hspkssh3 = $(this).data('kdhspkssh3');
    hspkssh4 = $(this).data('kdhspkssh4');
    ssh5 = $(this).data('kdssh5');
    ssh6 = $(this).data('kdssh6');

    var key = $(this).data('key');
    // //alert('index.php?r=ajax/del-cookie&key='+key);

    //alert(kdasb1 + ':' + kdasb2 + ':' + kdasb3 + ':' + kdasb4 + ':' + kdasb5 + ':' +  hspkssh1 + ':' + hspkssh2 + ':' + hspkssh3 + ':' + hspkssh4 + ':' + ssh5 + ':' + ssh6);

    $.ajax({
       type: "GET",
       url:'index.php?r=ajax/del-cookie',
       data:{
             key:key,

             kdasb1:kdasb1,
             kdasb2:kdasb2,
             kdasb3:kdasb3,
             kdasb4:kdasb4,
             kdasb5:kdasb5,

             hspkssh1:hspkssh1,
             hspkssh2:hspkssh2,
             hspkssh3:hspkssh3,
             hspkssh4:hspkssh4,
             ssh5:ssh5,
             ssh6:ssh6,

            },
       success: function(isi){
         get_data_cookie();
       },
       error: function(){
         alert("failure");
       }
     });


  });
</script>
<?php endif; ?>