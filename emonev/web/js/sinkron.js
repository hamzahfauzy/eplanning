$('#tbl_link').click(function(event) {
    event.preventDefault();
    window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
});


$("#kirism").click(function(){
	$.getScript("http://eplanning.sumutprov.go.id/emusrenbang/web/index.php?r=load-kota&Tahun=2017&Kd_Prov=12&Kd_Kab=72&url=http://dev.pemkomedan.go.id/emusrenbang/web/index.php?r=pra-rka-prov/kirim-data", function(data, status){
    alert(status+" "+data);
	})
});
