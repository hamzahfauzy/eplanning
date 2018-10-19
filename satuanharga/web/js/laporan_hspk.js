$("#btn-cetak").click(function(){
	var Kd_Hspk1 = $("#Kd_Hspk1").val();
	window.open('index.php?r=laporan/hspk-cetak&Kd_Hspk1='+Kd_Hspk1, '_blank');
});