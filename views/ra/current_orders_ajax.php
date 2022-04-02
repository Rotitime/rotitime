<?php foreach($orderedWithinDurationArr as $res) { 
	  if(in_array($res['order_id'],$orderIdsArrSession)) continue;
?>
			<ul class="ml-list">
			 			<li class="clm-one"> 
							<strong class="">&euro;&nbsp;<?= $res['order_price']; ?></strong><br>
							<?= date("H:i",strtotime($res['ordered_on'])); ?>
						</li>
						<li class="clm-two">
							<a href="<?=SITE_URL?>ra/current-order-details?order_id=<?= base64_encode($res['order_id']) ?>" class="col-mail"><i class="nav-icon fas fa-map-marker-alt"></i> 
							<?= " Address: ".$res['customer_address'].", ".$res['customer_city']; ?></a><br>
							<a href="" class="clm2-smal"><i class="nav-icon fas fa-check"></i> Time : <?= date("H:i:s",strtotime($res['ordered_on'])); ?></a>							  
						</li>
			 </ul>	
		<?php } ?>		