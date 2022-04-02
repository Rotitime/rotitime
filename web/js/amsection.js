var csrfTokenPage = $('meta[name="csrf-token"]').attr("content");

$(document).ready(function(){		 
    
$("#submitbuttonhomepageadd").click(function(){

var section_name_english                  = $("#section_name_english").val();
var section_name_german                   = $("#section_name_german").val();
var section_title_english                 = $("#section_title_english").val();
var section_title_german                  = $("#section_title_german").val();    
var section_image                         = $("#fileToUpload").val();
var section_image_alt_text_english        = $("#section_image_alt_text_english").val();
var section_image_alt_text_german         = $("#section_image_alt_text_german").val();
var section_image_title_text_english      = $("#section_image_title_text_english").val(); 
var section_image_title_text_german       = $("#section_image_title_text_german").val();
var section_sequence_number               = $("#section_sequence_number").val();    
var section_image_link                    = $("#section_image_link").val();

       $("#section_name_english_validation").hide();
	   $("#section_name_german_validation").hide();
	   $("#section_title_english_validation").hide();
	   $("#section_title_german_validation").hide();
	   	$("#section_image_validation").hide();
	   $("#section_image_alt_text_english_validation").hide();
	   $("#section_image_alt_text_german_validation").hide();
	   $("#section_image_title_text_english_validation").hide();
	   $("#section_image_title_text_german_validation").hide();
       $("#Section_sequence_number_validation").hide();
	   	$("#section_image_link_validation").hide();

	   
if(section_name_english=="")
{
  $("#section_name_english").focus();
  $("#section_name_english_validation").show();
  return false;

}


if(section_name_german=="")
{
	$("#section_name_german").focus();
	$("#section_name_german_validation").show();
	return  false;

}
if(section_title_english  =="")
{
	
	$("#section_title_english").focus();
	$("#section_title_english_validation").show();
	return  false;

}


if(section_title_german=="")
{ 
	$("#section_title_german").focus();
	$("#section_title_german_validation").show();
	return  false;
}
if(section_image=="")
{
	$("#section_image").focus();
	$("#section_image_validation").show();
	return  false;
}

if(section_image_alt_text_english=="")
{
	$("#section_image_alt_text_english").focus();
	$("#section_image_alt_text_english_validation").show();
	
	return  false;
}
if(section_image_alt_text_german=="")
{
	$("#section_image_alt_text_german").focus();
	$("#section_image_alt_text_german_validation").show();
	return  false;
}
if(section_image_title_text_english=="")
{
	$("#section_image_title_text_english").focus();
	$("#section_image_title_text_english_validation").show();
	return  false;
}

if(section_image_title_text_german=="")
{
	$("#section_image_title_text_german").focus();
	$("#section_image_title_text_german_validation").show();
	
	return  false;
}
if(section_sequence_number=="")
{
	$("#section_sequence_number").focus();
	$("#Section_sequence_number_validation").show();
	return  false;
}
if(section_image_link=="")
{
	$("#section_image_link").focus();
	$("#section_image_link_validation").show();
	return  false;
}


});
});



$(document).ready(function(){		 
$("#submitbuttonhomepageedit").click(function(){

var section_name_english                  = $("#section_name_english").val();
var section_name_german                   = $("#section_name_german").val();
var section_title_english                 = $("#section_title_english").val();
var section_title_german                  = $("#section_title_german").val();    
var section_image                         = $("#fileToUpload").val();
var section_image_alt_text_english        = $("#section_image_alt_text_english").val();
var section_image_alt_text_german         = $("#section_image_alt_text_german").val();
var section_image_title_text_english      = $("#section_image_title_text_english").val(); 
var section_image_title_text_german       = $("#section_image_title_text_german").val();
var section_sequence_number               = $("#section_sequence_number").val();    
var section_image_link                    = $("#section_image_link").val();
     
	 $("#section_name_english_edit_validation").hide();
	 $("#section_name_german_edit_validation").hide();
	 $("#section_title_english_edit_validation").hide();
	 $("#section_title_german_edit_validation").hide();
	$("#section_image_edit_validation").hide();
	$("#section_image_alt_text_english_edit_validation").hide();
	$("#section_image_alt_text_german_edit_validation").hide();
	$("#section_image_title_text_english_edit_validation").hide();
	$("#section_image_title_text_german_edit_validation").hide();
	$("#Section_sequence_number_edit_validation").hide();
	$("#section_image_link_edit_validation").hide();

if(section_name_english=="")
{
  $("#section_name_english").focus();
  $("#section_name_english_edit_validation").show();
  return false;

}


if(section_name_german=="")
{
	$("#section_name_german").focus();
	$("#section_name_german_edit_validation").show();
	return  false;

}
if(section_title_english  =="")
{
	
	$("#section_title_english").focus();
	$("#section_title_english_edit_validation").show();
	return  false;

}


if(section_title_german=="")
{ 
	$("#section_title_german").focus();
	$("#section_title_german_edit_validation").show();
	return  false;
}
if(section_image=="")
{
	$("#section_image").focus();
	$("#section_image_edit_validation").show();
	return  false;
}

if(section_image_alt_text_english=="")
{
	$("#section_image_alt_text_english").focus();
	$("#section_image_alt_text_english_edit_validation").show();
	
	return  false;
}
if(section_image_alt_text_german=="")
{
	$("#section_image_alt_text_german").focus();
	$("#section_image_alt_text_german_edit_validation").show();
	return  false;
}
if(section_image_title_text_english=="")
{
	$("#section_image_title_text_english").focus();
	$("#section_image_title_text_english_edit_validation").show();
	return  false;
}

if(section_image_title_text_german=="")
{
	$("#section_image_title_text_german").focus();
	$("#section_image_title_text_german_edit_validation").show();
	
	return  false;
}
if(section_sequence_number=="")
{
	$("#section_sequence_number").focus();
	$("#Section_sequence_number_edit_validation").show();
	return  false;
}
if(section_image_link=="")
{
	$("#section_image_link").focus();
	$("#section_image_link_edit_validation").show();
	return  false;
}


});
});


	$(document).ready(function(){		 
	$("#submitbuttonbanneradd").click(function(){

	var banner_image_path                       = $("#banner_image_path").val();
	var banner_type                             = $("#banner_type").val();
	var banner_image_alt_text                   = $("#banner_image_alt_text").val();
	var banner_image_title_text                 = $("#banner_image_title_text").val();
	var display_in_homepage                     = $("#display_in_homepage").val();

		$("#banner_image_path_validation").hide();
		$("#banner_image_extension_validation").hide();
		$("#banner_image_alt_text_validation").hide();
		$("#banner_image_title_text_validation").hide();
		$("#display_in_homepage_validation").hide();



	if(banner_image_path=="" && banner_type != 'edit')
	{
		$("#banner_image_path").focus();
		$("#banner_image_path_validation").show();
		return  false;
	}
	if(banner_image_path!="")
	{
		 var fileInput = document.getElementById('banner_image_path');
			var filePath = fileInput.value;
			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
			if(!allowedExtensions.exec(filePath)){
				alert('Please upload file with extension .jpeg/.jpg/.png only.');
				fileInput.value = '';
				$("#banner_image_path").focus();
				$("#banner_image_extension_validation").show();
				return  false;
			}
	}
	if(banner_image_alt_text=="")
	{
		$("#banner_image_alt_text").focus();
		$("#banner_image_alt_text_validation").show();
		return  false;
	}
	if(banner_image_title_text=="")
	{
		$("#banner_image_title_text").focus();
		$("#banner_image_title_text_validation").show();
		return  false;
	}
		if($('input[type=radio][name=display_in_homepage]:checked').length == 0)
		  {
		  $("#display_in_homepage").focus();
		  $("#display_in_homepage_validation").show();
			 return false;
		}	

	});
	});

function fnDeleteBannerImageRow(rowId) {
	
	$("#deleteRowId").val(rowId);
}


$(document).ready(function(){
	  $("#confirmDeleteBannerImageRow").click(function(){
     
	var deleteRowId = $("#deleteRowId").val();
	var homeUrl = $("#homeUrl").val();
	posturl = homeUrl+"am/delete-banner";
		

	$.post(
	  posturl, {		
	  deleteRowId: deleteRowId,
	  _csrf: csrfTokenPage,			  
	},	
	function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  


	});
});


$(document).ready(function(){		 
$("#submitbuttonowneradd").click(function(){
	
	var are_u_owner_section_image_path           = $("#are_u_owner_section_image_path").val();
	var owner_type                               = $("#owner_type").val();
	var are_u_owner_section_image_alt_text       = $("#are_u_owner_section_image_alt_text").val();
	var are_u_owner_section_image_title_text     = $("#are_u_owner_section_image_title_text").val();
	var are_u_owner_section_text                 = $("#are_u_owner_section_text").val();
	var are_u_owner_section_title                = $("#are_u_owner_section_title").val();
	var display_in_homepage                      = $("#display_in_homepage").val();
		

		$("#are_u_owner_section_image_path_validation").hide();
	    $("#owner_section_image_extension_validation").hide();
		$("#are_u_owner_section_image_alt_text_validation").hide();
		$("#are_u_owner_section_image_title_text_validation").hide();
		$("#are_u_owner_section_text_validation").hide();
		$("#are_u_owner_section_title_validation").hide();
		$("#display_in_homepage_validation").hide();


	if(are_u_owner_section_image_path=="" && owner_type != 'edit')
	{
		$("#are_u_owner_section_image_path").focus();
		$("#are_u_owner_section_image_path_validation").show();
		return  false;
	}
	
	if(are_u_owner_section_image_path !="")
	{
	 var fileInput = document.getElementById('are_u_owner_section_image_path');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#are_u_owner_section_image_path").focus();
	    $("#owner_section_image_extension_validation").show();
			return false;
		}
	}
	
	if(are_u_owner_section_image_alt_text=="")
	{
		$("#are_u_owner_section_image_alt_text").focus();
		$("#are_u_owner_section_image_alt_text_validation").show();
		return  false;
	}
	if(are_u_owner_section_image_title_text=="")
	{
		$("#are_u_owner_section_image_title_text").focus();
		$("#are_u_owner_section_image_title_text_validation").show();
		return  false;
	}

	if(are_u_owner_section_text=="")
	{
		$("#are_u_owner_section_text").focus();
		$("#are_u_owner_section_text_validation").show();
		return  false;
	}

	if(are_u_owner_section_title=="")
	{
		$("#are_u_owner_section_title").focus();
		$("#are_u_owner_section_title_validation").show();
		return  false;
	}


    if($('input[type=radio][name=display_in_homepage]:checked').length == 0)
     {
	  $("#display_in_homepage").focus();
	  $("#display_in_homepage_validation").show();
         return false;
     }	
});
});

function fnDeleteOwnerSectionImageRow(rowId) {
	
	$("#deleteRowId").val(rowId);
}
$(document).ready(function(){
	  $("#confirmDeleteOwnerSectionImageRow").click(function(){
     
	var deleteRowId = $("#deleteRowId").val();
	var homeUrl = $("#homeUrl").val();
	posturl = homeUrl+"am/delete-are-you";
		

	$.post(
	  posturl, {		
	  deleteRowId: deleteRowId,
	  _csrf: csrfTokenPage,			  
	},	
	function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  


	});
});

function fnGetRestaurantData()
{
	var homeUrl                   = $("#homeUrl").val();
    var restaurant_id             = $("#restaurant_id").val();
	var pageName                  = $("#pageName").val();
	var actionName                = $("#action_name").val();

   
	if(actionName == 'add-restaurant-timings') {
        posturl = homeUrl+"am/get-restaurant-timings";
        pageName = actionName;
	} else {
		posturl = homeUrl+"am/restaurant-dish-menu";
	}
    

        $.post(
        posturl, {
        restaurant_id:restaurant_id,
        pageName:pageName,
	    _csrf: csrfTokenPage,		
        },
        function (ResponseData){

            if(pageName == 'add-restaurant-dishes' || pageName == 'edit-restaurant-dishes') {
                $("#restaurant_menu_section").html(ResponseData);
            } else if(actionName == 'add-restaurant-timings') {
                $("#timingsRow").html(ResponseData);
            } else {
                $("#restaurant_dish_section").html(ResponseData);
            }
            
        }

    );
}

	$(document).ready(function(){		 
	$(".submitbuttondishes").click(function(){
		
		var addType					  = $(this).val();
		$("#addType").val(addType);
		
	var homeUrl                      = $("#homeUrl").val();	
	var restaurant_id                = $("#restaurant_id").val();
	var dish_name                    = $("#dish_name").val();
	var dish_category                = $("#dish_category").val();
	var is_dish_halal                = $("#is_dish_halal").val();
	var dish_name_hidden             = $("#dish_name_hidden").val();
	var dish_allergy_text            = $("#dish_allergy_text").val();
	var restaurant_menu_id           = $("#restaurant_menu_id").val();
	var dish_price                   = $("#dish_price").val();
	var dish_discount_percentage     = $("#dish_discount_percentage").val(); 
	var dish_discount_price          = $("#dish_discount_price").val();   
	var dish_image                   = $("#dish_image").val();
	var dish_image_type              = $("#dish_image_type").val();
	var dish_type                    = $("#dish_type").val();
	var dish_link                    = $("#dish_link").val();
	var dish_info_english            = $("#dish_info_english").val(); 
	var dish_info_german             = $("#dish_info_german").val();
	var is_delivery_availabe         = $("#is_delivery_availabe").val();    
	var is_dish_active               = $("#is_dish_active").val();

		   $("#restaurant_name_valids").hide();
		   $("#dish_name_validation").hide();
		   $("#dish_category_validation").hide();
		   $("#is_dish_halal_validation").hide();
		   $("#dish_same_name_validation").hide();
		   $("#dish_allergy_text_validation").hide();
		   $("#dish_number_in_menu_validation").hide();
		   $("#dish_price_validation").hide();	   
		   $("#dish_image_validation").hide();
		   $("#dish_image_extension_validation").hide();
		   $("#dish_type_validation").hide();
		   $("#dish_info_english_validation").hide();
		   $("#dish_info_german_validation").hide();
		   $("#is_delivery_availabe_validation").hide();
		   $("#is_dish_active_validation").hide();
		
			var check_in_dish = "No";


		if(restaurant_id=="")
		{
		$("#restaurant_id").focus();
		$("#restaurant_name_valids").show();
		return false;

		}
		if(dish_name=="")
		{
		  $("#dish_name").focus();
		  $("#dish_name_validation").show();
		  return false;

		}
			  
		if(dish_name != dish_name_hidden)
		{
			check_in_dish = "Yes";
		} 
		

		if(dish_category=="")
		{
		  $("#dish_category").focus();
		  $("#dish_category_validation").show();
		  return false;

		}
		
		if(is_dish_halal=="")
		{
		  $("#is_dish_halal").focus();
		  $("#is_dish_halal_validation").show();
		  return false;

		}
			   
		if(dish_allergy_text=="")
		{
		  $("#dish_allergy_text").focus();
		  $("#dish_allergy_text_validation").show();
		  return false;

		}

		if(restaurant_menu_id=="")
		{
		  $("#restaurant_menu_id").focus();
		  $("#dish_number_in_menu_validation").show();
		  return false;

		}


		if(dish_price=="")
		{
			$("#dish_price").focus();
			$("#dish_price_validation").show();
			return  false;

		}
		

		if(dish_image=="" && dish_image_type != 'edit')
		{
			$("#dish_image").focus();
			$("#dish_image_validation").show();
			return  false;
		}
		
		if(dish_image !="")
		{
		 var fileInput = document.getElementById('dish_image');
			var filePath = fileInput.value;
			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
			if(!allowedExtensions.exec(filePath)){
				alert('Please upload file with extension .jpeg/.jpg/.png only.');
				fileInput.value = '';
			$("#dish_image").focus();
			$("#dish_image_extension_validation").show();
				return false;
			}

		}

		if(dish_type=="")
		{
			$("#dish_type").focus();
			$("#dish_type_validation").show();
			
			return  false;
		}
		if(dish_info_english=="")
		{
			$("#dish_info_english").focus();
			$("#dish_info_english_validation").show();
			return  false;
		}

		if(dish_info_german=="")
		{
			$("#dish_info_german").focus();
			$("#dish_info_german_validation").show();
			
			return  false;
		}


		if($('input[type=radio][name=is_delivery_availabe]:checked').length == 0)
		  {
		  $("#is_delivery_availabe").focus();
		  $("#is_delivery_availabe_validation").show();
			 return false;
		}	
		if($('input[type=radio][name=is_dish_active]:checked').length == 0)
		  {
		  $("#is_dish_active").focus();
		  $("#is_dish_active_validation").show();
			 return false;
		}	


		
	posturl = homeUrl+"am/dish-name-exists";

		$.post(
		posturl, {

		dish_name:dish_name,
		check_in_dish:check_in_dish,
		restaurant_id:restaurant_id,
	     _csrf: csrfTokenPage,		
		},
		function (ResponseData){
		if($.trim(ResponseData) == 'exist') {
			$("#dish_name").focus();
			$("#dish_same_name_validation").show();
			e.preventDefault();
			return false;
		} else {
			$("#addDishes").submit();
		}


	}

	);


	});
	});

	$(document).ready(function(e){		 
	$("#dishesedit").click(function(){

	var homeUrl                      = $("#homeUrl").val();
	var restaurant_id                = $("#restaurant_id").val();
	var dish_name                    = $("#dish_name").val();
	var dish_category                = $("#dish_category").val();
	var is_dish_halal                = $("#is_dish_halal").val();
	var dish_name_hidden             = $("#dish_name_hidden").val();
	var dish_allergy_text            = $("#dish_allergy_text").val();
	var restaurant_menu_id           = $("#restaurant_menu_id").val();
	var dish_price                   = $("#dish_price").val();
	var dish_discount_percentage     = $("#dish_discount_percentage").val();    
	var dish_discount_price          = $("#dish_discount_price").val();
	var dish_image                   = $("#dish_image").val();
	var dish_image_type              = $("#dish_image_type").val();
	var dish_type                    = $("#dish_type").val();
	var dish_link                    = $("#dish_link").val();
	var dish_info_english            = $("#dish_info_english").val(); 
	var dish_info_german             = $("#dish_info_german").val();
	var is_delivery_availabe         = $("#is_delivery_availabe").val();    
	var is_dish_active               = $("#is_dish_active").val();

		   $("#restaurant_name_valids").hide();
		   $("#dish_name_validation").hide();
		   $("#dish_category_validation").hide();
		   $("#is_dish_halal_validation").hide();
		   $("#dish_same_name_validation").hide();
		   $("#dish_allergy_text_validation").hide();
		   $("#dish_number_in_menu_validation").hide();
		   $("#dish_price_validation").hide();
		   $("#dish_image_validation").hide();
		   $("#dish_image_extension_validation").hide();
		   $("#dish_type_validation").hide();
		   $("#dish_info_english_validation").hide();
		   $("#dish_info_german_validation").hide();
		   $("#is_delivery_availabe_validation").hide();
		   $("#is_dish_active_validation").hide();
		
			var check_in_dish = "No";

		
		if(restaurant_id=="")
		{
		  $("#restaurant_id").focus();
		  $("#restaurant_name_valids").show();
		  return false;

		}
		if(dish_name=="")
		{
		  $("#dish_name").focus();
		  $("#dish_name_validation").show();
		  return false;

		}
			  
		if(dish_name != dish_name_hidden)
		{
			check_in_dish = "Yes";
		} 
		
		if(dish_category=="")
		{
		  $("#dish_category").focus();
		  $("#dish_category_validation").show();
		  return false;

		}	
		
		if(is_dish_halal=="")
		{
		  $("#is_dish_halal").focus();
		  $("#is_dish_halal_validation").show();
		  return false;

		}	
			   
		if(dish_allergy_text=="")
		{
		  $("#dish_allergy_text").focus();
		  $("#dish_allergy_text_validation").show();
		  return false;

		}

		if(restaurant_menu_id=="")
		{
		  $("#restaurant_menu_id").focus();
		  $("#dish_number_in_menu_validation").show();
		  return false;

		}


		if(dish_price=="")
		{
			$("#dish_price").focus();
			$("#dish_price_validation").show();
			return  false;

		}
		

		if(dish_image=="" && dish_image_type != 'edit')
		{
			$("#dish_image").focus();
			$("#dish_image_validation").show();
			return  false;
		}
		
		if(dish_image !="")
		{
		 var fileInput = document.getElementById('dish_image');
			var filePath = fileInput.value;
			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
			if(!allowedExtensions.exec(filePath)){
				alert('Please upload file with extension .jpeg/.jpg/.png only.');
				fileInput.value = '';
			$("#dish_image").focus();
			$("#dish_image_extension_validation").show();
				return false;
			}

		}
			
		if(dish_type=="")
		{
			$("#dish_type").focus();
			$("#dish_type_validation").show();
			
			return  false;
		}
		if(dish_info_english=="")
		{
			$("#dish_info_english").focus();
			$("#dish_info_english_validation").show();
			return  false;
		}

		if(dish_info_german=="")
		{
			$("#dish_info_german").focus();
			$("#dish_info_german_validation").show();
			
			return  false;
		}
		
		if($('input[type=radio][name=is_delivery_availabe]:checked').length == 0)
		  {
		  $("#is_delivery_availabe").focus();
		  $("#is_delivery_availabe_validation").show();
			 return false;
		}	
		
		if($('input[type=radio][name=is_dish_active]:checked').length == 0)
		  {
		  $("#is_dish_active").focus();
		  $("#is_dish_active_validation").show();
			 return false;
		}	

	  posturl = homeUrl+"am/dish-name-exists";

		$.post(
		posturl, {

		dish_name:dish_name,
		check_in_dish:check_in_dish,
		restaurant_id:restaurant_id,
	     _csrf: csrfTokenPage,		
		},
		function (ResponseData){
		if($.trim(ResponseData) == 'exist') {
			$("#dish_name").focus();
			$("#dish_same_name_validation").show();
			e.preventDefault();
			return false;
		} else {
			$("#editDishes").submit();
			
		}


		}

		);

	});
	});

function fnDeleteRestaurantDishRow(rowId) {
	
	$("#deleteRowId").val(rowId);
}


$(document).ready(function(){
	  $("#confirmDeleteRestaurantDishRow").click(function(){
     
	var deleteRowId = $("#deleteRowId").val();
	var homeUrl = $("#homeUrl").val();
	posturl = homeUrl+"am/delete-dishes";
		

	$.post(
	  posturl, {		
	  deleteRowId: deleteRowId,
	  _csrf: csrfTokenPage,		

	},	
	function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  


	});
});


/*function getCheckboxStatus(){
   var status = document.getElementById("is_dish_halal").checked;
   if (status) {
      alert("Yes");
   } else {
      alert("No");
   }
}*/

	


$(document).ready(function(){		 
$("#submitbuttonaddress").click(function(){
	
var restaurant_id                       = $("#restaurant_id").val();
var restaurant_latitude                 = $("#restaurant_latitude").val();
var restaurant_longitude                = $("#restaurant_longitude").val();
var restaurant_street                   = $("#restaurant_street").val();
var restaurant_house_no                 = $("#restaurant_house_no").val();
var restaurant_pincode                  = $("#restaurant_pincode").val();    
var restaurant_district                 = $("#restaurant_district").val();
var restaurant_city                     = $("#restaurant_city").val();
var restaurant_country                  = $("#restaurant_country").val();
var restaurant_telephone_no             = $("#restaurant_telephone_no").val(); 
var restaurant_fax_no                   = $("#restaurant_fax_no").val();
var restaurant_mobile_no                = $("#restaurant_mobile_no").val();    
var restaurant_contact_person_name      = $("#restaurant_contact_person_name").val();
var restaurant_email                    = $("#restaurant_email").val();
var restaurant_website                  = $("#restaurant_website").val();    
var restaurant_rating                   = $("#restaurant_rating").val();

       $("#restaurant_name_valids").hide();
	   $("#restaurant_latitude_validation").hide();
       $("#restaurant_longitude_validation").hide();
	   $("#restaurant_street_validation").hide();
	   $("#restaurant_house_no_validation").hide();
	   $("#restaurant_pincode_validation").hide();
	   $("#restaurant_district_validation").hide();
	   $("#restaurant_city_validation").hide();
	   $("#restaurant_country_validation").hide();
	   $("#restaurant_telephone_no_validation").hide();
	   $("#restaurant_fax_no_validation").hide();
	   $("#restaurant_mobile_no_validation").hide();
	   $("#restaurant_contact_person_name_validation").hide();
	   $("#empty_email_validation").hide();
	   $("#restaurant_email_validation").hide();
	   $("#restaurant_website_validation").hide();
	   $("#restaurant_rating_validation").hide();
	   
	   
if(restaurant_id=="")
{
  $("#restaurant_id").focus();
  $("#restaurant_name_valids").show();
  return false;

}

if(restaurant_latitude=="")
{
  $("#restaurant_latitude").focus();
  $("#restaurant_latitude_validation").show();
  return false;

}

if(restaurant_longitude=="")
{
  $("#restaurant_longitude").focus();
  $("#restaurant_longitude_validation").show();
  return false;

}



if(restaurant_street=="")
{
	$("#restaurant_street").focus();
	$("#restaurant_street_validation").show();
	return  false;

}
if(restaurant_house_no  =="")
{
	
	$("#restaurant_house_no").focus();
	$("#restaurant_house_no_validation").show();
	return  false;

}


if(restaurant_pincode=="")
{ 
	$("#restaurant_pincode").focus();
	$("#restaurant_pincode_validation").show();
	return  false;
}
if(restaurant_district=="")
{
	$("#restaurant_district").focus();
	$("#restaurant_district_validation").show();
	return  false;
}

if(restaurant_city=="")
{
	$("#restaurant_city").focus();
	$("#restaurant_city_validation").show();
	
	return  false;
}
if(restaurant_country=="")
{
	$("#restaurant_country").focus();
	$("#restaurant_country_validation").show();
	return  false;
}
if(restaurant_telephone_no=="")
{
	$("#restaurant_telephone_no").focus();
	$("#restaurant_telephone_no_validation").show();
	return  false;
}


if(restaurant_mobile_no=="")
{
	$("#restaurant_mobile_no").focus();
	$("#restaurant_mobile_no_validation").show();
	return  false;
}
if(restaurant_contact_person_name=="")
{
	$("#restaurant_contact_person_name").focus();
	$("#restaurant_contact_person_name_validation").show();
	return  false;
}
if(restaurant_email=="")
{
	$("#restaurant_email").focus();
	$("#empty_email_validation").show();
	
	return  false;
}
	if(IsEmail(restaurant_email)==false){
	$("#restaurant_email").focus();
	  $('#restaurant_email_validation').show();
	  return false;
	}
	function IsEmail(restaurant_email) {
	  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  if(!regex.test(restaurant_email)) {
		return false;
	  }else{
		return true;
	  }
	}

if(restaurant_rating=="")
{
	$("#restaurant_rating").focus();
	$("#restaurant_rating_validation").show();
	return  false;
}


/*posturl = "restaurant-name-exists";


$.post(
 posturl, {
 
 restaurant_id: restaurant_id
 ,
},
function (ResponseData){

if($.trim(ResponseData) == 'exist') {
$("#email_validation").show();
return false;
}


}

);*/


});
});


function fnDeleteRestaurantAddressRow(rowId) {
	
	$("#deleteRowId").val(rowId);
}
$(document).ready(function(){
	  $("#confirmDeleteRestaurantAddressRow").click(function(){
     
	var deleteRowId = $("#deleteRowId").val();
	var homeUrl = $("#homeUrl").val();
	posturl = homeUrl+"am/delete-address";
		

	$.post(
	  posturl, {		
	  deleteRowId: deleteRowId,	
	  _csrf: csrfTokenPage,			  
	},	
	function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  


	});
});




$(document).ready(function(e){		 
$(".submitbuttonmenu").click(function(){


	var addType					  = $(this).val();
	$("#addType").val(addType);
	var homeUrl                                   = $("#homeUrl").val();		
	var restaurant_id                             = $("#restaurant_id").val();
	var menu_name                                 = $("#menu_name").val();
	var menu_name_hidden                          = $("#menu_name_hidden").val();
	var menu_type                                 = $("#menu_type").val(); 	
	var menu_image                                = $("#menu_image").val();
	var menu_image_type                           = $("#menu_image_type").val();
	var is_active                                 = $("#is_active").val();
	var menu_display_sequence_number              = $("#menu_display_sequence_number").val();
	var menu_display_sequence_number_hidden       = $("#menu_display_sequence_number_hidden").val();
	
      $("#restaurant_name_valids").hide();
	  $("#menu_name_validation").hide();
	  $("#menu_same_name_validation").hide();
	  $("#menu_type_validation").hide();
	  $("#menu_image_validation").hide();
	  $("#menu_image_extension_validation").hide();
	  $("#is_active_validation").hide();
	  $("#menu_display_sequence_number_validation").hide();
	  $("#menu_display_sequence_same_number_validation").hide();
	  
	  
		var check_in_menu = "No";
		var check_in_sequence_menu = "N";


	if(restaurant_id=="")
	{
	  $("#restaurant_id").focus();
	  $("#restaurant_name_valids").show();
	  return false;

	}

	if(menu_name=="")
	{
		$("#menu_name").focus();
		$("#menu_name_validation").show();
		return  false;

	}
		  
	if(menu_name != menu_name_hidden)
	{
		check_in_menu = "Yes";
	} 

	if(menu_type=="")
	{
		$("#menu_type").focus();
		$("#menu_type_validation").show();
		return  false;

	}

	if(menu_image=="" && menu_image_type != 'edit')
	{
		$("#menu_image").focus();
		$("#menu_image_validation").show();
		return  false;
	}
	
	if(menu_image !="")
	{
	 var fileInput = document.getElementById('menu_image');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#menu_image").focus();
		$("#menu_image_extension_validation").show();
			return false;
		}

	}

    if($('input[type=radio][name=is_active]:checked').length == 0)
      {
	  $("#is_active").focus();
	  $("#is_active_validation").show();
         return false;
    }	
	if(menu_display_sequence_number=="")
	{
		$("#menu_display_sequence_number").focus();
		$("#menu_display_sequence_number_validation").show();
		return  false;

	}

	if(menu_display_sequence_number != menu_display_sequence_number_hidden)
	{
		check_in_sequence_menu = "Y";
	}
      posturl = homeUrl+"am/menu-name-exists";


	$.post(
	posturl, {

	menu_name:menu_name,
	check_in_menu:check_in_menu,
	restaurant_id:restaurant_id,
	menu_display_sequence_number: menu_display_sequence_number,
	check_in_sequence_menu: check_in_sequence_menu,
	_csrf: csrfTokenPage,	

	 
	},
	function (ResponseData){
	if($.trim(ResponseData) == 'same') {
		$("#menu_display_sequence_number").focus();
		$("#menu_display_sequence_same_number_validation").show();
		e.preventDefault();
		return false;
	}
	 else if($.trim(ResponseData) == "exist") {
		$("#menu_name").focus();
		$("#menu_same_name_validation").show();
		e.preventDefault();
		return false;
	} 
	
	 else {
		$("#menuformAdd").submit();
	}


}

);

});
});

$(document).ready(function(){		 
$("#menuedit").click(function(){

	var homeUrl                                   = $("#homeUrl").val();	
	var restaurant_id                             = $("#restaurant_id").val();
	var menu_name                                 = $("#menu_name").val();
	var menu_name_hidden                          = $("#menu_name_hidden").val();
	var menu_type                                 = $("#menu_type").val(); 	
	var menu_image                                = $("#menu_image").val();
	var menu_image_type                           = $("#menu_image_type").val();
	var is_active                                 = $("#is_active").val();
	var menu_display_sequence_number              = $("#menu_display_sequence_number").val();
	var menu_display_sequence_number_hidden       = $("#menu_display_sequence_number_hidden").val();
	
      $("#restaurant_name_valids").hide();
	  $("#menu_name_validation").hide();
	  $("#menu_same_name_validation").hide();
	  $("#menu_type_validation").hide();
	  $("#menu_image_validation").hide();
	  $("#menu_image_extension_validation").hide();
	  $("#is_active_validation").hide();
	  $("#menu_display_sequence_number_validation").hide();
	  $("#menu_display_sequence_same_number_validation").hide();
	  
	  
		var check_in_menu = "No";
		var check_in_sequence_menu = "N";

	if(restaurant_id=="")
	{
	  $("#restaurant_id").focus();
	  $("#restaurant_name_valids").show();
	  return false;

	}

	if(menu_name=="")
	{
		$("#menu_name").focus();
		$("#menu_name_validation").show();
		return  false;

	}
		  
	if(menu_name != menu_name_hidden)
	{
		check_in_menu = "Yes";
	} 

	if(menu_type=="")
	{
		$("#menu_type").focus();
		$("#menu_type_validation").show();
		return  false;

	}
	
	if(menu_image=="" && menu_image_type != 'edit')
	{
		$("#menu_image").focus();
		$("#menu_image_validation").show();
		return  false;
	}

	if(menu_image !="")
	{
	 var fileInput = document.getElementById('menu_image');
		var filePath = fileInput.value;
		var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
		if(!allowedExtensions.exec(filePath)){
			alert('Please upload file with extension .jpeg/.jpg/.png only.');
			fileInput.value = '';
		$("#menu_image").focus();
		$("#menu_image_extension_validation").show();
			return false;
		}

	}

    if($('input[type=radio][name=is_active]:checked').length == 0)
      {
	  $("#is_active").focus();
	  $("#is_active_validation").show();
         return false;
    }	
	if(menu_display_sequence_number=="")
	{
		$("#menu_display_sequence_number").focus();
		$("#menu_display_sequence_number_validation").show();
		return  false;

	}

	if(menu_display_sequence_number != menu_display_sequence_number_hidden)
	{
		check_in_sequence_menu = "Y";
	}
	
     posturl = homeUrl+"am/menu-name-exists";


	$.post(
	posturl, {

	menu_name:menu_name,
	check_in_menu:check_in_menu,
	restaurant_id:restaurant_id,
	menu_display_sequence_number: menu_display_sequence_number,
	check_in_sequence_menu: check_in_sequence_menu,
    _csrf: csrfTokenPage,		
	 
	},
	function (ResponseData){
	if($.trim(ResponseData) == 'same') {
		$("#menu_display_sequence_number").focus();
		$("#menu_display_sequence_same_number_validation").show();
		e.preventDefault();
		return false;
	}
	 else if($.trim(ResponseData) == "exist") {
		$("#menu_name").focus();
		$("#menu_same_name_validation").show();
		e.preventDefault();
		return false;
	} else {
		$("#editMenus").submit();
	}


	}

	);

	});
	});


function fnDeleteRestaurantMenuRow(rowId) {
	
	$("#deleteRowId").val(rowId);
}
$(document).ready(function(){
	  $("#confirmDeleteRestaurantMenuRow").click(function(){
     
	var deleteRowId = $("#deleteRowId").val();
	var homeUrl = $("#homeUrl").val();
	posturl = homeUrl+"am/delete-menus";
		

	$.post(
	  posturl, {		
	  deleteRowId: deleteRowId,	
	  _csrf: csrfTokenPage,
	  
	},	
	function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  


	});
});





$(document).ready(function(){	
$("#submitbuttoncms").click(function(){

	var homeUrl                           = $("#homeUrl").val();
	var page_name                         = $("#page_name").val();
	var page_content                      = $("#page_content").val();
	var is_active                         = $("#is_active").val();
	var is_display_in_footer              = $("#is_display_in_footer").val();
	var display_sequence_number           = $("#display_sequence_number").val();
	var display_sequence_number_hidden    = $("#display_sequence_number_hidden").val();


	   
		$("#page_name_validation").hide();
		$("#page_content_validation").hide();
		$("#is_active_validation").hide();
		$("#is_display_in_footer_validation").hide();
		$("#display_sequence_number_validation").hide();
		$("#display_sequence_same_number_validation").hide();
			
			var check_in_cms = 'No';

	if(page_name=="")
	{
		$("#page_name").focus();
		$("#page_name_validation").show();
		return  false;

	}

	if(page_content =="")
	{
		$("#page_content").focus();
		$("#page_content_validation").show();
		return  false;

	}

	if(is_active=="")
	{
		$("#is_active").focus();
		$("#is_active_validation").show();
		return  false;

	}

	if(is_display_in_footer =="")
	{
		$("#is_display_in_footer").focus();
		$("#is_display_in_footer_validation").show();
		return  false;

	}

	if(display_sequence_number =="")
	{
		$("#display_sequence_number").focus();
		$("#display_sequence_number_validation").show();
		return  false;

	}
	
	if(display_sequence_number != display_sequence_number_hidden)
	{
		check_in_cms = 'Yes';
	}

     posturl = homeUrl+"am/cms-display-sequence-number-exists";


	$.post(
	posturl, {

	display_sequence_number: display_sequence_number,
	check_in_cms:check_in_cms,
	_csrf: csrfTokenPage,		

	 
	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
		$("#display_sequence_number").focus();
		$("#display_sequence_same_number_validation").show();
		e.preventDefault();
		return false;
	}
    else {
		$("#addCms").submit();
	}


	}

	);

});
});


	function fnDeleteCmsPageRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}


	$(document).ready(function(){
		  $("#confirmDeleteCmsPageRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"am/delete-row";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,		
    	  _csrf: csrfTokenPage,			  

		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});


	$(document).ready(function(){		 
	$("#submitbutton").click(function(){

	var homeUrl                                      = $("#homeUrl").val();
	var section_name                                 = $("#section_name").val();
	var section_display_sequence_number              = $("#section_display_sequence_number").val();
	var section_name_hidden                          = $("#section_name_hidden").val();
	var section_display_sequence_number_hidden       = $("#section_display_sequence_number_hidden").val();

	   
	   $("#section_name_validation").hide();
	   $("#section_same_name_validation").hide();
	   $("#section_display_sequence_number_validation").hide();
	   $("#section_display_same_number_validation").hide();
   
		var check_in_section = "N";
		var check_in_sequence = "No";

	if(section_name=="")
	{
	  $("#section_name").focus();
	  $("#section_name_validation").show();
	  return false;

	}

	  
	if(section_name != section_name_hidden)
	{
		check_in_section = "Y";
	}

	if(section_display_sequence_number=="")
	{
		$("#section_display_sequence_number").focus();
		$("#section_display_sequence_number_validation").show();
		return  false;

	}

	if(section_display_sequence_number != section_display_sequence_number_hidden)
	{
		check_in_sequence = "Yes";
	}


	posturl = homeUrl+"am/section-name-exists";


	$.post(
	 posturl, {
	 section_name: section_name,
	 check_in_section: check_in_section,
	 section_display_sequence_number: section_display_sequence_number,
	 check_in_sequence: check_in_sequence,
	 _csrf: csrfTokenPage,		

	 
	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
		$("#section_name").focus();
		$("#section_same_name_validation").show();
		e.preventDefault();
		return false;
	}
	 else if($.trim(ResponseData) == "same") {
		$("#section_display_sequence_number").focus();
		$("#section_display_same_number_validation").show();
		e.preventDefault();
		return false;
	}  else {
		
		 $("#addHomePageForm").submit();
		}


	}

	);

	});
	});


	$(document).ready(function(){		 
	$("#edithomepages").click(function(){
	var homeUrl                                      = $("#homeUrl").val();
	var section_name                                 = $("#section_name").val();
	var section_display_sequence_number              = $("#section_display_sequence_number").val();
	var section_name_hidden                          = $("#section_name_hidden").val();
	var section_display_sequence_number_hidden       = $("#section_display_sequence_number_hidden").val();

	   
	   $("#section_name_validation").hide();
	   $("#section_same_name_validation").hide();
	   $("#section_display_sequence_number_validation").hide();
	   $("#section_display_same_number_validation").hide();

		   
		var check_in_section = "N";
		var check_in_sequence = "No";

	if(section_name=="")
	{
	  $("#section_name").focus();
	  $("#section_name_validation").show();
	  return false;

	}

	  
	if(section_name != section_name_hidden)
	{
		check_in_section = "Y";
	}

	if(section_display_sequence_number=="")
	{
		$("#section_display_sequence_number").focus();
		$("#section_display_sequence_number_validation").show();
		return  false;

	}

	if(section_display_sequence_number != section_display_sequence_number_hidden)
	{
		check_in_sequence = "Yes";
	}


	posturl = homeUrl+"am/section-name-exists";


	$.post(
	 posturl, {
	 section_name: section_name,
	 check_in_section: check_in_section,
	 section_display_sequence_number: section_display_sequence_number,
	 check_in_sequence: check_in_sequence,
	 _csrf: csrfTokenPage,		
	 
	},
	function (ResponseData){
	if($.trim(ResponseData) == 'exist') {
		$("#section_name").focus();
		$("#section_same_name_validation").show();
		e.preventDefault();
		return false;
	}
	 else if($.trim(ResponseData) == "same") {
		$("#section_display_sequence_number").focus();
		$("#section_display_same_number_validation").show();
		e.preventDefault();
		return false;
	}   else {
		
		 $("#editHomePageForm").submit();
	    }


	}

	);

	});
	});





	function fnDeleteHomePagesSectionRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}
	$(document).ready(function(){
		  $("#confirmDeleteHomePagesSectionRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"am/delete-home-pages-sections";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,
    	  _csrf: csrfTokenPage,			  
		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});


/*	$(document).ready(function(){
    $(".special").click(function(){
	
	var specType					  = $(this).val();
	$("#specType").val(specType);
	
		if(specType =="No")
		{
	   $("#restaurant_spec").hide();
		}
       else {
      $("#restaurant_spec").show();
	   }

	  
	}); 

	});*/
	
	
	
$(document).ready(function(){		 		
$(".special").click(function(){

	var specType					  = $(this).val();
	$("#specType").val(specType);
	
	if(specType =="N")
	{
		$("#restaurant_spec").hide();
	} else {
		$("#restaurant_spec").show();
    }
});
 });

$(document).ready(function(){		 		
$("#addspecialities").click(function(){
	
	var speciality_type1             = $("#speciality_type1").val();
	var speciality_type2             = $("#speciality_type2").val();
	var restaurant_speciality        = $("#restaurant_speciality").val();
	var restaurant_id                = $("#restaurant_id").val();
	
	

	var speciality_type_selected = $("input[name='speciality_type']:checked").val();

   $("#restaurant_name_valids").hide();
   $("#speciality_type_validation").hide();
   $("#restaurant_speciality_validation").hide();
	   
	if(restaurant_id =="")
	{
	  $("#restaurant_id").focus();
	  $("#restaurant_name_valids").show();
	  return false;

	}
	if($('input[type=radio][name=speciality_type]:checked').length == 0)
	{
	  $("#speciality_type1").focus();
	  $("#speciality_type_validation").show();
	  return false;
	}		 

	if(speciality_type_selected =="Y" && restaurant_speciality =="")
	{
	  $("#restaurant_speciality").focus();
	  $("#restaurant_speciality_validation").show();
	  return false;

	}	
 
	});
 });

$(document).ready(function(){		 		
	var speciality                     = $("#speciality").val();
	
	if(speciality =="N")
	{
		$("#restaurant_spec").hide();
	} else {
		$("#restaurant_spec").show();
    }
$("#editspecialities").click(function(){
	
	var speciality_type1             = $("#speciality_type1").val();
	var speciality_type2             = $("#speciality_type2").val();
	var restaurant_speciality        = $("#restaurant_speciality").val();
	var restaurant_id                = $("#restaurant_id").val();

	var speciality_type_selected = $("input[name='speciality_type']:checked").val();

   $("#restaurant_name_valids").hide();
   $("#speciality_type_validation").hide();
   $("#restaurant_speciality_validation").hide();
	   
	if(restaurant_id =="")
	{
	  $("#restaurant_id").focus();
	  $("#restaurant_name_valids").show();
	  return false;

	}
	if($('input[type=radio][name=speciality_type]:checked').length == 0)
	{
	  $("#speciality_type1").focus();
	  $("#speciality_type_validation").show();
	  return false;
	}		 

	if(speciality_type_selected =="Y" && restaurant_speciality =="")
	{
	  $("#restaurant_speciality").focus();
	  $("#restaurant_speciality_validation").show();
	  return false;

	}	
 
	});
 });

	function fnDeleteRestaurantSpecialitiesRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}
	$(document).ready(function(){
		  $("#confirmDeleteRestaurantSpecialitiesRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"am/delete-specialities";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,	
	      _csrf: csrfTokenPage,			  		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});


$(document).ready(function(){		 
$("#submitbuttontimings").click(function(){

    $("#restaurant_name_valids").hide();
    var restaurant_id               = $("#restaurant_id").val();
    var restaurant_url               = $("#restaurant_url").val();
	var homeUrl						= $("#homeUrl").val();
	var daysOfWeekArr = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
	//var daysOfWeekArr = ['monday','tuesday'];
	var startTimeArr = {};
	var endTimeArr = {};
	var specialityArr = {};
	var isRestaurantClose = {};

    if(restaurant_id == '') {
        $("#restaurant_name_valids").show();
        return false;
    }

	var showError = 'N';
	for (i = 0; i < daysOfWeekArr.length; i++) {
		
		$("#"+daysOfWeekArr[i]+"_restaurant_start_validation").hide();
		$("#"+daysOfWeekArr[i]+"_restaurant_end_validation").hide();

		 startTimeArr[daysOfWeekArr[i]] = $("#"+daysOfWeekArr[i]+"_start_time").val();
         

         if($("#"+daysOfWeekArr[i]+"_is_restaurant_close").prop('checked')) {
			isRestaurantClose[daysOfWeekArr[i]] = "Y";
		 } else {
			isRestaurantClose[daysOfWeekArr[i]] = "N";
         }
         

		 var startTime = $("#"+daysOfWeekArr[i]+"_start_time").val();
		 if(startTime == '' && isRestaurantClose[daysOfWeekArr[i]] == 'N') {
			$("#"+daysOfWeekArr[i]+"_restaurant_start_validation").show();
			showError = 'Y';
		 }

		 endTimeArr[daysOfWeekArr[i]] = $("#"+daysOfWeekArr[i]+"_end_time").val();

		 var endTime = $("#"+daysOfWeekArr[i]+"_end_time").val();
		 if(endTime == '' && isRestaurantClose[daysOfWeekArr[i]] == 'N') {
			$("#"+daysOfWeekArr[i]+"_restaurant_end_validation").show();
			showError = 'Y';
		 }

		 if($("#"+daysOfWeekArr[i]+"_is_restaurant_close").prop('checked')) {
			isRestaurantClose[daysOfWeekArr[i]] = "Y";
		 } else {
			isRestaurantClose[daysOfWeekArr[i]] = "N";
		 }
		 

		 //isRestaurantClose[daysOfWeekArr[i]] = $("#"+daysOfWeekArr[i]+"_is_restaurant_close").checked;
		 specialityArr[daysOfWeekArr[i]] = $("#"+daysOfWeekArr[i]+"_speciality").val();
	}

	//console.log(startTimeArr);
	//return false;

	if(showError == 'Y') {
		return false;
	}
	//alert(startTimeArr);
	posturl = homeUrl+"am/add-restaurant-timings-ajax";

	//startTimeArrs = JSON.stringify(startTimeArr);

	$.post(
	  posturl, {	
		endTimeArr: endTimeArr,		
		restaurant_id:restaurant_id,
		startTimeArrs: startTimeArr,	
		specialityArr: specialityArr,	
		isRestaurantClose: isRestaurantClose,
	    _csrf: csrfTokenPage,				
	},	
	function (ResponseData){
            
            if(restaurant_url != '') {
                window.location.href = homeUrl+"am/add-restaurant-specialities?restaurant_id="+restaurant_url;
            } else {
                alert("Restaurant timings updated");
                return false;
            }
		}); 

	});
	});

	function fnDeleteRestaurantTimingRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}
	$(document).ready(function(){
		  $("#confirmDeleteRestaurantTimingRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"am/delete-timings";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,	
     	  _csrf: csrfTokenPage,			  
		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});


	function getrestaurant(sel)
	{
	var homeUrl						 = $("#homeUrl").val();
	var restaurant_id                = $("#restaurant_id").val();
		
		
	posturl = homeUrl+"am/dish-supp";

		$.post(
		posturl, {

		restaurant_id:restaurant_id,
	    _csrf: csrfTokenPage,		
		},
		function (ResponseData){
			$("#restaurant_dish_section").html(ResponseData);
		}

	);
	}

	$(document).ready(function(){		 
	$(".submitbuttonsuppliment").click(function(){
		
		var addType					  = $(this).val();
		$("#addType").val(addType);
		var homeUrl						 = $("#homeUrl").val();
		var restaurant_id               = $("#restaurant_id").val();
		var dish_id                     = $("#dish_id").val();
		var suppliment_name             = $("#suppliment_name").val();
		var allergy_information         = $("#allergy_information").val();
		var is_active                   = $("#is_active").val();

			   $("#restaurant_name_valids").hide();
			   $("#section_category_valid").hide();
			   $("#suppliment_name_validation").hide();
			   $("#allergy_information_validation").hide();
			   $("#is_active_validation").hide();
			   
		if(restaurant_id=="")
		{
		  $("#restaurant_id").focus();
		  $("#restaurant_name_valids").show();
		  return false;

		}
		if(dish_id=="")
		{
		  $("#dish_id").focus();
		  $("#section_category_valid").show();
		  return false;

		}

		if(suppliment_name=="")
		{
		  $("#suppliment_name").focus();
		  $("#suppliment_name_validation").show();
		  return false;

		}


		if(allergy_information=="")
		{
			$("#allergy_information").focus();
			$("#allergy_information_validation").show();
			return  false;

		}

		if($('input[type=radio][name=is_active]:checked').length == 0)
		 {
		  $("#is_active").focus();
		  $("#is_active_validation").show();
			 return false;
		 }	
		 		
			$("#suppForm").submit();
		 
	});
	});

	function fnDeleteDishSupplimentsRow(rowId) {
		
		$("#deleteRowId").val(rowId);
	}
	$(document).ready(function(){
		  $("#confirmDeleteDishSupplimentsRow").click(function(){
		 
		var deleteRowId = $("#deleteRowId").val();
		var homeUrl = $("#homeUrl").val();
		posturl = homeUrl+"am/delete-suppliments";
			

		$.post(
		  posturl, {		
		  deleteRowId: deleteRowId,
     	  _csrf: csrfTokenPage,			  
		  
		},	
		function (ResponseData){
			if($.trim(ResponseData) === '1') {
				location.reload();
				} 
			});  


		});
	});

$(document).ready(function(){
	dish_disco = function() {
	var dish_price = Number(document.getElementById("dish_price").value);
	var dish_discount_percentage = Number(document.getElementById("dish_discount_percentage").value) / 100;
	var dish_discount_price = dish_price - (dish_price * dish_discount_percentage)
	document.getElementById("dish_discount_price").value = dish_discount_price.toFixed(2);
   }
});


$(document).ready(function(){	

$("#submitbuttonpostalcodes").click(function(){

var restaurant_delivery_postal_code       = $("#restaurant_delivery_postal_code").val();
   
	     $("#restaurant_delivery_postal_code_validation").hide();
		 
	
if(restaurant_delivery_postal_code=="")
{
	$("#restaurant_delivery_postal_code").focus();
	$("#restaurant_delivery_postal_code_validation").show();
	return  false;

}

});
});


function fnDeleteRow(rowId) {
	
	$("#deleteRowId").val(rowId);
}
$(document).ready(function(){
	  $("#confirmDeleteRow").click(function(){
     
	var deleteRowId = $("#deleteRowId").val();
	var homeUrl = $("#homeUrl").val();
	posturl = homeUrl+"am/delete-postal";
		

	$.post(
	  posturl, {		
	  deleteRowId: deleteRowId,
	  _csrf: csrfTokenPage,			  
	  
	},	
	function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  


	});
});

function fnGetCityRestaurants() {
	var restaurant_city = $("#restaurant_city").val();

	var homeUrl = $("#relativeUrl").val();

	posturl = homeUrl+"as/select-city-restaurant";
			
		$.post(
		  posturl, {		
		  restaurant_city: restaurant_city,
	      _csrf: csrfTokenPage,				  
	 	},	
		function (ResponseData){
			$("#selectRestaurant").html(ResponseData);
		}); 

}


$("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="restaurant_delivery_postal_code[]" class="form-control m-input" placeholder="Enter postal code" autocomplete="off">';
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
