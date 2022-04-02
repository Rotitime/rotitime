<?php
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

?>

<div class="box_booking">
					<div class="head">
						<h3>Shopping cart <?php echo $dataOfRestaurantDishes; ?> </h3>
					</div>
					<!-- /head -->
					<div class="main">
						<ul class="clearfix">
							<li><p><?= $dataOfRestaurantDishes['dish_name'] ?></p> 
							<div class="content_wrapper">
							<div class="input-group">
								<div class="input-group-prepend">
									<button style="min-width: 2.5rem" class="btn btn-decrement btn-outline-secondary" type="button"><strong>−</strong></button>
								</div>
									<input type="text" inputmode="decimal" style="text-align: center" class="form-control " placeholder="" value="1">
								<div class="input-group-append">
									<button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary" type="button"><strong>+</strong></button>
								</div>
							</div>
							<span>$<?=$dataOfRestaurantDishes['dish_price']*$dishQuantity?></span><a href="#0"></a>
							</div>
							</li>
							
						</ul>

						<ul class="clearfix total">
							<li>Subtotal<span>$56</span></li>
							<li>Delivery fee<span>$10</span></li>
							<li class="total">Total<span>$66</span></li>
						</ul>


						<a href="booking-delivery-2.html" class="btn_1 full-width mb_5">Order Now</a>
					</div>
				</div>