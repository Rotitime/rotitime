<?php foreach($finalArrayWithDistance as $key => $value) { ?>
	<li>
		<a href="details.html">
			<figure>
				<img src="<?= 'http://zefasa.com/rotitime/web/'.$displayRestaurantDetails[$key]['restaurant_image']; ?>" data-src="<?= 'http://zefasa.com/rotitime/web/'.$displayRestaurantDetails[$key]['restaurant_image']; ?>" alt="" class="lazy">
			</figure>
			<h3><?= $displayRestaurantDetails[$key]['restaurant_name']; ?></h3>
			<small><?= $displayRestaurantDetails[$key]['restaurant_street']; ?></small>
			<ul>
				<li>
					Reviews
					<div class="rating">
					<span class="rates">☆</span><span class="rates">☆</span><span>☆</span><span>☆</span><span>☆</span>
					</div>
				</li>
				<li>Delivery<br/> <strong><?= $displayRestaurantDetails[$key]['is_delivery_availabe'] == 'Y'?'Yes':'No';?></strong></li>
				<?php if($displayRestaurantDetails[$key]['is_delivery_availabe'] == 'Y') { ?><li>Delivery Charges <br/>  <strong><?= $displayRestaurantDetails[$key]['restaurant_delivery_chargers']; ?> € </strong></li> <?php } ?>
			</ul>
		</a>
	</li>
<?php } ?>	
