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
$session->open();
$subTotal = 0;
$disableClass = "disabled";
?>
<div class="box_booking">
					<div class="head">
						<h3>Shopping cart </h3>
					</div>
					<!-- /head -->
					<div class="main">
					<?php if(empty($_SESSION["shopping_cart"][$restaurantId])) { ?>
						<div class="empty text-center">
								<img src="http://zefasa.com/rotitime/web/img/shopping-basket-2.png" width="55" height="55" />
								<p >Add some tasty food from the menu and place your order.</p>
						</div>
					<?php } ?>
						<ul class="clearfix">
							<?php 
							if(!empty($_SESSION["shopping_cart"][$restaurantId])) {
								$disableClass = "";
								$subTotal = 0;
								foreach($_SESSION["shopping_cart"][$restaurantId] as $keys => $values) { 
									?>
                            <li><h6 class="main_dish"><?= ucfirst($values["dish_name"]);?></h6>
                            <p class="info_p3"><?=$values["suplimentsNamesTxt"]; ?></p> 
							<div class="content_wrapper">
							<div class="input-group">
								<div class="input-group-prepend">
									<button style="min-width: 2.5rem" class="btn btn-decrement btn-outline-secondary" type="button" onclick="basketUpdate('subs','basket','<?=$values['dish_id'];?>');"><strong>−</strong></button>
								</div>
									<input type="text" inputmode="decimal" id="basket_<?=$values['dish_id'];?>" name="basket_<?=$values['dish_id'];?>" style="text-align: center" class="form-control " placeholder="" value="<?=$values["dish_quantity"];?>" disabled = "disabled">
								<div class="input-group-append">
									<button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary" type="button" onclick="basketUpdate('add','basket','<?=$values['dish_id'];?>');"><strong>+</strong></button>
								</div>
							</div>
							<span>€<?=$values["dish_price"]*$values["dish_quantity"]?></span><a href="#0" onclick="basketUpdate('remove','basket','<?=$values['dish_id'];?>');"></a>
							</div>
							</li>
							<?php  
								$subTotal += $values["dish_price"]*$values["dish_quantity"]; 	
								} 
							
							}
							?>
						</ul>

						<ul class="clearfix total">
							<li>Subtotal<span>&#128;<?=$subTotal;?></span></li>
							<?php if($subTotal < $dataFromRestaurant['minimum_order_amount_for_delivery']) { ?>
							<li>Amount required to reach the minimum order value<span>&#128;<?=$dataFromRestaurant['minimum_order_amount_for_delivery']?></span></li>
							<?php } else { ?>
							<li>Delivery fee<span>Free</span></li>
							<?php } 
							/*if(isset($_SESSION["shopping_cart"][$restaurantId]))
							{
								$_SESSION["shopping_cart"][$restaurantId]['sub_total'] = $subTotal;
								$_SESSION["shopping_cart"][$restaurantId]['minimum_order_amount_for_delivery'] = $dataFromRestaurant['minimum_order_amount_for_delivery'];
								$_SESSION["shopping_cart"][$restaurantId]['restaurant_delivery_chargers'] = $dataFromRestaurant['restaurant_delivery_chargers'];
							}*/
							?>
							<li class="total">Total<span>&#128;<?=$subTotal;?></span></li>
						</ul>

                        <?php if(!empty($_SESSION["shopping_cart"][$restaurantId]) && $subTotal >= $dataFromRestaurant['minimum_order_amount_for_delivery']) { ?>
						<a href="https://zefasa.com/rotitime/confirmation/<?=str_replace(" ","-",$dataFromRestaurant['restaurant_name']);?>" class="btn_1 full-width mb_5 <?=$disableClass?>">Order Now</a>
                        <?php } else { ?>
						<a  class="btn_1 full-width mb_5 disabled">Order Now</a>
						<?php } ?>
					</div>
				</div>