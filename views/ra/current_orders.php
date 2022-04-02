<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Open Orders';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');



$editor_css = $relativeHomeUrl."admin_section/js/editor/summernote-bs4.css?" . rand(1, 1000);
$this->registerCssFile($editor_css);


$controllerName = Yii::$app->controller->id;

?>

<div class="content-wrapper">
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Orders</h1>
          </div> 
         </div> 
      </div> 
    </div>
     <section class="content">
      <div class="container-fluid">
	  <style>
.user-panel {
    border-top: 1px solid #4f5962 ;
    border-bottom: 1px solid #4f5962 !important;
}
.accnt-sctn{ font-size:18px !important; margin-bottom: 10px !important;
    border-bottom: 1px solid #4f5962 !important;}
	.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #5eb530;  }
ul.ml-list{ list-style-type:none; border-bottom:1px solid #dee2e6;}
ul.ml-list li{float:left; padding:11px;}
ul.ml-list li.clm-one { text-align:center;
    padding: 5px 5px 5px 5px;
    width: 80px;
    background: #eaeaea;
    margin-left: -35px;
    margin-top: 5px;
    margin-right: 15px;
}
a.clm2-smal{ font-size:12px; color:#7a7a7a;}
.col-mail{font-size:16	px; color:#414141; }
a.col-mail i, a.clm2-smal	i{margin-right:10px !important;}
.li-clm-line{ border-bottom:5px solid #414141}
.clm2-smal i{ color:green;}
.col-mail i{ color:green;}
a:hover { color: #414141; text-decoration: none;}
.btn-info {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
    box-shadow: none;
}
</style>
        <div class="row">
		<section class="col-lg-12 connectedSortable">	
 		<div class="card" id="divCard">
		<!-- <audio controls>
			  <source src="<?=SITE_URL?>/audio/alert-tone.wav" type="audio/wav">
			Your browser does not support the audio element.
			</audio> -->
		
		<?php 
		if(!empty($orderedWithinDurationArr)) {
		foreach($orderedWithinDurationArr as $res) { ?>
			<ul class="ml-list" id="displayOrdersUl">
			 			<li class="clm-one"> 
							<strong class="">&euro;&nbsp;<?= $res['order_price']; ?></strong><br>
							<?= date("H:i",strtotime($res['ordered_on'])); ?>
						</li>
						<li class="clm-two">
							<a href="<?=SITE_URL?>ra/current-order-details?order_id=<?= base64_encode($res['order_id']) ?>" class="col-mail"><i class="nav-icon fas fa-map-marker-alt"></i> 
							<?= " Address: ".$res['customer_address'].", ".$res['customer_city']; ?></a><br>
							<a href="" class="clm2-smal"><i class="nav-icon fas fa-check"></i> Time : <?= date("H:i:s",strtotime($res['ordered_on'])); ?></a>		

							
							<?php 
								$approveStatusClass = "style = 'display:none';"; 
								$rejectStatusClass = "style = 'display:none';"; 
								$order_id = $res['order_id'];
								if($res['order_status'] == 'open') {
							?>
								<button type="button" id="approveBtn"  class="btn btn-primary float-right" onclick="changeOrderStatus('accepted','<?=base64_encode($order_id)?>');" >Approve	</button>

								<button class="btn btn-secondary" id="rejectBtn" onclick="changeOrderStatus('rejected','<?=base64_encode($order_id)?>');" >Reject</button>

							<?php } if($res['order_status'] == 'accepted') { 
									$approveStatusClass = '';
								}if($res['order_status'] == 'rejected') { 
									$rejectStatusClass = '';
								}
							?>
							<div class="alert alert-success" role="alert" id="approvedDiv" <?=$approveStatusClass;?>> Approved! </div>

							<div class="alert alert-secondary" role="alert" id="rejectedDiv" <?=$rejectStatusClass;?>> Rejected! </div>

							
						</li>
			 </ul>	
		<?php } ?>
		<?php } else { ?>
			<div class="alert alert-secondary" role="alert">
				No open order yet!
			</div>
		<?php } ?>		 
			    <!-- <div class="card-footer clearfix">
			                    <a href="javascript:void(0)" class="btn btn-sm btn-info float-right">View All Orders</a>
			                    </div> -->
             </div>
		   </section>
		  </div>
      </section>
   </div>
   <input type="hidden" id="siteUrl" name="siteUrl" value="<?=SITE_URL;?>"> 
 <script type="text/javascript">
 setInterval(function(){
   /*var audio = new Audio('<?=SITE_URL?>'+'/audio/alert-tone.wav');
   audio.play();
   */

   ///var audio = new Audio('<?=SITE_URL?>'+'/audio/alert-tone.wav');
   //audio.play();

   var csrfTokenPage = $('meta[name="csrf-token"]').attr("content");
	siteUrl = $("#siteUrl").val();

	posturl = siteUrl+"ra/fetch-new-orders";

	$.post(	
        posturl, {
		_csrf: csrfTokenPage,
        },
        function (ResponseData){
			
			if(ResponseData != 'NoNewOrders') {
				$("#divCard").append(ResponseData);
				var audio = new Audio('<?=SITE_URL?>'+'/audio/alert-tone.wav');
				audio.play();
			}
			/*if(ResponseData == '1') {
				if(order_status == 'accepted') 
					$("#approvedDiv").show();
				if(order_status == 'rejected') 
					$("#rejectedDiv").show();
			} else {
				$("#faiedStatus").show();
			} */
				
        });
	//window.location.reload(1);
}, 
5000);

 </script>
 <?php
	$validation_js = SITE_URL."js/reports.js?" . rand(1, 1000);
	$this->registerJsFile($validation_js);
?>