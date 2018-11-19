
$("#btn-simpan-revisi").click(function(){
  var value = $("#btn-simpan-revisi").attr("data-kr"),
    data = $('#revisi-form').serialize();
    $("#btn-simpan-revisi").hide();
    $('#revisi-body').html("<h3>Menyimpan...</h3>");
    $.ajax({ 
    type: "POST",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/revisi&Kd_Ta_Forum_Lingkungan=' + value,
    data:data,
    success: function(isi){
      //alert(isi);
      get_usulan();
      $('#revisi-body').html(isi);
    },
    error: function(xhr, status, error){
      $('#revisi-body').html(xhr.responseText);
    }
  });
});

$("#btn-simpan-revisi-langsung").click(function(){
  var value = $("#btn-simpan-revisi-langsung").attr("data-kr"),
    data = $('#revisi-form').serialize();
    $('#revisi-body').html("<h3>Menyimpan...</h3>");
    $("#btn-simpan-revisi-langsung").hide();
    alert(data);return;
    $.ajax({ 
    type: "POST",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/revisi-langsung&Kd_Ta_Forum_Lingkungan=' + value,
    data:data,
    success: function(data){
      //alert(isi);
      get_usulan();
      $('#revisi-body').html(data);
    },
    error: function(xhr, status, error){
      $('#revisi-body').html(xhr.responseText);
    }
  });
});

