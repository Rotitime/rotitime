var csrfTokenPage = $('meta[name="csrf-token"]').attr("content");

$(document).ready(function(){		 		
$(".delivery").click(function(){

	var deliveryType					  = $(this).val();
	$("#deliveryType").val(deliveryType);
	
	if(deliveryType =="N")		
	{
		$(".delType").hide();
	} else {
		$(".delType").show();
    }
});
 });

	$(document).ready(function(){		 
	$("#ressubmitbutton").click(function(){
	var homeUrl                                         = $("#homeUrl").val();
	var restaurant_name                 	            = $("#restaurant_name").val();
	var restaurant_name_hidden            	            = $("#restaurant_name_hidden").val();
	var restaurant_image               		            = $("#restaurant_image").val();
	var restaurant_logo_image                           = $("#restaurant_logo_image").val();
	var restaurant_city                		            = $("#restaurant_city").val();
	var restaurant_type_english        		            = $("#restaurant_type_english").val();    
	var restaurant_discount            	                = $("#restaurant_discount").val();
	var is_restaurant_premium          		            = $("#is_restaurant_premium").val();
	var is_restaurant_active           		            = $("#is_restaurant_active").val();
	var is_delivery_availabe1                           = $("#is_delivery_availabe1").val();
	var is_delivery_availabe2                           = $("#is_delivery_availabe2").val();	
	var minimum_order_delivery_time_in_minutes          = $("#minimum_order_delivery_time_in_minutes").val();    

	var delivery_selected = $("input[name='is_delivery_availabe']:checked").val();


	  $("#restaurant_name_validation").hide();
	  $("#same_name_validation").hide();
	  $("#restaurant_image_validation").hide();
	  $("#image_extension_validation").hide();
	  $("#restaurant_logo_image_validation").hide();
	  $("#logo_image_extension_validation").hide();
	  $("#restaurant_city_validation").hide();
	  $("#restaurant_type_english_validation").hide();
	  $("#restaurant_discount_validation").hide();
	  $("#is_restaurant_premium_validation").hide();
	  $("#is_restaurant_active_validation").hide();
	  $("#is_delivery_availabe_validation").hide();
	  $("#minimum_order_delivery_time_in_minutes_validation").hide();
	  $("#order_delivery_time_in_minutes_validation").hide();
	  
	  
	  	var check_in_res = "No";

	  
    if(restaurant_name != restaurant_name_hidden)
	{
		check_in_res = "Yes";

	} 

    if(restaurant_name== "")
	{
		$("#restaurant_name").focus();
		  $("#restaurant_name_validation").show();
		return  false;

	}


	if(restaurant_image=="")
	{
		$("#restaurant_image").focus();
		  $("#restaurant_image_validation").show();
		return  false;

	}
	 var fileInput = document.getElementById('restaurant_image');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#restaurant_image").focus();
	    $("#image_extension_validation").show();
			return false;
		}
	
	if(restaurant_logo_image=="")
	{
		$("#restaurant_logo_image").focus();
		$("#restaurant_logo_image_validation").show();
		return  false;

	}
	 var fileInputLogo = document.getElementById('restaurant_logo_image');
		var filePathLogo = fileInputLogo.value;
		var allowedExtensionsLogo = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensionsLogo.exec(filePathLogo)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInputLogo.value = '';
		$("#restaurant_logo_image").focus();	
		$("#logo_image_extension_validation").show();
			return false;
		}
	
	if(restaurant_city=="")
	{
		$("#restaurant_city").focus();
		  $("#restaurant_city_validation").show();
		return  false;

	}


	if(restaurant_type_english=="")
	{ 
		$("#restaurant_type_english").focus();
		  $("#restaurant_type_english_validation").show();
		return  false;
	}
	/*if(restaurant_discount=="")
	{
		$("#restaurant_discount").focus();
		  $("#restaurant_discount_validation").show();
		return  false;
	}*/

    if($('input[type=radio][name=is_restaurant_premium]:checked').length == 0)
     {
	  $("#is_restaurant_premium").focus();
	  $("#is_restaurant_premium_validation").show();
         return false;
     }	

    if($('input[type=radio][name=is_restaurant_active]:checked').length == 0)
     {
	  $("#is_restaurant_active").focus();
	  $("#is_restaurant_active_validation").show();
         return false;
     }	
	 
    if($('input[type=radio][name=is_delivery_availabe]:checked').length == 0)
     {
	  $("#is_delivery_availabe1").focus();
	  $("#is_delivery_availabe_validation").show();
         return false;
     }

	if(delivery_selected =="Y" && minimum_order_delivery_time_in_minutes=="")
	{

		$("#minimum_order_delivery_time_in_minutes").focus();
		$("#minimum_order_delivery_time_in_minutes_validation").show();		
		return  false;
	}
	
    if(minimum_order_delivery_time_in_minutes >= 101)
    {
 		$("#minimum_order_delivery_time_in_minutes").focus();
		$("#order_delivery_time_in_minutes_validation").show();		
      return false;		
    }

posturl = homeUrl+"as/check-restaurant-name-exists";
		

	$.post(
	  posturl, {	
	  
	  restaurant_name: restaurant_name,	
	  check_in_res:check_in_res,
	  _csrf: csrfTokenPage		
	  
	},	
	function (ResponseData){
	if($.trim(ResponseData) == "exist") {
		$("#restaurant_name").focus();
		$("#same_name_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#addRestaurantForm").submit();
	} 

	
	}
	
	);
	});
	});

$(document).ready(function(){		 
	$("#editrestaurant").click(function(){
	var homeUrl                                         = $("#homeUrl").val();
	var restaurant_name                 	            = $("#restaurant_name").val();
	var restaurant_name_hidden         	                = $("#restaurant_name_hidden").val();
	var restaurant_image               		            = $("#restaurant_image").val();
	var image_type                         	            = $("#image_type").val();
	var restaurant_logo_image                           = $("#restaurant_logo_image").val();
	var logo_image                                      = $("#logo_image").val();
	var restaurant_city                		            = $("#restaurant_city").val();
	var restaurant_type_english        		            = $("#restaurant_type_english").val();    
	var restaurant_discount            	                = $("#restaurant_discount").val();
	var is_restaurant_premium          		            = $("#is_restaurant_premium").val();
	var is_restaurant_active           		            = $("#is_restaurant_active").val();
	var is_delivery_availabe1                           = $("#is_delivery_availabe1").val();
	var is_delivery_availabe2                           = $("#is_delivery_availabe2").val();		
	var minimum_order_delivery_time_in_minutes          = $("#minimum_order_delivery_time_in_minutes").val();   


	var delivery_selected = $("input[name='is_delivery_availabe']:checked").val();


	  $("#same_name_validation").hide();
	  $("#restaurants_image_validation").hide();
	  $("#restaurants_logo_image_validation").hide();
	  $("#restaurants_city_validation").hide();
	  $("#restaurants_type_english_validation").hide();
	  $("#restaurants_discount_validation").hide();
	  $("#is_restaurants_premium_validation").hide();
	  $("#is_restaurants_active_validation").hide();
	  $("#is_delivery_availabe_validation").hide();
	  $("#minimum_order_delivery_time_in_minutes_validation").hide();
	  $("#order_delivery_time_in_minutes_validation").hide();


	  
	  	var check_in_res = "No";

    if(restaurant_name== "")
	{
		$("#restaurant_name").focus();
		  $("#restaurant_name_validation").show();
		return  false;

	}
	
    if(restaurant_name != restaurant_name_hidden)
	{
		check_in_res = "Yes";

	} 


	if(restaurant_image=="" && image_type != 'edit')
	{
		$("#restaurant_image").focus();
		$("#restaurants_image_validation").show();
		return  false;
	}
	
	if(restaurant_image !="")
	{
	 var fileInput = document.getElementById('restaurant_image');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#restaurant_image").focus();
	    $("#image_extension_validation").show();
			return false;
		}

	}
	
	if(restaurant_logo_image=="" && logo_image != 'edit_1')
	{
		$("#restaurant_logo_image").focus();
		$("#restaurants_logo_image_validation").show();
		return  false;
	}

	if(restaurant_logo_image !="")
	{
	 var fileInputLogo = document.getElementById('restaurant_logo_image');
		var filePathLogo = fileInputLogo.value;
		var allowedExtensionsLogo = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensionsLogo.exec(filePathLogo)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInputLogo.value = '';
		$("#restaurant_logo_image").focus();	
		$("#logo_image_extension_validation").show();
			return false;
		}

	}	

	if(restaurant_city=="")
	{
		$("#restaurant_city").focus();
		  $("#restaurants_city_validation").show();
		return  false;

	}


	if(restaurant_type_english=="")
	{ 
		$("#restaurant_type_english").focus();
		  $("#restaurants_type_english_validation").show();
		return  false;
	}

    if($('input[type=radio][name=is_restaurant_premium]:checked').length == 0)
     {
	  $("#is_restaurant_premium").focus();
	  $("#is_restaurant_premium_validation").show();
         return false;
     }	

    if($('input[type=radio][name=is_restaurant_active]:checked').length == 0)
     {
	  $("#is_restaurant_active").focus();
	  $("#is_restaurant_active_validation").show();
         return false;
     }	
	 
    if($('input[type=radio][name=is_delivery_availabe]:checked').length == 0)
     {
	  $("#is_delivery_availabe1").focus();
	  $("#is_delivery_availabe_validation").show();
         return false;
     }

	if(delivery_selected =="Y" && minimum_order_delivery_time_in_minutes=="")
	{

		$("#minimum_order_delivery_time_in_minutes").focus();
		$("#minimum_order_delivery_time_in_minutes_validation").show();		
		return  false;
	}
    if(minimum_order_delivery_time_in_minutes >= 101)
    {
 		$("#minimum_order_delivery_time_in_minutes").focus();
		$("#order_delivery_time_in_minutes_validation").show();		
      return false;		
    }
	
posturl = homeUrl+"as/check-restaurant-name-exists";
		

	$.post(
	  posturl, {	
	  
	  restaurant_name: restaurant_name,
	  check_in_res:check_in_res,
	  _csrf: csrfTokenPage		
	  
	},	
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
		$("#restaurant_name").focus();
		$("#same_name_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#restaurantEdit").submit();
	}


	}

	);

	});
	});


	
	$(document).ready(function(){		 
	$("#submitgreybutton").click(function(){
	var homeUrl                           = $("#homeUrl").val();
    var display_sequence_number_hidden    = $("#display_sequence_number_hidden").val();
	var grey_button_title                 = $("#grey_button_title").val();
	var grey_button_type                  = $("#grey_button_type").val();
	var display_sequence_number           = $("#display_sequence_number").val();
	

	  $("#sequence_number_validation").hide();
	  $("#grey_button_title_validation").hide();
	  $("#grey_button_type_validation").hide();
	  $("#display_sequence_number_validation").hide();
	  $("#sequence_number_greaterthan").hide();
	
	var check_in_db = "No";
	


	if(grey_button_title=="")
	{
	  $("#grey_button_title").focus();
	  $("#grey_button_title_validation").show();
	  return false;

	}


	if(grey_button_type=="")
	{
		$("#grey_button_type").focus();
		  $("#grey_button_type_validation").show();
		return  false;

	}

	if(display_sequence_number=="")
	{
		$("#display_sequence_number").focus();
		$("#display_sequence_number_validation").show();
		return  false;

	}

	if(display_sequence_number<=0) {
		$("#display_sequence_number").focus();
		$("#sequence_number_greaterthan").show();
		return  false;
	}
	
	if(display_sequence_number != display_sequence_number_hidden)
	{
		check_in_db = "Yes";

	}

	

	posturl = homeUrl+"as/display-sequence-number-exists";


	$.post(
	posturl, {

	display_sequence_number: display_sequence_number,
	check_in_db:check_in_db,
	_csrf: csrfTokenPage		
	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
	    $("#display_sequence_number").focus();
		$("#sequence_number_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#addGreyButtonForm").submit();
	}


	}

	);
	});
	});
	
	$(document).ready(function(){		 
	$("#editgreybutton").click(function(e){
		
	var homeUrl                           = $("#homeUrl").val();
	var display_sequence_number_hidden    = $("#display_sequence_number_hidden").val();
	var grey_button_title                 = $("#grey_button_title").val();
	var grey_button_type                  = $("#grey_button_type").val();
	var display_sequence_number           = $("#display_sequence_number").val();
	

	  $("#sequence_number_validation").hide();
	  $("#grey_button_title_validation").hide();
	  $("#grey_button_type_validation").hide();
	  $("#display_sequence_number_validation").hide();
	  $("#sequence_number_greaterthan").hide();
	
	var check_in_db = "No";
	


	if(grey_button_title=="")
	{
	  $("#grey_button_title").focus();
	  $("#grey_button_title_validation").show();
	  return false;

	}


	if(grey_button_type=="")
	{
		$("#grey_button_type").focus();
		  $("#grey_button_type_validation").show();
		return  false;

	}

	if(display_sequence_number=="")
	{
		$("#display_sequence_number").focus();
		$("#display_sequence_number_validation").show();
		return  false;

	}

	if(display_sequence_number<=0) {
		$("#display_sequence_number").focus();
		$("#sequence_number_greaterthan").show();
		return  false;
	}
	
	if(display_sequence_number != display_sequence_number_hidden)
	{
		check_in_db = "Yes";

	}

	

	posturl = homeUrl+"as/display-sequence-number-exists";

	$.post(
	posturl, {

	display_sequence_number: display_sequence_number,
	check_in_db:check_in_db,
	_csrf: csrfTokenPage		

	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
	    $("#display_sequence_number").focus();
		$("#sequence_number_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#editGreyButtonForm").submit();
	}


	}

	);

	});
	});
	
	$(document).ready(function(){		 
	$("#addrestaurantwetrust").click(function(){
	var homeUrl                        = $("#homeUrl").val();
	var we_trust_title                 = $("#we_trust_title").val();
	var we_trust_type                  = $("#we_trust_type").val();
	var we_trust_sequence_number       = $("#we_trust_sequence_number").val();
	


	  $("#we_trust_title_validation").hide();
	  $("#we_trust_type_validation").hide();
	  $("#we_trust_sequence_number_validation").hide();
	  $("#we_trust_same_number_validation").hide();

		check_in_trust = "No";
	 	

	if(we_trust_title=="")
	{
	  $("#we_trust_title").focus();
	  $("#we_trust_title_validation").show();
	  return false;

	}


	if(we_trust_type=="")
	{
		$("#we_trust_type").focus();
		  $("#we_trust_type_validation").show();
		return  false;

	}
	if(we_trust_sequence_number  =="")
	{
		$("#we_trust_sequence_number").focus();
		  $("#we_trust_sequence_number_validation").show();
		return  false;

	}
	if(we_trust_sequence_number != we_trust_sequence_number_hidden)
	{
		check_in_trust = "Yes";
	}
	posturl = homeUrl+"as/trust-sequence-number-exists";


	$.post(
	posturl, {

	we_trust_sequence_number: we_trust_sequence_number,
	check_in_trust:check_in_trust,
	_csrf: csrfTokenPage		

	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
		$("#we_trust_sequence_number").focus();
		$("#we_trust_same_number_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#addRestaurantWeTrustForm").submit();
	}


	}

	);

	});
	});
	

	$(document).ready(function(){		 
	$("#editrestaurantwetrust").click(function(){
	var homeUrl                            = $("#homeUrl").val();
	var we_trust_sequence_number_hidden    = $("#we_trust_sequence_number_hidden").val();
	var we_trust_title                     = $("#we_trust_title").val();
	var we_trust_type                      = $("#we_trust_type").val();
	var we_trust_sequence_number           = $("#we_trust_sequence_number").val();
	


	  $("#we_trust_title_validation").hide();
	  $("#we_trust_sequence_number_greaterthan").hide();
	  $("#we_trust_type_validation").hide();
	  $("#we_trust_sequence_number_validation").hide();
	  $("#we_trust_same_number_validation").hide();

	  
		var check_in_trust = "No";


	if(we_trust_title=="")
	{
	  $("#we_trust_title").focus();
	  $("#we_trust_title_validation").show();
	  return false;

	}


	if(we_trust_type=="")
	{
		$("#we_trust_type").focus();
		  $("#we_trust_type_validation").show();
		return  false;

	}
	
	if(we_trust_sequence_number=="")
	{
		$("#we_trust_sequence_number").focus();
		$("#we_trust_sequence_number_validation").show();
		return  false;

	}
	if(we_trust_sequence_number != we_trust_sequence_number_hidden)
	{
		check_in_trust = "Yes";
	}
	
	posturl = homeUrl+"as/trust-sequence-number-exists";


	$.post(
	posturl, {

	we_trust_sequence_number: we_trust_sequence_number,
	check_in_trust:check_in_trust,
	_csrf: csrfTokenPage		

	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
		$("#we_trust_sequence_number").focus();
		$("#we_trust_same_number_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#editRestaurantWeTrustForm").submit();
	}


	}

	);

	});
	});
	
	$(document).ready(function(){		 
	$("#addsectionimage").click(function(){
		
	var homeUrl                                         = $("#homeUrl").val();
	var section_image                                   = $("#section_image").val();
	var section_image_sequence_number_hidden            = $("#section_image_sequence_number_hidden").val();
	var section_image_text                            	= $("#section_image_text").val();		
	var section_id                                      = $("#section_id").val();
	var section_category                                = $("#section_category").val();
	var section_image_sequence_number                   = $("#section_image_sequence_number").val();


		var check_in_image = "No";


	  $("#section_image_validation").hide();
	  $("#section_image_extension_validation").hide();
	  $("#section_image_text_validation").hide();
	  $("#section_category_valid").hide();
	  $("#section_image_sequence_number_validation").hide();
	  $("#section_category_validation").hide();	
	  $("#section_image_sequence_number_greaterthan").hide();
	  $("#section_image_same_number_validation").hide();	  
	  

	if(section_image=="")
	{
	  $("#section_image").focus();
	  $("#section_image_validation").show();
	  return false;

	}
	
	 var fileInput = document.getElementById('section_image');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#section_image").focus();
	    $("#section_image_extension_validation").show();
			return false;
		}
		
	if(section_image_text=="")
	{
		$("#section_image_text").focus();
		  $("#section_image_text_validation").show();
		return  false;

	}

	if(section_id=="")
	{
		$("#section_id").focus();
		  $("#section_category_valid").show();
		return  false;

	}
	if(section_category=="")
	{
		$("#section_category").focus();
		  $("#section_category_validation").show();
		return  false;

	}
	
	if(section_image_sequence_number=="")
	{
		$("#section_image_sequence_number").focus();
		$("#section_image_sequence_number_validation").show();
		return  false;

	}

	
	if(section_image_sequence_number != section_image_sequence_number_hidden)
	{
		check_in_image = "Yes";
	}	
	

	posturl = homeUrl+"as/section-image-sequence-number-exists";


	$.post(
	posturl, {

	section_image_sequence_number: section_image_sequence_number,
	check_in_image:check_in_image,
	section_id:section_id,
	_csrf: csrfTokenPage		

	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
		$("#section_image_sequence_number").focus();
		$("#section_image_same_number_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#addHomePageImageForm").submit();
	}


	}

	);
	});
	});
	
	$(document).ready(function(){		 
	$("#edithomepageimage").click(function(){

	var homeUrl                                         = $("#homeUrl").val();
	var section_image                                   = $("#section_image").val();
	var section_image_sequence_number_hidden            = $("#section_image_sequence_number_hidden").val();
	var page_type                                   	= $("#page_type").val();
	var section_image_text                            	= $("#section_image_text").val();		
	var section_id                                      = $("#section_id").val();
	var section_category                                = $("#section_category").val();
	var section_image_sequence_number                   = $("#section_image_sequence_number").val();


		var check_in_image = "No";


	  $("#section_image_validation").hide();
	  $("#section_image_text_validation").hide();
	  $("#section_category_valid").hide();
	  $("#section_image_sequence_number_validation").hide();
	  $("#section_category_validation").hide();	
	  $("#section_image_sequence_number_greaterthan").hide();
	  $("#section_image_same_number_validation").hide();	  
	  

	if(section_image=="" && page_type != 'edit')
	{
	  $("#section_image").focus();
	  $("#section_image_validation").show();
	  return false;

	}
	
	
	if(section_image !="")
	{
	 	var fileInput = document.getElementById('section_image');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#section_image").focus();
	    $("#section_image_extension_validation").show();
			return false;
		}	
	}
	
	if(section_image_text=="")
	{
		$("#section_image_text").focus();
		  $("#section_image_text_validation").show();
		return  false;

	}

	if(section_id=="")
	{
		$("#section_id").focus();
		  $("#section_category_valid").show();
		return  false;

	}
	
	if(section_category=="")
	{
		$("#section_category").focus();
		  $("#section_category_validation").show();
		return  false;

	}
	
	if(section_image_sequence_number=="")
	{
		$("#section_image_sequence_number").focus();
		$("#section_image_sequence_number_validation").show();
		return  false;

	}

	
	if(section_image_sequence_number != section_image_sequence_number_hidden)
	{
		check_in_image = "Yes";
	}	
	

	posturl = homeUrl+"as/section-image-sequence-number-exists";


	$.post(
	posturl, {

	section_image_sequence_number: section_image_sequence_number,
	check_in_image:check_in_image,
	section_id:section_id,
	_csrf: csrfTokenPage		

	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
		$("#section_image_sequence_number").focus();
		$("#section_image_same_number_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#editHomePageImageForm").submit();
	}


	}

	);

	});
	});
	


	
	function fnDeleteRestaurantRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}


	$(document).ready(function(){
		  $("#confirmDeleteRestaurantRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"as/delete-restaurant";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,
       	_csrf: csrfTokenPage		
		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});
	
	function fnDeleteRestaurantWeTrustRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}


	$(document).ready(function(){
		  $("#confirmDeleteRestaurantWeTrustRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"as/delete-restaurant-we-trust";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,	
	      _csrf: csrfTokenPage			  		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});
	
	
	function fnDeleteGreyButtonRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}


	$(document).ready(function(){
		  $("#confirmDeleteGreyButtonRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"as/delete-grey-button";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,	
     	  _csrf: csrfTokenPage			  
		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});
	
	function fnDeleteHomePageSectionImageRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}


	$(document).ready(function(){
		  $("#confirmDeleteHomePageSectionRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"as/delete-home-page-image";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,	
     	  _csrf: csrfTokenPage			  
		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});
	
	
	function fnDeletePopularRestaurantRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}


	$(document).ready(function(){
		  $("#confirmDeletePopularRestaurantRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"as/delete-popular";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,	
    	  _csrf: csrfTokenPage			  
		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});
	
	
	
	
	var csrfTokenPage = $('meta[name="csrf-token"]').attr("content");

$(document).ready(function(){
	  $("#precise_location").click(function(){
		var homeUrl = $("#homeUrl").val();
     
		  posturl = homeUrl+"site/get-user-location";
		

	$.post(
	  posturl, {		
	  _csrf: csrfTokenPage	  
	},	
	function (ResponseData){
		alert(ResponseData);
		if($.trim(ResponseData) === 'sucess') {
			location.reload();
			} 
		});  
	});
});


	$(document).ready(function(){
		  $("#find_dish").click(function(){
		 
		var dish_name = $("#dish_name").val();
	posturl = "search-restaurants";
	
        $.post(
	  posturl, {		
	   dish_name: dish_name,
	  _csrf: csrfTokenPage			  

	},
      )
		});
	});

function fnUpdateLink(redirectLink) {
	
	var selectedRestId = $("#selectedRestId").val();
	if(selectedRestId == '') {
		alert("Please select Restaurant");
		return false;
	}
	var relativeUrl = $("#relativeUrl").val();
	window.location.href = relativeUrl+"am/select-page" + "?restaurant_id=" + selectedRestId+"&page_type="+redirectLink;
}

function fnGetCityRestaurants() {
	var restaurant_city = $("#restaurant_city").val();

	var homeUrl = $("#relativeUrl").val();

	posturl = homeUrl+"as/select-city-restaurant";
			
		$.post(
		  posturl, {		
		  restaurant_city: restaurant_city,	
	     _csrf: csrfTokenPage				  
		},	
		function (ResponseData){
			$("#selectRestaurant").html(ResponseData);
		}); 

}


	$(document).ready(function(){		 
	$("#submitbuttonowner").click(function(){

	var homeUrl                         = $("#homeUrl").val();		
	var register_email                  = $("#register_email").val();
	var owner_first_name                = $("#owner_first_name").val();
	var owner_last_name                 = $("#owner_last_name").val();		
	var password_encrypted              = $("#password_encrypted").val();	
	var re_enter_password               = $("#re_enter_password").val();
    var user_role                       = $("#user_role").val();		
	var owner_note                      = $("#owner_note").val();	
	

	  $("#owner_emails_validation").hide();
	  $("#email_format_validation").hide();
	  $("#same_emails_validation").hide();
	  $("#owner_first_name_validation").hide();
	  $("#owner_last_name_validation").hide();
	  $("#password_encrypted_validation").hide();
	  $("#re_enter_password_validation").hide();
	  $("#password_validation").hide();
	  $("#user_role_validation").hide();

	
	if(register_email=="")
	{
	  $("#register_email").focus();
	  $("#owner_emails_validation").show();
	  return false;

	}
	if(IsEmail(register_email)==false){
	$("#register_email").focus();
	  $('#email_format_validation').show();
	  return false;
	}
	function IsEmail(register_email) {
	  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  if(!regex.test(register_email)) {
		return false;
	  }else{
		return true;
	  }
	}	

	if(owner_first_name=="")
	{
		$("#owner_first_name").focus();
		  $("#owner_first_name_validation").show();
		return false;

	}
	
	if(owner_last_name=="")
	{
		$("#owner_last_name").focus();
		$("#owner_last_name_validation").show();
		return false;

	}

	if(password_encrypted=="")
	{
		$("#password_encrypted").focus();
		$("#password_encrypted_validation").show();
		return false;

	}
	
	if(re_enter_password=="")
	{
		$("#re_enter_password").focus();
		$("#re_enter_password_validation").show();
		return false;

	}

	
	if(password_encrypted != re_enter_password)
	{
		$("#password_encrypted").focus();
		$("#password_validation").show();
		return false;

	}
	
	if(user_role=="")
	{
		$("#user_role").focus();
		  $("#user_role_validation").show();
		return false;

	}

	posturl = homeUrl+"ab/check-value-exists-in-table";


	$.post(
	posturl, {

	register_email: register_email,	
	_csrf: csrfTokenPage		
	},
		function (ResponseData){
		if($.trim(ResponseData) === 'exist') {
			$("#register_email").focus();
			$("#same_emails_validation").show();
          e.preventDefault();
		return false;
	} else {
		$("#ownerSubmitForm").submit();
	}


	}

	);

	});
	});
	
	
$(document).ready(function(){		 
$("#submitbuttongallery").click(function(){
	
	var restaurant_id            = $("#restaurant_id").val();
	var files                    = $("#files").val();
	
	
	   $("#restaurant_name_valids").hide();
	   $("#restaurants_gallery_image_validation").hide();

		
	if(restaurant_id=="")
	{
	$("#restaurant_id").focus();
	$("#restaurant_name_valids").show();
	return false;

	}
		
	if(files=="")
	{
	  $("#files").focus();
	  $("#restaurants_gallery_image_validation").show();
	  return false;

	}
 	if(files !="")
	{
	 	var fileInput = document.getElementById('files');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#files").focus();
	    $("#gallery_image_extension_validation").show();
			return false;
		}	
	}
	$("#addRestaurantGalleryForm").submit();
			 

});
});

$(document).ready(function(){		 
$("#submitbuttoneditgallery").click(function(){

	var restaurant_id                    = $("#restaurant_id").val();
	var files                            = $("#files").val();
	var gallery_image_type               = $("#gallery_image_type").val();
	
	   $("#restaurant_name_valids").hide();
	   $("#restaurants_gallery_image_validation").hide();
	   $("#gallery_image_extension_validation").hide();

//var file = this.files[0];

		
	if(restaurant_id=="")
	{
		$("#restaurant_id").focus();
		$("#restaurant_name_valids").show();
		return  false;
	}
	if(files !="")
	{
	 	var fileInput = document.getElementById('files');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#files").focus();
	    $("#gallery_image_extension_validation").show();
			return false;
		}	
	}

	if(files=="" && gallery_image_type != 'edit')
	{
		$("#files").focus();
		$("#restaurants_gallery_image_validation").show();
		return  false;
	}
	
		$("#editRestaurantGalleryForm").submit();
	

});
});

	$(document).on('click', '#removeImage', function () {
		$(this).closest('#inputFormImage').remove();
				location.reload();
	});

/*function fnDeleteRowGallery(rowId) {
	//return false;
	var restaurants_gallery_id = rowId;
alert(restaurants_gallery_id);

		posturl = "delete-gallery-row";


	$.post(
	posturl, {

	restaurants_gallery_id: restaurants_gallery_id,	
	},
		function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  

}*/

function fnDeleteRowGallery(rowId) {
	
	 var result = confirm("Are you sure you want to delete?");
	 var restaurants_gallery_id = rowId;
	var homeUrl = $("#homeUrl").val();

	if (result){	
		posturl = homeUrl+"as/delete-gallery-row";


	$.post(
	posturl, {

	restaurants_gallery_id: restaurants_gallery_id,
	_csrf: csrfTokenPage			  
	
	},
		function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});
	}
}
	
function fnDeleteGallery(rowId) {
	
	$("#deleteRestaurantGalleryId").val(rowId);
}


    $(document).ready(function(){
	  $("#confirmDeleteGallery").click(function(){
     
	var deleteRestaurantGalleryId = $("#deleteRestaurantGalleryId").val();

	var homeUrl = $("#homeUrl").val();
	posturl = homeUrl+"as/delete-restaurants-gallery";
		

	$.post(
	  posturl, {		
	  deleteRestaurantGalleryId: deleteRestaurantGalleryId,	
	  _csrf: csrfTokenPage			  
	  
	},	
	function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  


	    });
    });

	function fnDeleteRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}


	$(document).ready(function(){
		  $("#confirmDeleteRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"as/delete-districts-attached";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,
     	  _csrf: csrfTokenPage			  
		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});
	
$("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="attached_district[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

	// remove row
	$(document).on('click', '#removeRow', function () {
		
		$(this).closest('#inputFormRow').remove();
	});
	
/*$(document).ready(function() {
  $('input[type="file"]').on("change", function() {
    let filenames = [];
    let files = document.getElementById("customFile").files;
    if (files.length > 1) {
      filenames.push("Total Files (" + files.length + ")");
    } else {
      for (let i in files) {
        if (files.hasOwnProperty(i)) {
          filenames.push(files[i].name);
        }
      }
    }
    $(this)
      .next(".custom-file-label")
      .html(filenames.join(","));
  });
});*/


		
	
$(document).ready(function() {
 
 var endLimit = 3;
 var startLimit = 0;
 var action = 'inactive';
 function load_country_data(endLimit, startLimit)
 {
  $.ajax({
   url:"http://zefasa.com/rotitime/web/ab/fetch",
   method:"POST",
   data:{endLimit:endLimit, startLimit:startLimit},
   cache:false,
   success:function(data)

   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
     action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_country_data(endLimit, startLimit);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   startLimit = startLimit + endLimit;
   setTimeout(function(){
    load_country_data(endLimit, startLimit);
   }, 1000);
  }
 });
 
});



 
 
 	$(document).ready(function(){		 
	$("#reviewsubmit").click(function(){
alert("test");
return false;
	var name                 = $("#name").val();
	var rating               = $("#rating").val();
	var reviews              = $("#reviews").val();
	


	  $("#name_validation").hide();
	  $("#rating_validation").hide();
	  $("#reviews_validation").hide();

	 	

	if(name=="")
	{
	  $("#name").focus();
	  $("#name_validation").show();
	  return false;

	}


	if(rating=="")
	{
		$("#rating").focus();
		  $("#rating_validation").show();
		return  false;

	}
	if(reviews =="")
	{
		$("#reviews").focus();
		  $("#reviews_validation").show();
		return  false;

	}
	
	
		$("#addReviewForm").submit();
	
	});
	});
	


		