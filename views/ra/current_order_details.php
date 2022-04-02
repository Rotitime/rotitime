<div class="content-wrapper">
     <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Accept & Print</h1>
          </div>
		  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><i class="nav-icon fas fa-truck-fast"></i></a> print </li>
             </ol>
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
ul.ml-list{ list-style-type:none; border-bottom:1px solid #dee2e6; padding-top:1em;	}
ul.ml-list li{ padding:11px;}
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
 		<div class="card">
			<ul class="ml-list">
			 			 <li class="clm-two">
							<i class="nav-icon fas fa-user"></i> 
							<?=$orderSummary['customer_name'];?><br>
						 </li>
						 <li class="clm-two">
							<a href="invoice.html" class="col-mail"><i class="nav-icon fas fa-phone"></i> 
							<?=$orderSummary['customer_phone_number'];?></a><br>
						 </li>
						 <li class="clm-two">
							<a href="accept&print.html" class="col-mail"><i class="nav-icon fas fa-envelope"></i> 
							<?=$orderSummary['customer_email'];?></a><br>
						 </li>
						 <li class="clm-two">
							<a href="invoice.html" class="col-mail"><i class="nav-icon fas fa-dollar-sign"></i> 
							<?=$orderSummary['customer_address'];?></a><br>
						 </li>
						 <li class="clm-two">
							<a href="invoice.html" class="col-mail"><i class="nav-icon fas fa-map-marker-alt"></i> 
							<?=$orderSummary['customer_city'];?></a><br>
						 </li>						
			 </ul>	
			  <!--<div class="map">
					<div class="row">
					  <div class="col-md-12">
						<div class="card">
						  <div class="card-header">
							<h5 class="card-title">Map</h5>

							<div class="card-tools">
							  <button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							  </button>
							   <button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							  </button>
							</div>
						  </div>
						  /.card-header
						  <div class="card-body" style="display: block;">
							<div class="row">
							  <div class="col-md-12">
								<p>
										<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15229.448560285453!2d78.5092874!3d17.3944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1644498447465!5m2!1sen!2sin" 
										width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
									</p>
							  </div>
							   
							 </div>
						   </div>
						  </div>
					   </div>
					 </div>
						<!--p>
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15229.448560285453!2d78.5092874!3d17.3944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1644498447465!5m2!1sen!2sin" 
							width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
						</p>
               </div>-->
			   <!--list-->
			   <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
					  <th>S.No</th>
                      <th>Dish</th>
                      <th>Suppliments</th>
					  <th>Qty</th>
                      <th>Price</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php 
					$i = 0;
					foreach($orderDetailsSummary as $res) { 
					$i++;
					?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$res['dish_name'];?></td>					 
                      <td><?php
						//print_r($$displayDishSupplimentsArr);
						$sumplimentsTxt = '';
						if(!empty($displaySuplimentsArr[$res['order_details_id']][$res['dish_id']])) {

							$suplimentIdsArr = $displaySuplimentsArr[$res['order_details_id']][$res['dish_id']];
							foreach($suplimentIdsArr as $supli) {
								$sumplimentsTxt .= $displayDishSupplimentsArr['suppliment_name'][$supli].", ";
							} ?>
							<?=rtrim($sumplimentsTxt,", ");?>
						
					   <?php
					   }
						?>
					</td>
					  <td><?= $res['dish_quantity'];?></td>
                      <td><?=$res['dish_price'];?></td>
                      <td>&euro;&nbsp;<?= $res['dish_price']*$res['dish_quantity'];?></td>
                    </tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
			  <ul class="clearfix" class="pull-right">
					<li>Subtotal: <span>&euro;<?=$orderSummary['order_sub_total'];?></span></li>
					<li>Delivery Fee: <span>&euro;<?=$orderSummary['order_delivery_charges']?></span></li>
					<li class="total">Total: <span>&euro;<?=$orderSummary['order_price'];?></span></li>
				</ul>
			 <input type="hidden" id="siteUrl" name="siteUrl" value="<?=SITE_URL;?>"> 

			 <div class="card-footer clearfix" id="actionbutton">
				
				<?php 
					$approveStatusClass = "style = 'display:none';"; 
					$rejectStatusClass = "style = 'display:none';"; 

					if($orderSummary['order_status'] == 'open') {
				?>
					<button type="button" id="approveBtn"  class="btn btn-primary float-right" onclick="changeOrderStatus('accepted','<?=base64_encode($order_id)?>');" >Approve	</button>

					<button class="btn btn-secondary" id="rejectBtn" onclick="changeOrderStatus('rejected','<?=base64_encode($order_id)?>');" >Reject</button>

				<?php } if($orderSummary['order_status'] == 'accepted') { 
						$approveStatusClass = '';
					}if($orderSummary['order_status'] == 'rejected') { 
						$rejectStatusClass = '';
					}
				?>
				<div class="alert alert-success" role="alert" id="approvedDiv" <?=$approveStatusClass;?>> Approved! </div>

				<div class="alert alert-secondary" role="alert" id="rejectedDiv" <?=$rejectStatusClass;?>> Rejected! </div>

				<div class="alert alert-danger" role="alert" id="faiedStatus" style="display:none;">Something went wrong. Please contact RotiTime Administrator! </div>
              </div>
             </div>
		   </section>
		  </div>
      </section>
   </div>
<script>
 // $.widget.bridge('uibutton', $.ui.button)
</script>

<?php
	$validation_js = SITE_URL."js/reports.js?" . rand(1, 1000);
	$this->registerJsFile($validation_js);
?>