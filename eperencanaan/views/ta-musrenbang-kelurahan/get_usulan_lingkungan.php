<?php
  $no=0;
  foreach ($data as $key => $value) :
    $no++;
    $Kd_Ta_Forum_Lingkungan = $value["Kd_Ta_Forum_Lingkungan"];
    $Kd_Ta_Musrenbang_Kelurahan_Verifikasi = $value["Kd_Ta_Musrenbang_Kelurahan_Verifikasi"];
    $jenis_usulan = $value["Jenis_Usulan"];
    $permasalahan = $value["Nm_Permasalahan"];
    $bidpem = $value->Kd_Pem;
	$satuan = $value->Kd_Satuan;
	$prioritas = $value->Kd_Prioritas_Pembangunan_Daerah;
    $bidang_pembangunan = $value->kdPem->Bidang_Pembangunan;
    $jumlah = $value["Jumlah"];
    //$satuan = $value->kdSatuan->Uraian;
    $harga_satuan = $value["Harga_Satuan"];
    $harga_total = $value["Harga_Total"];
    $jalan = $value->kdJalan->Nm_Jalan;
    $lat = $value["Latitute"];
    $lon = $value["Longitude"];
    $status = $value->statusSurvey->Nm_Status;
    $Nm_Lingkungan = $value->lingkungan->Nm_Lingkungan;

    $pilih = '<button class="btn btn-primary btn_pilih" data-kode="'.$Kd_Ta_Musrenbang_Kelurahan_Verifikasi.'" data-lingkungan="'.$Nm_Lingkungan.'" data-satuan="'.$satuan.'" data-prioritas="'.$prioritas.'">Pilih</button>';

  ?>
    <tr id="usulan<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>">
      <td><?= $no ?></td>
      <td><?= $Nm_Lingkungan ?></td>
      <td>
        <b>Permasalahan:</b><br/>
        <p id="permasalahan<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>"><?= $permasalahan ?></p>
        <b>Usulan:</b>
        <p id="isiusulan<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>"><?= $jenis_usulan ?></p>
        (<span style="display: none" id="bidpem<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>"><?= $bidpem ?></span><?= $bidang_pembangunan ?>)
        <span style="display: none" id="harga_satuan<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>"><?= $harga_satuan ?></span>
      </td>
      <td id="jumlah<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>"><?= $jumlah ?></td>
      <td id="satuan<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>"><?= $satuan ?></td>
      <td class="uang" id="harga<?= $Kd_Ta_Musrenbang_Kelurahan_Verifikasi ?>"><?= $harga_total ?></td>
      <td>
        <?= $jalan ?> <br/>
        Lat: <?= $lat ?><br/>
        Long: <?= $lon ?>
      </td>
      <td><?= $status ?></td>
      <td>
        <?= $pilih ?>
      </td>
    </tr>
  <?php
  endforeach;
?>

<script type="text/javascript">
$('.uang').number( true, 2, ',', '.' );

$(".btn_pilih").click(function(){
  var kode = $(this).data('kode');
  var lingkungan = $(this).data('lingkungan');
  var usulan = $('#isiusulan'+kode).html();
  var permasalahan = $('#permasalahan'+kode).html();
  var jumlah = $('#jumlah'+kode).html();
  //var satuan = $('#satuan'+kode).html();
  var satuan = $(this).data('satuan');
  var prioritas = $(this).data('prioritas');
  var harga = $('#harga'+kode).html();
  var harga_satuan = $('#harga_satuan'+kode).html();
  var bidpem = $('#bidpem'+kode).html();
  //alert(bidpem);
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-musrenbang-kelurahan%2Fset-cookie-usulan',
    data: {Lingkungan:lingkungan, Permasalahan:permasalahan, Kode:kode, Usulan:usulan, Jumlah:jumlah, Satuan:satuan, Harga:harga },
    success: function(isi){
      alert(isi);
      get_usulan_pilih(); // ada di kompilasi.js
      get_usulan(); // ada di kompilasi.js
      sisa_usulan();

      if ($('#tamusrenbangkelurahan-nm_permasalahan').val() == '') {
        $('#tamusrenbangkelurahan-nm_permasalahan').val(permasalahan);
        $('#tamusrenbangkelurahan-jenis_usulan').val(usulan);
        $('#harga').val(harga_satuan);
        $("#satuan").val(satuan).change();
        $("#tamusrenbangkelurahan-kd_prioritas_pembangunan_daerah").val(prioritas).change();
        $("input[name='TaMusrenbangKelurahan[Kd_Pem]'][value='"+bidpem+"']").prop("checked",true);
      }
    },
    error: function(){
      alert("failure");
    }
  });
});
//$('#tamusrenbangkelurahan-nm_permasalahan').val('1');
//$('#tamusrenbangkelurahan-jenis_usulan').val('1');
//$('#jumlah').val('1');
//$('#harga').val('1');
//$('#total').val('1');
//$('#satuan').val();
</script>