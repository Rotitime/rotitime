<?php
use yii\helpers\Url;
use yii\web\Session;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\RtRestaurantDishes;
//Yii::$app->cart;
// Product is an AR model
//$product = RtRestaurantDishes::findOne(1);

// Get component of the cart
//$cart = Yii::$app->cart;

// Add an item to the cart
//$cart->add($product, $quantity);
$session = Yii::$app->session;
$session->open();
$subTotal = 0;

$relativeHomeUrl = Url::home();

$this->title = 'Restaurant Orders Page';

$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

?>


<main class="bg_gray pattern">
		
		<div class="container margin_60_40">
		    <div class="row justify-content-center">
		        <div class="col-xl-6 col-lg-8">
		        	<div class="box_booking_2 style_2">
					    <div class="head">
					        <div class="title">
					            <h3>Where do you want your order to be delivered? </h3>
					        </div>
					    </div>
						<div class="col-md-6">
						<div class="form-group">
						<?php
						if(!empty($error)) { ?>
						<div class="alert alert-danger" role="alert">
						
							<?=$error;?>
						</div>
						<?php
						}
						?>
						</div>
						</div>
					    <div class="main">

					        <div class="form-group">
					            <label>Address</label>
					            <input class="form-control" name="confirmation_address" id="confirmation_address" placeholder="Enter Your Address">
							</div>
							  <div class="invalid-feedback" id="confirmation_address_validation">
								Please Enter Your Address
							  </div>
					        <div class="form-group">
					            <label>Floor</label>
					            <input class="form-control" name="confirmation_floor" id="confirmation_floor" placeholder="Enter Floor Details">
					        </div>	
							  <div class="invalid-feedback" id="confirmation_floor_validation">
								Please Enter Your Floor
							  </div>							
					        <div class="row">
					            <div class="col-md-6">
					                <div class="form-group">
					                    <label>City</label>
					                    <input class="form-control" name="confirmation_city" id="confirmation_city" placeholder="Enter City Name">
					                </div>
							  <div class="invalid-feedback" id="confirmation_city_validation">
								Please Enter Your City
							  </div>
					            </div>
					            <div class="col-md-3">
					                <div class="form-group">
					                    <label>Postal Code</label>
					                    <input class="form-control" name="confirmation_postal_code" id="confirmation_postal_code" placeholder="">
					                </div>
							  <div class="invalid-feedback" id="confirmation_postal_code_validation">
								Please Enter Your Postal Code
							  </div>
					            </div>
					        </div>
					    </div>
					</div>
		        	<div class="box_booking_2 style_2">
					    <div class="head">
					        <div class="title">
					            <h3>How can we reach you? </h3>
					        </div>
					    </div>
					    <!-- /head -->
					    <div class="main">

					        <div class="form-group">
					            <label>Name</label>
					            <input class="form-control" name="confirmation_name" id="confirmation_name" placeholder="Enter Your Full Name">
					        </div>
							  <div class="invalid-feedback" id="confirmation_name_validation">
								Please Enter Your Name
							  </div>
					        <div class="form-group">
					            <label>E-mail</label>
					            <input class="form-control" name="confirmation_email" id="confirmation_email" placeholder="Enter Your Email Address">
					        </div>	
							  <div class="invalid-feedback" id="confirmation_email_validation">
								Please Enter Your E-mail
							  </div>
                             <div class="invalid-feedback" id="confirmation_right_email_validation">
								Please Enter valid E-mail
							  </div>						  
							<div class="row">
					            <div class="col-md-6">
					                <div class="form-group">
					                    <label>Phone Number</label>
					                    <input class="form-control" name="confirmation_phone_number" id="confirmation_phone_number" placeholder="Enter Your Phone Number">
					                </div>
							  <div class="invalid-feedback" id="confirmation_phone_number_validation">
								Please Enter Your Phone Number
							  </div>
								</div>
					            <div class="col-md-6">
					                <div class="form-group">
					                    <label>Company Name</label>
					                    <input class="form-control" name="confirmation_company_name" id="confirmation_company_name" placeholder="Enter Your Company Name">
					                </div>
								  <div class="invalid-feedback" id="confirmation_company_name_validation">
									Please Enter Your Company Name
								  </div>
					            </div>								
					        </div>
							  <div class="form-group">
						<label>Comments</label>            
						<br>
						<textarea rows="2" cols="77" name="order_comments" id="order_comments" form="usrform" placeholder="Enter comments here..."></textarea>
						   </div>
					    </div>
					</div>	
					<input type="hidden" id="restaurant_id" name="restaurant_id" value="<?= base64_encode($dataFromRestaurant['restaurant_id']); ?>"/>
					<input type="hidden" id="home_url" name="home_url" value="<?= $relativeHomeUrl; ?>"/>
					<!-- /box_booking -->
		            
					<!-- /box_booking -->
		        </div>
		        <!-- /col -->
		        <div class="col-xl-4 col-lg-4" id="sidebar_fixed">
		            <div class="box_booking">
		                <div class="head">
		                    <h3>Order Summary</h3>
		                </div>
		                <!-- /head -->
		                <div class="main">
		                	<ul class="clearfix">
                            <?php 
							if(!empty($_SESSION["shopping_cart"][$restaurant_id])) {
								$disableClass = "";
								$subTotal = 0;
								foreach($_SESSION["shopping_cart"][$restaurant_id] as $keys => $values) { 
									?>
		                		    <li><?=$values["dish_quantity"];?>x <?= $values["dish_name"]."<br>".$values["suplimentsNamesTxt"] ?><span>€<?=$values["dish_price"]*$values["dish_quantity"]?></span></li>
                                <?php  
								    $subTotal += $values["dish_price"]*$values["dish_quantity"]; 	
								} 
							
							}
							?>
		                	</ul>
		                	
		                	<ul class="clearfix">
		                		<li>Subtotal<span>€<?=$subTotal;?></span></li>
								<?php if($subTotal < $dataFromRestaurant['minimum_order_amount_for_delivery']) { ?>
		                		<li>Amount required to reach the minimum order value<span>&#128;<?=$dataFromRestaurant['minimum_order_amount_for_delivery']?></span></li>
								<?php } else { ?>
								<li>Delivery fee<span>Free</span></li>
								<?php } ?>
		                		<li class="total">Total<span>€<?=$subTotal;?></span></li>
		                	</ul>
							<?php if(!empty($_SESSION["shopping_cart"][$dataFromRestaurant['restaurant_id']]) && $subTotal >= $dataFromRestaurant['minimum_order_amount_for_delivery']) { ?>
								<a  href="" id="order_page" class="btn_1 full-width mb_5">Order Now</a>
							<?php } else { ?>
								<a  class="btn_1 full-width mb_5 disabled">Order Now</a>
							<?php } ?>
		                   
		                </div>
		            </div>
		            <!-- /box_booking -->
		        </div>

		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->
		
	</main>
	<!-- /main -->
	
<?php
		$restaurant_details = $relativeHomeUrl."js/restaurant_details.js?" . rand(1, 1000);
		$this->registerJsFile($restaurant_details);
?>