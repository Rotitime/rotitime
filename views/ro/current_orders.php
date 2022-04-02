<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Restaurants';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
?>

  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Orders</li>
      </ol>

      <div class="box_general pb-3">
        <div class="header_box">
            <h2 class="d-inline-block">Todays Orders</h2>
            <div class="filter">
              <select name="orderFilter" id="orderFilter" class="selectbox" onchange="fnOrdersFilter();">
                  <option value="">All</option>
				  <option <?php if($order_status == 'open') { ?> selected="selected"  <?php } ?> value="open">Pending</option>
                  <option <?php if($order_status == 'accepted') { ?> selected="selected"  <?php } ?>  value="accepted">Approved</option>
                  <option <?php if($order_status == 'rejected') { ?> selected="selected"  <?php } ?>  value="rejected">Cancelled</option>
              </select>
                      </div>
        </div>
		<div id='divCard'>
		<?php
		if(!empty($orderedWithinDurationArr)) {
		foreach($orderedWithinDurationArr as $res) { 
			
		$order_id = $res['order_id'];
		?>
	
        <div class="list_general order">
            <ul>
                <li>
                    <!-- <figure><img src="img/item_1.jpg" alt=""></figure> -->
                    <h4><a href="<?=SITE_URL."/ro/order-details?rec_id=".base64_encode($order_id);?>"><?=$res['restaurant_name'];?></a>
					<?php  if($res['order_status'] == 'open') { ?>
					<i class="pending">Pending</i>
					<?php } else if ($res['order_status'] == 'accepted') { ?>
					<i class="approved">Approved</i>
					<?php } else if ($res['order_status'] == 'rejected') { ?>
					<i class="cancel">Rejected</i>
					<?php } ?>
					</h4>

                    <ul class="booking_list">
						<li>
							<strong>Order Price</strong> €<?=$res['order_price']?>
						</li>
                        <li><strong>Client</strong> <?=$res['customer_name'];?></li>
                        <li><strong>Date and time</strong> <?=$res['ordered_at'];?></li>
                        <li><strong>Address</strong> <?=$res['customer_address'];?>, <?=$res['customer_postal_code'];?>, <?=$res['customer_city'];?></li>
                        <li><strong>Client Contacts</strong> <a href="#0"><?=$res['customer_phone_number'];?></a> - <a href="#0"><?=$userInfo['user_email'];?></a></li>
						<li><strong>Order Comments</strong> <?=$res['order_comments'];?></li>
	
                    </ul>
					<?php  if($res['order_status'] == 'open') { ?>
                    <ul class="buttons">
                        <li><a href="#0" class="btn_1 gray approve" onclick="changeOrderStatus('accepted','<?=base64_encode($order_id)?>');" ><i class="fa fa-fw fa-check-circle-o"></i> Confirm</a></li>
                        <li><a href="#0" class="btn_1 gray delete" onclick="changeOrderStatus('rejected','<?=base64_encode($order_id)?>');" ><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li>
                    </ul>
					<?php } ?>
                </li>
            </ul>
        </div>
		<?php } 
		
		}
		?>
		</div>
        <hr>
		<?php
		if(empty($orderedWithinDurationArr)) { ?>
		<p>No Orders!</p>
		<?php } ?>
		<input type="hidden" id="siteUrl" name="siteUrl" value="<?=SITE_URL;?>"> 
        <!-- /total_order-->
    </div>
    <!-- /box_general-->
	  </div>
	  <!-- /.container-fluid-->
   	</div>
    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © RotiTime 2019</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Client Detail Modal -->
    <div class="modal fade" id="client_detail_modal" tabindex="-1" role="dialog" aria-labelledby="client_detail_modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="client_detail_modalLabel">Edit client detail</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" value="Mark Twain">
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Date</label>
                              <input type="text" class="form-control" value="5 November 2020">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Time</label>
                              <input type="text" class="form-control" value="08.30pm">
                          </div>
                      </div>
                  </div>
                  <!-- /Row -->
                  <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" value="Barda Bonilla 24 apt. 10, 2414 London">
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Telephone</label>
                              <input type="text" class="form-control" value="98432983242">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" value="mark@hotmail.com">
                          </div>
                      </div>
                  </div>
                  <!-- /Row -->
                  <div class="form-group">
                      <label>Payment method</label>
                      <div class="styled-select">
                          <select>
                              <option selected="">Paypal</option>
                              <option>Credit Card</option>
                              <option>Cash</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Withdrawal method</label>
                      <div class="styled-select">
                          <select>
                              <option selected="">Delivery</option>
                              <option>Take Away</option>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <a class="btn btn-primary" href="login.html">Save</a>
              </div>
          </div>
      </div>
  </div>    
	 <script type="text/javascript">
 setInterval(function(){
   /*var audio = new Audio('<?=SITE_URL?>'+'/audio/alert-tone.wav');
   audio.play();
   */

   ///var audio = new Audio('<?=SITE_URL?>'+'/audio/alert-tone.wav');
   //audio.play();

   var csrfTokenPage = $('meta[name="csrf-token"]').attr("content");
	siteUrl = $("#siteUrl").val();
	order_status = $("#orderFilter").val();

	posturl = siteUrl+"ro/fetch-new-orders";

	$.post(	
        posturl, {
		_csrf: csrfTokenPage,
		order_status: order_status,
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
