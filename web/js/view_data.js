function fnDeleteRow(rowId) {
	
	$("#deleteRowId").val(rowId);
}


$(document).ready(function(){
	  $("#confirmDeleteRow").click(function(){
     
	var deleteRowId = $("#deleteRowId").val();
	var homeUrl = $("#homeUrl").val();
	posturl = homeUrl+"am/delete-row";
		

	$.post(
	  posturl, {		
	  deleteRowId: deleteRowId,		
	},	
	function (ResponseData){
		if($.trim(ResponseData) === '1') {
			location.reload();
			} 
		});  


	});
});


