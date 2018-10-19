//$("#btn-dokumen").click(function(){
//	document.getElementById("id").innerHTML = "<?= $form->field($ZULmodel, 'id')->hiddenInput(['value' => ".$value['Kd_Ta_Forum_Lingkungan']."])->label(false) ?>";}
//});

function ZULsendiri(param1){
	document.getElementById("id").value = param1;
}

$(".btn_ubah").click(function(){
  var kode = $(this).data('kd');
  //alert("index.php?r=lingkungan/cekdokumen&kode=24");
  $.ajax({
    url: "index.php?r=lingkungan/cekdokumen",
    data: "kode="+kode,
    success: function(dat) {
      var data = dat.split("|");
      var foto = parseInt(data[0]);
      var video = parseInt(data[1]);
      if (foto > 0)
        $("#stat_foto").html('Sudah');
      else
        $("#stat_foto").html('Belum');

      if (video > 0)
        $("#stat_video").html('Sudah');
      else
        $("#stat_video").html('Belum');
      
      if (foto>0 || video>0) {
        $("#kode_usulan").val(kode);
        $("#pesan_survey").html('Apakah anda yakin dokumen sudah cukup?');
        $("#survey_selesai").prop('disabled', false);
      }
      else{
        $("#pesan_survey").html('Lengkapi data agar dapat mengubah status');
        $("#survey_selesai").prop('disabled', true);
      }
    }
  });

});

$("#survey_selesai").click(function(){
	var kode = $("#kode_usulan").val();
  var status = 4;
  //alert("index.php?r=lingkungan/ubahstatus"+"&"+"kode="+kode+"&status="+status);
	$.ajax({
    url: "index.php?r=lingkungan/ubahstatus",
    data: "kode="+kode+"&status="+status,
    success: function(dat) {
      if (dat == 'berhasil') {
        $('#btn_'+kode).html('Sudah<br/>Survey');
        $('#btn_'+kode).attr('class', 'btn btn-success');
        $('#btn_'+kode).removeClass("btn_ubah");
        $('#btn_'+kode).removeAttr('data-toggle');
        $('#btn_'+kode).removeAttr('data-target');
        $('#span_'+kode).css("display","none");
        //alert('Ubah Status Berhasil');
        $('#modal_cek_cokumen').modal('hide');
      }
      else{
        alert('Ubah Status Gagal');
      }
    }
  });
  
});

$(".btn_lihat_dokumen").click(function(){
  var kode = $(this).data('kode');
  //alert("index.php?r=lingkungan/lihatdokumen&".'kode='+kode);
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
    url: "index.php?r=lingkungan/lihatriwayat",
    data: 'kode2='+kode2,
    success: function(isi2) {
      $("#modal_lihat_riwayat").html(isi2);
      $("#modal_lihat_riwayat").modal('show');
    }
  });
});
