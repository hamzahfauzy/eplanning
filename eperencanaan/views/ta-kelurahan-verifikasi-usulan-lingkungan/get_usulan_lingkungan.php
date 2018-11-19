<?php
  $no=0;
  foreach ($data as $key => $value) :
    $no++;
    $Kd_Ta_Forum_Lingkungan = $value["Kd_Ta_Forum_Lingkungan"];
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

    $koordinat = '<button class="btn btn-primary kordinat-btn" data-kd="' . $value['Kd_Ta_Forum_Lingkungan'] . '" data-lat="' . $value['Latitute'] . '" data-lng="' . $value['Longitude'] . '">Koordinat</button>';
    $lihatdokumen = '';
    if ($value->getTaUsulanLingkunganMedia()->count() != 0)
    $lihatdokumen = '<button class="btn btn-primary btn_lihat_dokumen" data-kode="'.$Kd_Ta_Forum_Lingkungan.'">Lihat Dokumen</button>';
    $lihatriwayat = '<button class="btn btn-primary btn_lihat_riwayat" data-kode2="' . $Kd_Ta_Forum_Lingkungan . '">Riwayat</button>';

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
        <!--
        <button class="btn btn-primary">Detail</button> <br/>
        <?= $koordinat ?> <br/> -->
        <?= $lihatdokumen ?> <br/>
        <?= $lihatriwayat ?> 
      </td>
      <td class="text-center">
        <?php echo \yii\helpers\Html::Button('Terima',[
            'class' => 'btn btn-success btn-sm btn-terima',
            'data-kd' => $Kd_Ta_Forum_Lingkungan,
            //'data-tujuan' => Yii::$app->urlManager->createUrl("ta-kelurahan-verifikasi-usulan-lingkungan/keterangan-langsung"),
        ]);?>
        <div> </div>
       

        <?php echo \yii\helpers\Html::Button('Diterima dengan Revisi',[
          'class' => 'btn btn-warning btn-sm btn-revisi',
          'data-kd' => $Kd_Ta_Forum_Lingkungan,
          //'data-tujuan' => Yii::$app->urlManager->createUrl("ta-kelurahan-verifikasi-usulan-lingkungan/revisi-langsung"),
          //'data-placement' => 'bottom', 
          //'title' => 'Jika dibutuhkan revisi',
            
        ]);?>
        <div> </div>
        
        <?php echo \yii\helpers\Html::Button('Tolak',[
            'class' => 'btn btn-danger btn-tolak btn-sm',
            'data-kd' => $Kd_Ta_Forum_Lingkungan,
            //'id' => 'btn-revisi-asal',
            'data-toggle' => 'modal',
            'data-target' => '#modal_tolak',
            
        ]);?>
      </td>
    </tr>
  <?php
  endforeach;
?>

<script type="text/javascript">
  /*
  $(".btn-revisi").click(function(){
    var kode = $(this).data('kd');
    $('#kd_usulan_direvisi').val(kode);
  });
  */

  $(".btn-tolak").click(function(){
    var kode = $(this).data('kd');
    $('#kd_usulan_ditolak').val(kode);
  });

  $('.uang').number( true, 2, ',', '.' );

  $(".btn_lihat_dokumen").click(function(){
    var kode = $(this).data('kode');
    //alert("index.php?r=lingkungan/lihatdokumen&"+'kode='+kode);
    $.ajax({
      url: "index.php?r=lingkungan/lihatdokumen",
      data: 'kode='+kode,
      success: function(isi) {
        $("#modal_lihat_dokumen").html(isi);
        $("#modal_lihat_dokumen").modal('show');
      }
    }); 
  });

  $(".btn_lihat_riwayat").click(function(){
    var kode2 = $(this).data('kode2');
    //alert("index.php?r=lingkungan/lihatriwayat"+"&"+'kode2='+kode2);
    $.ajax({
      url: "index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/lihatriwayat",
      data: 'kode2='+kode2,
      success: function(isi2) {
        $("#modal_lihat_riwayat").html(isi2);
        $("#modal_lihat_riwayat").modal('show');
      }
    });
  });

  /*
  $(".btn-revisi-2").click(function(){
    var kode = $(this).data('kd');
    var tujuan = $(this).data('tujuan');
    $("#revisi-body").html("<h3>Mohon menunggu...</h3>");
    $("#revisi").modal('show');
    $.ajax({ 
      type: "GET",
      url: tujuan,
      data: {Kd_Ta_Forum_Lingkungan :kode},
      success: function(isi){
        $("#revisi-body").html(isi);
        $("#btn-simpan-revisi-langsung").attr("data-kr", kode);
        $("#btn-simpan-revisi-langsung").show();
      },
      error: function(xhr, status, err){
        $("#revisi-body").html(status);
      }
    });
  });
  */
/*
$(".btn-tolak").click(function () {
    //alert("test");
    var kd = $(this).data("kd");
    $.ajax({
        type: "GET",
        url:"index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/keterangan-langsung",
        data: {Kd_Ta_Forum_Lingkungan: kd},
        success: function (isi) {
            $("#keterangan_ajax_tolak").html(isi);
            $("#btn-simpan-tolak").attr("data-kd", kd);
            $("#btn-simpan-tolak").show();
        },
        error: function () {
            alert("failure");
        }
    });
});
*/
/*
$(".btn-terima").click(function(){
  var kode = $(this).data('kd');
  $('#kd_usulan_diterima').val(kode);
  $("#modal_terima").modal('show');
});

$(".btn-terima2").click(function(){
  var kode = $(this).data('kd');
  var tujuan = $(this).data('tujuan');
  //$("#kd_usulan_diterima").val(kode);
  $.ajax({ 
    type: "GET",
    url: tujuan,
    //url: "index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/keterangan-langsung",
    data: {Kd_Ta_Forum_Lingkungan: kode},
    success: function(isi){
      $("#keterangan_ajax").html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
});
*/

$(".btn-terima").click(function(){
  var kode = $(this).data('kd');
  $.ajax({ 
    type: "GET",
    url:"index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/modal-diterima",
    data: {Kd_Ta_Forum_Lingkungan: kode},
    success: function(isi){
      $("#modal_terima").html(isi);
      $("#modal_terima").modal('show');
    },
    error: function(){
      alert("failure");
    }
  });
});

$(".btn-revisi").click(function(){
  var kode = $(this).data('kd');
  $.ajax({ 
    type: "GET",
    url:"index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/modal-direvisi",
    data: {Kd_Ta_Forum_Lingkungan: kode},
    success: function(isi){
      $("#modal_revisi").html(isi);
      $("#modal_revisi").modal('show');
    },
    error: function(){
      alert("failure");
    }
  });
});

$(".btn-tolak").click(function(){
  var kode = $(this).data('kd');
  $.ajax({ 
    type: "GET",
    url:"index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/modal-ditolak",
    data: {Kd_Ta_Forum_Lingkungan: kode},
    success: function(isi){
      $("#modal_tolak").html(isi);
      $("#modal_tolak").modal('show');
    },
    error: function(){
      alert("failure");
    }
  });
});

</script>