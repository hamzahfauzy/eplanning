$("#provchkbox input").on("change", function() {
   if ($("input[name='TU4Form[chk][]']:checked").val() == 1){
	   $("#kota").show();
   }else{
	   $("#kota").hide();
   }; 
});