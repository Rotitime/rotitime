$(document).ready(function(){
    
	hNotesCharsLimit = "300";
    var pageOpenFrom = $("#pageOpenFrom").val();
    
	
	//$('#review-in-dialog').modal('show');
    if(pageOpenFrom == 'gsignin') {
        //$("#review-in-dialog").show();
        //$('#review-in-dialog').modal('show');
		$('#review-in').click();
    }

	$('#your_review').bind('keyup change input', function() {   
            var characterLimit = hNotesCharsLimit;
            var charactersUsed = $(this).val().length;
            if (charactersUsed > characterLimit) {
                charactersUsed = characterLimit;
                $(this).val($(this).val().substr(0, characterLimit));
            }else {
				remainingCharsCnt  = characterLimit-charactersUsed
				$('#hNotesChars').html(remainingCharsCnt);
			}
		});
	

});



function basketUpdate(update_type,called_from,dish_id){
	
	
	var suplimentsSelected = $(".Checkbox_"+dish_id+":checked").map(function() {return this.value;}).get().join(',');

	if(called_from == 'display' || (called_from == 'supliment' && suplimentsSelected != '')) {

		$('#exampleModal').modal('show');
		
		$('.modal-backdrop').css("opacity", "0");

		setTimeout(function() {
			$('#exampleModal').modal('hide');
		}, 1000);

	}
    if(called_from == 'display' || called_from == 'supliment') {
        var dish_quantity = 1;    
    } else {
        var dish_quantity = $("#"+called_from+"_"+dish_id).val();
    }
    
	var restaurant_id = $("#restaurant_id").val();
	var home_url = $("#home_url").val();

	var dish_name = $("#dish_name_"+dish_id).text();
	

	if(called_from == 'supliment') {
		$("#dish_name_added").text("Supplements");
	} else {
		$("#dish_name_added").text(dish_name);
	}
	
   /* if(update_type == 'supliment') {
        var suplimentsSelected = $('.Checkbox:checked').map(function() {return this.value;}).get().join(',');
    } else {
        var suplimentsSelected = '';
    } */

    
    
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


	 posturl = home_url+"site/build-basket-by-restaurant";
	

	$.post(
	  posturl, {		
	  dish_id: dish_id,
	  restaurant_id: restaurant_id,
	  dish_quantity: dish_quantity,
      update_type: update_type,
	  called_from: called_from,
      suplimentsSelected:suplimentsSelected,
	  _csrf: csrfTokenPage,

	},	
	function (ResponseData){

		$("#sidebar_fixed").html(ResponseData);
		
	});  


}

 	
 $(".star").click(function(){
    var tap_to_rate_your_experience = $(this).data('datac');	
    //alert(tap_to_rate_your_experience);
    
    //Add star class
    for(j = 1; j<=5; j++) {
        $("#astar_"+j).addClass("selected");
    }

    //Remove star class
    for(i = (tap_to_rate_your_experience+1); i<=5; i++) {
        $("#astar_"+i).removeClass("selected");
    }

    $("#star_ratings_by_user").val(tap_to_rate_your_experience);
	});


 	$(document).ready(function(){		 
	$("#reviewsubmit").click(function(){
    
        $("#star_rating_error").hide();
        $("#your_review_error").hide();
        var tap_to_rate_your_experience     = $("#star_ratings_by_user").val();
        var review_title                    = $("#review_title").val();
        var your_review                     = $("#your_review").val();
        var restaurant_id                   = $("#restaurant_id").val();
        var review_type                     = $("#review_type").val();
        var ordered_id                     = $("#ordered_id").val();
        var home_url                     = $("#home_url").val();
        var resturant_name             = $("#resturant_name").val();
        
        if(tap_to_rate_your_experience=="")
        {
        $("#tap_to_rate_your_experience").focus();
        $("#star_rating_error").show();
        return false;
        }
        
        if(your_review=="")
        {
        $("#your_review").focus();
        $("#your_review_error").show();
        return false;
        }
        
        
        posturl = home_url+"site/add-reviews";

        $.post(	
        posturl, {
        tap_to_rate_your_experience: tap_to_rate_your_experience,
        review_title: review_title,
        your_review: your_review,
        restaurant_id:restaurant_id,
        review_type:review_type,
        ordered_id:ordered_id,
		_csrf: csrfTokenPage,
        },
            function (ResponseData){
				if(review_type === 'from-order-email') {
					window.location.href = home_url+"site/review-confirmed";
				} else {
					window.location.href = home_url+resturant_name;
				}
				
        });
        
            return false;
        
        });
	});
	
$(document).on("click","#order_page",function(){

	var confirmation_address                 = $("#confirmation_address").val();
	var confirmation_floor                   = $("#confirmation_floor").val();
	var confirmation_city                    = $("#confirmation_city").val();
	var confirmation_postal_code             = $("#confirmation_postal_code").val();
	var confirmation_name                    = $("#confirmation_name").val();
	var confirmation_email                   = $("#confirmation_email").val();
	var confirmation_phone_number            = $("#confirmation_phone_number").val();
	var confirmation_company_name            = $("#confirmation_company_name").val();
	var order_comments                             = $("#order_comments").val();
	var restaurant_id						 = $("#restaurant_id").val();
	var home_url						      = $("#home_url").val();

	
/* alert(confirmation_address);
 alert(confirmation_floor);
 alert(confirmation_city);
 alert(confirmation_postal_code);
 alert(confirmation_name);
 alert(confirmation_email);
 alert(confirmation_phone_number);
 alert(confirmation_company_name);*/

           $("#confirmation_address_validation").hide();
           $("#confirmation_floor_validation").hide();
           $("#confirmation_city_validation").hide();
           $("#confirmation_postal_code_validation").hide();
           $("#confirmation_name_validation").hide();
           $("#confirmation_email_validation").hide();
           $("#confirmation_right_email_validation").hide();
           $("#confirmation_phone_number_validation").hide();

	if(confirmation_address=="")
	{
	  $("#confirmation_address").focus();
	  $("#confirmation_address_validation").show();
	  return false;

	}
	if(confirmation_floor=="")
	{
	  $("#confirmation_floor").focus();
	  $("#confirmation_floor_validation").show();
	  return false;

	}
	if(confirmation_city=="")
	{
	  $("#confirmation_city").focus();
	  $("#confirmation_city_validation").show();
	  return false;

	}
	if(confirmation_postal_code=="")
	{
	  $("#confirmation_postal_code").focus();
	  $("#confirmation_postal_code_validation").show();
	  return false;

	}
	if(confirmation_name=="")
	{
	  $("#confirmation_name").focus();
	  $("#confirmation_name_validation").show();
	  return false;

	}
	if(confirmation_email=="")
	{
	  $("#confirmation_email").focus();
	  $("#confirmation_email_validation").show();
	  return false;

	}
	if (!confirmation_email.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
	{
		$("#confirmation_email").focus();
	  $("#confirmation_right_email_validation").show();
	  return false;
	}
	if(confirmation_phone_number=="")
	{
	  $("#confirmation_phone_number").focus();
	  $("#confirmation_phone_number_validation").show();
	  return false;

	}



	
 	posturl = home_url+"site/confirm-order";


	$.post(	
	posturl, {
	  confirmation_address: confirmation_address,
	  confirmation_floor: confirmation_floor,
	  confirmation_city: confirmation_city,
	  confirmation_postal_code: confirmation_postal_code,
	  confirmation_name: confirmation_name,
	  confirmation_email: confirmation_email,
	  confirmation_phone_number: confirmation_phone_number,
	  confirmation_company_name: confirmation_company_name,
	  order_comments: order_comments,
	  restaurant_id: restaurant_id,
	  _csrf: csrfTokenPage,
	},
	function (ResponseData){
			window.location.href = home_url+"site/order-confirmation";
	}


	

	);
		return false;
	
})

function signOut() {
	
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
	
        });
      }
		
	