
//------Tambah Kegiatan------//
$('#btn_tambah_kegiatan').on('click', function () {
  $('#tambahKegiatanSave').attr('disabled', true);

  $('#tambahKegiatanModal').modal('show')
          .find('#tambahKegiatanContent')
          .html("Loading...");
  //=============================================//
  $('#tambahKegiatanModal').modal('show')
          .find('#tambahKegiatanContent')
          .load($(this).attr('value'));
  //$('#tambah_kegiatan_form').trigger("reset");
  //alert($(this).attr('value'));
  $('#tambahKegiatanSave').attr('disabled', false);
});

$("#tambahKegiatanSave").click(function(){
  $('#tambahKegiatanSave').attr('disabled', true);
  var alamat = $('#tambah_kegiatan_form').attr('action');
  //alert(alamat);
	$.ajax({ 
    type: "POST",
    url:alamat,
    data:$("#tambah_kegiatan_form").serialize(),
    success: function(isi){
      //console.log(isi);
      //return;
    	$('#tambahKegiatanContent').html(isi);
      $('#tambahKegiatanModal').on('hidden.bs.modal', function () {
          window.location.reload(true);
      })
    },
    error: function(xhr, ajaxOptions, thrownError) {
        //alert(xhr.status);
        //alert(thrownError);
        alert("Gagal Tambah Kegiatan");
      $('#tambahKegiatanSave').attr('disabled', false);
    }
  });
});

$('.hapus_kegiatan').on('click', function () {
  var alamat = $(this).data('tujuan');
  //alert(alamat);
  $('#hapusKegiatanModel').modal('show');
  $('#hapusKegiatanSave').val(alamat);
});

$('#hapusKegiatanSave').on('click', function () {
  $('#hapusKegiatanSave').attr('disabled', true);
  var url = $(this).attr('value');
  //alert(url);
  $.post(url, function(data){
        //alert(data);
      $('#hapusKegiatanContent').html(data);
      $('#hapusKegiatanModel').on('hidden.bs.modal', function () {
          window.location.reload(true);
      })
  })
});

$('.ubah_kegiatan').on('click', function () {
  $('#tambahKegiatanModal').modal('show')
          .find('#tambahKegiatanContent')
          .html("Loading...");
  //=============================================//
  $('#tambahKegiatanModal').modal('show')
          .find('#tambahKegiatanContent')
          .load($(this).attr('value'));
          //alert($(this).attr('value'));
});

//------Tambah Rincian------//
$('#btn_tambah_rincian').on('click', function () {
  
  $('#tambahRincianModal').modal('show')
          .find('#tambahRincianContent')
          .html("Loading...");
  //=============================================//
  $('#tambahRincianModal').modal('show')
          .find('#tambahRincianContent')
          .load($(this).attr('value'));
  //alert($(this).attr('value'));
  //$('#tambahRincianSave').attr('disabled', true);
});

$("#tambahRincianSave").click(function(){
  var Kd_Rek_3 = $("#Kd_Rek_3").val();
  var Kd_Rek_4 = $("#Kd_Rek_4").val();
  var Kd_Rek_5 = $("#Kd_Rek_5").val();
  
  if(Kd_Rek_3=='' || Kd_Rek_4=='' || Kd_Rek_5==''){
    alert('Semua Kode Harus Dipilih');
  }
  else{
    $('#tambahRincianSave').attr('disabled', true);
    var alamat = $('#tambah_rincian_form').attr('action');
    //alert(alamat);
    $.ajax({ 
      type: "POST",
      url: alamat,
      data:$("#tambah_rincian_form").serialize(),
      success: function(isi){
        $('#tambahRincianContent').html(isi);
        $('#tambahRincianModal').on('hidden.bs.modal', function () {
            window.location.reload(true);
        })
      },
      error: function(){
        alert("failure");
      }
    });
  }
});

$('.hapus_rincian').on('click', function () {
  var alamat = $(this).data('tujuan');
  //alert(alamat);
  $('#hapusRincianModel').modal('show');
  $('#hapusRincianSave').val(alamat);
});

$('#hapusRincianSave').on('click', function () {
  $('#hapusRincianSave').attr('disabled', true);
  var url = $(this).attr('value');
  //alert(url);
  $.post(url, function(data){
        //alert(data);
      $('#hapusRincianContent').html(data);
      $('#hapusRincianModel').on('hidden.bs.modal', function () {
          window.location.reload(true);
      })
  })
});

$('.ubah_rincian').on('click', function () {
  $('#tambahRincianModal').modal('show')
          .find('#tambahRincianContent')
          .html("Loading...");
  //=============================================//
  //alert($(this).attr('value'));
  $('#tambahRincianModal').modal('show')
          .find('#tambahRincianContent')
          .load($(this).attr('value'));
  //$('#tambahRincianSave').attr('disabled', true);
});

//------Tambah Rincian Sub------//
$('#btn_tambah_rincian_sub').on('click', function () {
  $('#tambahRincianSubModal').modal('show')
          .find('#tambahRincianSubContent')
          .html("Loading...");
  //=============================================//
  $('#tambahRincianSubModal').modal('show')
          .find('#tambahRincianSubContent')
          .load($(this).attr('value'));
  //alert($(this).attr('value'));
  //$('#tambahRincianSave').attr('disabled', true);
});

$("#tambahRincianSubSave").click(function(){
  $('#tambahRincianSubSave').attr('disabled', true);
  var alamat = $('#tambah_rincian_sub_form').attr('action');
  $.ajax({ 
    type: "POST",
    url: alamat,
    data:$("#tambah_rincian_sub_form").serialize(),
    success: function(isi){
      $('#tambahRincianSubContent').html(isi);
      $('#tambahRincianSubModal').on('hidden.bs.modal', function () {
          window.location.reload(true);
      })
    },
    error: function(){
      alert("failure");
    }
  });
});

$('.hapus_rincian_sub').on('click', function () {
  var alamat = $(this).data('tujuan');
  //alert(alamat);
  $('#hapusRincianSubModel').modal('show');
  $('#hapusRincianSubSave').val(alamat);
});

$('#hapusRincianSubSave').on('click', function () {
  $('#hapusRincianSubSave').attr('disabled', true);
  var url = $(this).attr('value');
  //alert(url);
  $.post(url, function(data){
        //alert(data);
      $('#hapusRincianSubContent').html(data);
      $('#hapusRincianSubModel').on('hidden.bs.modal', function () {
          window.location.reload(true);
      })
  })
});

$('.ubah_rincian_sub').on('click', function () {
  $('#tambahRincianSubModal').modal('show')
          .find('#tambahRincianSubContent')
          .html("Loading...");
  //=============================================//
  $('#tambahRincianSubModal').modal('show')
          .find('#tambahRincianSubContent')
          .load($(this).attr('value'));
  //alert($(this).attr('value'));
  //$('#tambahRincianSave').attr('disabled', true);
});


//------Tambah Rincian Sub------//
$('#btn_tambah_rincian_obyek').on('click', function () {
  $('#tambahRincianObyekModal').modal('show')
          .find('#tambahRincianObyekContent')
          .html("Loading...");
  //=============================================//
  $('#tambahRincianObyekModal').modal('show')
          .find('#tambahRincianObyekContent')
          .load($(this).attr('value'));
  //alert($(this).attr('value'));
  $('#tambahRincianObyekSave').attr('disabled', false);
});

$("#tambahRincianObyekSave").click(function(){
  $('#tambahRincianObyekSave').attr('disabled', true);
  var alamat = $('#tambah_rincian_obyek_form').attr('action'); 
  //console.log($("#tambah_rincian_obyek_form").serialize());
  $.ajax({ 
    type: "POST",
    url: alamat,
    data:$("#tambah_rincian_obyek_form").serialize(),
    success: function(isi){
      $('#tambahRincianObyekContent').html(isi);
      $('#tambahRincianObyekModal').on('hidden.bs.modal', function () {
          window.location.reload(true);
      })
    },
    error: function(){
      alert("failure");
      $('#tambahRincianObyekSave').attr('disabled', false);
    }
  });
});

$('.hapus_obyek').on('click', function () {
  var alamat = $(this).data('tujuan');
  //alert(alamat);
  $('#hapusObyekModel').modal('show');
  $('#hapusObyekSave').val(alamat);
});

$('#hapusObyekSave').on('click', function () {
  $('#hapusObyekSave').attr('disabled', true);
  var url = $(this).attr('value');
  //alert(url);
  $.post(url, function(data){
        //alert(data);
      $('#hapusObyekContent').html(data);
      $('#hapusObyekModel').on('hidden.bs.modal', function () {
          window.location.reload(true);
      })
  })
});

$('.ubah_obyek').on('click', function () {
  $('#tambahRincianObyekModal').modal('show')
          .find('#tambahRincianObyekContent')
          .html("Loading...");
  //=============================================//
  $('#tambahRincianObyekModal').modal('show')
          .find('#tambahRincianObyekContent')
          .load($(this).attr('value'));
  //alert($(this).attr('value'));
  //$('#tambahRincianSave').attr('disabled', true);
});
