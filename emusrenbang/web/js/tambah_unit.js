$("#kd_bidang").change(function(){
	var Kd_Bidang = $(this).val();
//	alert(Kd_Bidang);
	$.ajax({ 
    type: "GET",
    url:'index.php?r=ref-program/get-unit',
    data:{Kd_Bidang:Kd_Bidang},
    success: function(isi){
    	$("#kd_unit").html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
});

$(".selects").select2({
  allowClear: true
});


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