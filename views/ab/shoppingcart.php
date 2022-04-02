			
			<div class="col-lg-4" id="sidebar_fixed">
						<div id="cart-item">
				<div class="box_booking">
					<div class="head">
						<h3>Shopping cart </h3>
						<a id="btnEmpty" href="" onClick="cartAction('empty','');">Empty Cart</a>
						<?php
                            $item_total = 0;
						?>	
					</div>
					<!-- /head -->
					<div class="main">
					   <?php
					   		if(isset($_SESSION["cart_item"])){
						    foreach ($_SESSION["cart_item"] as $item){
						?>
						<ul class="clearfix">
							<li><p><?=$item["dish_name"];?><span><?=$item["dish_price"]; ?></span><a href="#0" onClick="cartAction('remove','<?=$item["dish_id"]; ?>');"></a></p></li>
							<?php
							$total_quantity += $item["quantity"];
							$total_price += ($item["dish_price"]*$item["quantity"]);
					    }
						}
					    ?>
						</ul>

						<ul class="clearfix total">
							<li>Subtotal<span><?php echo "".number_format($total_price, 2); ?></span></li>
							<li>Delivery fee<span>$10</span></li>
							<li class="total">Total<span> <?=$total_price +10 ?> </span></li>
						</ul>


						<a href="booking-delivery-2.html" class="btn_1 full-width mb_5">Order Now</a>
					</div>
				</div>
				<!-- /box_booking -->

			</div>
			</div>
