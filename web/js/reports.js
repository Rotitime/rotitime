function reviewsApprove(review_id) {
   
    review_status = $("#approve_reviews_"+review_id).val();
    

    var homeUrl = $("#homeUrl").val();
    posturl = homeUrl+"reports/update-review-status"
    $.post(
        posturl, {		
            review_id: review_id,
            review_status: review_status,		
      },	
      function (ResponseData){
          /*if($.trim(ResponseData) === '1') {
              location.reload();
              } */
          });
}
/*$(document).ready(function(){
  $( ".selectreviews" ).change(function() {
    alert( "Handler for .change() called." );
    alert( this.value );
  });
});*/

function changeOrderStatus(order_status, order_id) {

	$("#approveBtn").hide();
	$("#rejectBtn").hide();

	var csrfTokenPage = $('meta[name="csrf-token"]').attr("content");
	siteUrl = $("#siteUrl").val();
	posturl = siteUrl+"ro/update-order-status";

        $.post(	
        posturl, {
        order_status: order_status,
        order_id: order_id,
		_csrf: csrfTokenPage,
        },
        function (ResponseData){
			
			if(ResponseData == '1') {
				if(order_status == 'accepted') 
					$("#approvedDiv").show();
				if(order_status == 'rejected') 
					$("#rejectedDiv").show();
			} else {
				$("#faiedStatus").show();
			}
				
        });
}


function fnOrdersFilter() {

	var order_status= $("#orderFilter").val();
	var siteUrl = $("#siteUrl").val();

	 window.location.href=siteUrl+'ro/new-orders?os='+order_status;

	/*posturl = siteUrl+"ro/update-order-status";

        $.post(	
        posturl, {
        order_status: order_status,
        order_id: order_id,
		_csrf: csrfTokenPage,
        },
        function (ResponseData){
			
			if(ResponseData == '1') {
				if(order_status == 'accepted') 
					$("#approvedDiv").show();
				if(order_status == 'rejected') 
					$("#rejectedDiv").show();
			} else {
				$("#faiedStatus").show();
			}
				
        }); */
}