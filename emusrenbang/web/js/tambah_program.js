$("#kd_urusan").change(function(){
	var Kd_Urusan = $(this).val();
	//alert(Kd_Urusan);
	$.ajax({ 
    type: "GET",
    url:'index.php?r=ref-program/get-bidang',
    data:{Kd_Urusan:Kd_Urusan},
    success: function(isi){
    	$("#kd_bidang").html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
});

$("#kd_bidang").change(function(){
	var ket=$("#kd_bidang option:selected").text();
    //$('#ket_prg').val("");
    //$('#kd_unit').val(ket);
    var Kd_Urusan = $("#kd_urusan").val();
    var Kd_Bidang = $(this).val();
  //alert(Kd_Urusan);
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ref-program/get-unit',
    data:{Kd_Urusan:Kd_Urusan,Kd_Bidang:Kd_Bidang},
    success: function(isi){
      $("#kd_unit").html(isi);
      //console.log(isi);
    },
    error: function(){
      alert("failure");
    }
  });
});

$("#kd_unit").change(function(){
    //$('#ket_prg').val("");
    //$('#kd_unit').val(ket);
    var Kd_Urusan = $("#kd_urusan").val();
    var Kd_Bidang = $("#kd_bidang").val();
    var Kd_Unit = $("#kd_unit").val();
  //alert(Kd_Urusan);
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ref-program/get-sub',
    data:{Kd_Urusan:Kd_Urusan,Kd_Bidang:Kd_Bidang,Kd_Unit:Kd_Unit},
    success: function(isi){
      $("#kd_sub_unit").html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
});


$(".selects").select2({
  allowClear: true
});


$('#kd_prog').change(function(){
    var ket=$("#kd_prog option:selected").text();
    //$('#ket_prg').val("");
    $('#ket_prog').val(ket);
})

// $("#kd_bidang").change(function(){
// 	var Kd_Urusan = $("#kd_urusan").val();
// 	var Kd_Bidang = $(this).val();
// 	//alert(Kd_Urusan+" "+Kd_Bidang);
// 	$.ajax({ 
//     type: "GET",
//     url:'index.php?r=ref-program/get-kd-prog',
//     data:{Kd_Urusan:Kd_Urusan, Kd_Bidang:Kd_Bidang},
//     success: function(isi){
//     	$("#kd_prog").val(isi);
//     },
//     error: function(){
//       alert("failure");
//     }
//   });
// });