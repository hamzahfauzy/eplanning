$("#form").hide();
$("#btnlogin").click(function(){
	if (!$("#form").is(':visible'))
	{
		$("#form").show();
	}else{
		$("#form").hide();
	}
});
$(".nav-tabs a").click(function(){
    $(this).tab('show');
});