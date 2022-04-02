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