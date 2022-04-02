$(document).ready(function(){
	$("input[type='number']").inputSpinner();

	$(".btn-increment").click(function(){
		alert("Test Incre");		
	});

	$(".btn-decrement").click(function(){
		alert("Test Decre");		
	});

});

function basketUpdate(update_type,called_from,dish_id){
	

	var dish_quantity = $("#"+called_from+"_"+dish_id).val();
	
	//Click +
	/*if(update_type == 'add') {
		update_quantity = parseInt(dish_quantity)+1;
		$("#"+called_from+"_"+dish_id).val(update_quantity);
	}
	
	//Click -
	if(update_type == 'subs' && dish_quantity > 1) {
		update_quantity = parseInt(dish_quantity)-1;
		$("#"+called_from+"_"+dish_id).val(update_quantity);
	}*/

	alert(dish_quantity);

	 posturl = "https://zefasa.com/rotitime/web/site/build-basket";
	

	$.post(
	  posturl, {		
	  dish_id: dish_id,
	  dish_quantity: dish_quantity,
	  update_type: update_type,

	},	
	function (ResponseData){

		alert(ResponseData);
		$("#sidebar_fixed").html(ResponseData);
		
	});  


}



 	$(document).ready(function(){		 
	$("#reviewsubmit").click(function(){
		
	var tap_to_rate_your_experience                 = $("#tap_to_rate_your_experience").val();
	var what_was_not_upto_the_mark               = $("#what_was_not_upto_the_mark").val();
	var your_review                           = $("#your_review").val();
	
alert(tap_to_rate_your_experience);	
alert(what_was_not_upto_the_mark);	 
alert(your_review);	 
//return false;
	
	
	});
	});
	
