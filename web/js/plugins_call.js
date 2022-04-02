 $('.editor').summernote({
     fontSizes: ['10', '14'],
     toolbar: [
         // [groupName, [list of button]]
         ['style', ['bold', 'italic', 'underline', 'clear']],
         ['font', ['strikethrough']],
         ['fontsize', ['fontsize']],
         ['para', ['ul', 'ol', 'paragraph']]
     ],
     placeholder: 'Write here ....',
     tabsize: 2,
     height: 200
 });

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();

    $('#dataTable').DataTable();
    
    $('input[name="dates"]').daterangepicker();
});

$(document).ready(function() {
    $('.js-example-basic-single').select2();
	tags: true
});

$('#selectRestaurant').on('select2:select', function (e) {
  var data = e.params.data;
  $("#selectedRestId").val(data.id);
});

$(document).ready(function() {

    $(".applyBtn").click(function(){
     
        var report_dates = $("#report_dates").val();
        
        selected_dates = btoa(report_dates);

        var homeUrl = $("#homeUrl").val();
        
        //alert(selected_dates);
        window.location.href = homeUrl+"/reports/dashboard?selected_dates="+selected_dates;


        
        posturl = homeUrl+"reports/ajax-dashboard-reports";
                
        
            $.post(
              posturl, {		
                report_dates: report_dates,		
            },	
            function (ResponseData){

               var resultAjax =  ResponseData.split("##");
                
               $("#newRsCount").text(resultAjax[0]);
               $("#orderCount").text(resultAjax[1]);
              
                });  
        
        
            });
});