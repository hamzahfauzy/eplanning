$("#btn_tampil_kecamatan").click(function(){
	var Kd_Kec = $('#Kd_Kec').val();
	if (Kd_Kec=='') return 0;

  	window.location.href = 'index.php?r=ta-musrenbang/dokumen-kecamatan-tampil&Kd_Kec='+Kd_Kec;

});

$("#btn_tampil_kelurahan").click(function(){
	var Kd_Kec = $('#Kd_Kec').val();
	var Kd_Kel = $('#Kd_Kel').val();
	if (Kd_Kec=='' || Kd_Kel=='') return 0;

  	window.location.href = 'index.php?r=ta-musrenbang/dokumen-kelurahan-tampil&Kd_Kec='+Kd_Kec+'&Kd_Kel='+Kd_Kel;

});

$("#btn_tampil_lingkungan").click(function(){
	var Kd_Kec = $('#Kd_Kec').val();
	var Kd_Kel = $('#Kd_Kel').val();
	var Kd_Lingkungan = $('#Kd_Lingkungan').val();
	if (Kd_Kec=='' || Kd_Kel=='' || Kd_Lingkungan=='') return 0;

  	window.location.href = 'index.php?r=ta-musrenbang/dokumen-lingkungan-tampil&Kd_Kec='+Kd_Kec+'&Kd_Kel='+Kd_Kel+'&Kd_Lingkungan='+Kd_Lingkungan;

});

$("#Kd_Kec").change(function(){
	var Kd_Kec = $(this).val();
	if (Kd_Kec==null || Kd_Kel==null) return 0;
	  //alert(alamat);
  	$('#dokumen_tampil_kecamatan').html("Loading...");
    $.ajax({ 
      type: "GET",
      url:'index.php?r=ta-musrenbang/get-kelurahan',
      // data:$("#w0").serialize(),
      data:{Kd_Kec:Kd_Kec},
      success: function(isi){
        $('#Kd_Kel').html(isi);
      },
      error: function(){
        alert("failure2");
      }
    });
});

$("#Kd_Kel").change(function(){
	var Kd_Kel = $(this).val();
	var Kd_Kec = $('#Kd_Kec').val();
	  //alert(alamat);
  	$('#dokumen_tampil_kecamatan').html("Loading...");
    $.ajax({ 
      type: "GET",
      url:'index.php?r=ta-musrenbang/get-lingkungan',
      // data:$("#w0").serialize(),
      data:{Kd_Kec:Kd_Kec,Kd_Kel:Kd_Kel},
      success: function(isi){
        $('#Kd_Lingkungan').html(isi);
      },
      error: function(){
        alert("failure1");
      }
    });
});