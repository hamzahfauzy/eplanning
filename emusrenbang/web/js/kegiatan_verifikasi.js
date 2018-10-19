$('.btn_keterangan').on('click', function () {
  $('#keteranganSave').attr('disabled', true);
  // alert('asdfsa');
  //alert($(this).attr('value'));
  $('#keteranganModal').modal('show')
          .find('#keteranganContent')
          .load($(this).attr('value'));
  //$('#tambah_kegiatan_form').trigger("reset");
  $('#keteranganSave').attr('disabled', false);
});

$("#keteranganSave").click(function(){
  $('#keteranganSave').attr('disabled', true);
  var alamat = $('#keterangan_kegiatan_form').attr('action');
  //alert(alamat);
  $.ajax({ 
    type: "POST",
    url:alamat,
    data:$("#keterangan_kegiatan_form").serialize(),
    success: function(isi){
      $('#keteranganContent').html(isi);
      $('#keteranganModal').on('hidden.bs.modal', function () {
          //window.location.reload(true);
          //alert('asdfas');
          //$("#program-wrap .dat-col.active .dat-program").trigger('click');
      })
    },
    error: function(){
      alert("Gagal Tambah Kegiatan");
      $('#keteranganSave').attr('disabled', false);
    }
  });
});