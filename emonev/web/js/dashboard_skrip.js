// $("#modal_warning").modal('show');

// setTimeout(function(){
// 	$("#modal_peringatan").modal('show');
// }, 2000);

// $("#tombol_kirim").click(function(){
// 	$("#modal_kirim").modal('show');
// });

function showData(type,tahun,triwulan=false)
{
	route = type == 1 ? "m-monitoring" : "m-program-kegiatan"
	param = triwulan == false ? "" : "&triwulan="+triwulan
	location="index.php?r="+route+"/index&tahun="+tahun+param
}



// $(document).ready(function() {
//     $(window).load(function() {
//         setTimeout(function(){
// 					$("#modal_kirim").modal('show');
// 				}, 2000);
//     });
// });

