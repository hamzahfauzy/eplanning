<?php
  $no=0;
  $total_uang = 0;
  foreach ($data as $key => $value) :
    $no++;
    $Kd_Ta_Forum_Lingkungan = $value["Kd_Ta_Musrenbang_Kelurahan"];
    $jenis_usulan = $value["Jenis_Usulan"];
    $permasalahan = $value["Nm_Permasalahan"];
    $bidang_pembangunan = $value->kdPem->Bidang_Pembangunan;
    $jumlah = $value["Jumlah"];
    $satuan = $value->kdSatuan->Uraian;
    $harga_total = $value["Harga_Total"];
    $jalan = @$value->kdJalan->Nm_Jalan;
    $lingkungan = $value->kdLingkungan->Nm_Lingkungan;
    $lat = $value["Latitute"];
    $lon = $value["Longitude"];
    $status = "";//$value->statusSurvey->Nm_Status;
    $keterangan = "";//$value["Keterangan"];
	$total_uang += $harga_total;
    
    $status_penerimaan = "";//$value->statusPenerimaan->Nm_Status_Penerimaan;
    //$bidang_pembangunan = '';
    //$satuan = '';
    //$jalan = '';
    //$status = '';
    $koordinat = '<button class="btn btn-primary kordinat-btn" data-kd="' . $Kd_Ta_Forum_Lingkungan. '" data-lat="' . $value['Latitute'] . '" data-lng="' . $value['Longitude'] . '">Koordinat</button>';
    $lihatdokumen = '<button class="btn btn-primary btn_lihat_dokumen" data-kode="'.$Kd_Ta_Forum_Lingkungan.'">Lihat Dokumen</button>';
    $lihatriwayat = '<button class="btn btn-primary btn_lihat_riwayat" data-kode2="' . $Kd_Ta_Forum_Lingkungan . '">Riwayat</button>';
    
    $tombol='';
	
    //'<button type="button" class="btn btn-warning" id="btn-revisi" data-kd="'.$Kd_Ta_Forum_Lingkungan.'" >Revisi</button> <br/>';
    
  ?>
    <tr>
      <td><?= $no ?></td>
	  <td><?= $lingkungan ?></td>
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
	  <!--
      <td><?= $status ?></td>-->
      <td class="text-center">
        <?=$opd($value->Kd_Urusan,$value->Kd_Bidang); ?>
      </td>
	  <!--
	  <td>
        Upload Dokumen
      </td>
	  
      <td class="text-center">
        <?= $keterangan ?>
      </td>
      <td>
        <?= $status_penerimaan ?>
      </td>
      <td>
        <?= $tombol  ?>
      </td>-->
    </tr>
  <?php
  endforeach;
?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td>Total</td>
		<td class="uang"><?= $total_uang; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<!--
		<td></td>
		<td></td>
		<td></td>-->
	</tr>

<script type="text/javascript">
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

  $(".kordinat-btn").click(function(){
      var kode=$(this).data('kd');
      var lat=$(this).data('lat');
      var lng=$(this).data('lng');
      ///alert(kode);
      $('#kd_usulan_input').val(kode);
      $('#lat').val(lat);
      $('#lng').val(lng);
      $("#modal_koordinat").modal('show');
      
  });
  
  $("#modal_koordinat").on("shown.bs.modal", function () {
      lat = parseFloat($('#lat').val());
      lng = parseFloat($('#lng').val());
      if ($('#lat').val()==''){
        lat = 3.595163;
        lng = 98.671884;
        zoom = 13;
      }
      else{
        lat = parseFloat($('#lat').val());
        lng = parseFloat($('#lng').val());
        zoom = 18;
      }

      var latLng= new google.maps.LatLng(lat, lng);
      var mapOptions={
        center: latLng,
        zoom: zoom,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById('peta'), mapOptions);
      
      var tandaGerak= new google.maps.Marker({
          position:{lat: lat, lng: lng},
          draggable: true,
          title: "geser ke lokasi"
      });
      tandaGerak.setMap(map);
      
      tandaGerak.addListener('dragend', function(e) {
        var tandaLat=e.latLng.lat();
        var tandaLng=e.latLng.lng();
        //alert("latiturde= "+tandaLat+" longitude="+tandaLng);
        $("#lat").val(tandaLat);
        $("#lng").val(tandaLng);

      });

  });

  $(".btn-tolak").click(function(){
    var kode = $(this).data('kd');
    $('#kd_usulan_ditolak').val(kode);
  });

  $(".btn-terima").click(function(){
    var kode = $(this).data('kd');
    $('#kd_usulan_diterima').val(kode);
  });
  
  
</script>