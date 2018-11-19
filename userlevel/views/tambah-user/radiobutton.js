$("#opt input").on("change", function() {
   if ($("input[name='TU3Form[opt]']:checked").val() == 2){
	   $("#opt1").show();
   }else{
	   $("#opt1").hide();
   }; 
});