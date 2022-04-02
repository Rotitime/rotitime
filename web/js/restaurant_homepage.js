var csrfTokenPage = $('meta[name="csrf-token"]').attr("content");

function getLocation() {

    
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    //x.innerHTML = "Geolocation is not supported by this browser.";
	alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
 // x.innerHTML = "Latitude: " + position.coords.latitude + 
  //"<br>Longitude: " + position.coords.longitude;
  var home_url = $("#relativeHomeUrl").val();
	
console.log(position);
  posturl = home_url+"site/get-user-location";
	

	$.post(
	  posturl, {		
	  latitude: position.coords.latitude,
	  longitude: position.coords.longitude,
	  _csrf: csrfTokenPage,

	},	
	function (ResponseData){

		$("#UserLocation").val(ResponseData);
		$("#jsResult").text(ResponseData); 
		$("#autocomplete").val(ResponseData); 
		});  
}


$(document).ready(function(){
	$("#ownerLogin").click(function(){

	var owner_email		 = $("#owner_email").val();
	var owner_password   = $("#owner_password").val();
	var home_url         = $("#relativeHomeUrl").val();
	
	$("#owner_email_validation").hide();
	$("#owner_password_validation").hide();
	$("#email_validation").hide();


	if(owner_email=="")
	{
	  $("#owner_email").focus();
	  $("#owner_email_validation").show();
	  return false;

	}

	if(owner_password=="")
	{
		$("#owner_password").focus();
		$("#owner_password_validation").show();
		return  false;

	}	
	
	posturl = home_url+"site/owner-login";
	
	$.post(
	  posturl, {		
	   owner_email: owner_email,
	   owner_password: owner_password,
	   _csrf: csrfTokenPage,
	},	

	function (ResponseData){
	alert(ResponseData);
		if($.trim(ResponseData) === '') {
			$("#owner_email").focus();
			$("#email_validation").show();
			return  false;
		} 
		else if($.trim(ResponseData) === '1') {
			window.location.href = home_url+"as/view-restaurants";
			return  false;
		} else if($.trim(ResponseData) === '2') {
			window.location.href = home_url+"as/add-restaurant";
			return  false;
		}  else {
			alert("Email are password are not correct.");
			return false;
		}
		
		});  

	});

});

$("#autocomplete").focus(function(){

  $("#searchSubmit").css("display", "inline").fadeOut();
});


$("#autocomplete").blur(function(){

  $("#searchSubmit").css("display", "inline").fadeIn();
});


$("#autocomplete_popup").focus(function(){

	$("#searchSubmit_popup").css("display", "inline").fadeOut();
});


$("#autocomplete_popup").blur(function(){

	$("#searchSubmit_popup").css("display", "inline").fadeIn();
});

$(".searchSubmit").click(function(e){

		var userLocation = $(".autocomplete").val();
		var home_url     = $("#relativeHomeUrl").val();
		if(userLocation == '') {
			alert("Please Select From Suggestions");
			e.preventDefault();
		} else {
			window.location.href = home_url+"site/restaurant-search-results";
			return false;
		}
});


function checkAddressExists(clicked_type, clicked_title) {
    var userLocation = $("#autocomplete").val();

    
    $("#clicked_type").val(clicked_type);
    $("#clicked_title").val(clicked_title);
    $("#clicked_text").text(clicked_title);

	if(userLocation == '') {
        $("#autocomplete").focus();
        //$( "div.opacity-mask" ).scrollTop( 100 );
        window.scrollTo(0, 0);
		$("#address_alert").show();
		return false;
	}
}
let placeSearch;
let autocomplete;

const componentForm = {
  street_number: "short_name",
  route: "long_name",
  sublocality_level_1: "long_name",
  //route: "short_name",
  //locality: "long_name",
  //administrative_area_level_1: "short_name",
  //country: "long_name",
  postal_code: "short_name",
};

function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
          document.getElementById("autocomplete"),
          { types: ["geocode"] }
        );


		autocomplete.setFields(["address_component"]);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
			
		autocomplete.setComponentRestrictions({
          country: ["de"],
        });

		 autocomplete.setFields(["address_components", "geometry", "icon", "name"]);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();
		
	
		var lat = place.geometry.location.lat();
		var lng = place.geometry.location.lng();
		
		var searchedAddValuesArr = [];   
		var searchedAddArrs = [];
		var searchedAddIndexArr = [];

		for (const component of place.address_components) {
		const addressType = component.types[0];

			if (componentForm[addressType]) {
			  const val = component[componentForm[addressType]];
			  searchedAddArrs[addressType]= val;
			  searchedAddValuesArr.push(val);
			  searchedAddIndexArr.push(addressType);
			}
		}
		
        clicked_type = $("#clicked_type").val();
        clicked_title = $("#clicked_title").val();
		var home_url     = $("#relativeHomeUrl").val();
    
		if(searchedAddIndexArr[0] != 'street_number') {
			alert("Please enter street number");
			return false;
		}

		posturl = home_url+"site/user-searched-location";

		$.post(
		  posturl, {		
		  latitude: lat,
		  longitude: lng,
		  searchedAddArrs: searchedAddArrs,
		  searchedAddValuesArr:searchedAddValuesArr,
		  searchedAddIndexArr: searchedAddIndexArr,
		  _csrf: csrfTokenPage,
		  


		},	
		function (ResponseData){
				//$("#jsResult").text(ResponseData); 
                $("#autocomplete").val(ResponseData); 
                var query_string = "";
                if(clicked_type != '' && clicked_title != '') {
                    query_string = "?st="+clicked_type+"&sk="+clicked_title;
                }
                
				if(clicked_type == 'restaurant') {
                    window.location.href = home_url+clicked_title;
                } else if(clicked_type != '') {
                    window.location.href = home_url+"site/restaurant-search-results"+query_string;
					
				}  else {
					window.location.href = home_url+"site/restaurant-search-results";
				}
				

		});  
		
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }

/*$(document).ready(function() {
 
 var endLimit = 5;
 var startLimit = 0;
 var action = 'inactive';
 var searchValue = $("#searchValue").val();
 var searchType = $("#searchType").val();
 function load_country_data(endLimit, startLimit)
 {
  $.ajax({
   url:"https://zefasa.com/rotitime/web/site/load-more-restaurants",
   method:"POST",
   data:{endLimit:endLimit, startLimit:startLimit, searchValue:searchValue, searchType:searchType},
   cache:false,
   success:function(data)

   {
    $('#LoadMoreResraurants').append(data);
    if(data == '')
    {
     ///$('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
     action = 'active';
    }
    else
    {
    // $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
     action = "inactive";
    }
   }
  });
 }

 /*$(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#LoadMoreResraurants").height() && action == 'inactive')
  {
   action = 'active';
   startLimit = startLimit + endLimit;
   setTimeout(function(){
    load_country_data(endLimit, startLimit);
   }, 1000);
  }
 });
 
});*/