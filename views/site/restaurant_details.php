<?php

use app\models\RtCommonMethod;
use app\models\RiCommonMethods;
use app\models\BsCommonMethods;
/* @var $this yii\web\View */

$session = Yii::$app->session;
$session->open();

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$restaurant_name = Yii::$app->getRequest()->getQueryParam('alias');

$restaurantCity = "Berlin";
date_default_timezone_set('Europe/'.$restaurantCity);

$this->title = 'Restaurant Details Page';

$startsAt = date('Y-m-d H:i:s');

$timeNow = strtotime($startsAt); 

$currentHour = date('Hi');

$this->registerJsFile($relativeHomeUrl . 'js/jquery-3.4.1.min.js');

$RtCommonMethod = new RtCommonMethod();
$BsCommonMethods = new BsCommonMethods();
$restaurant_id = $dataFromAddressRestaurant['restaurant_id'];

$suplimentTxt = "Add";
$orderTxt = "Order Online";
if($dataFromRestaurant['is_delivery_availabe'] != 'Y' || $isDeliveryAvailable == 'N') {
	$suplimentTxt = "View";
	$orderTxt = "View Dishes";
}
//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
?>
<div class="container">
    <section class="photo-gallery">
        <div class="row magnific-gallery">

            <?php
            $g = 0;

            foreach ($dataFromRestaurantImages as $res) {
                if ($g == 0) {
                    $galleryClassName = "col-sm-12 col-md-8";
                } else {
                    $galleryClassName = "col-sm-2 blocks";
                }
                if ($g % 2 != 0 || $g == 0) {
            ?>
                    <div class="<?= $galleryClassName; ?>">
                    <?php } ?>
                    <a href="<?= $relativeHomeUrl . $res['restaurants_gallery_image'] ?>" title="Photo title" data-effect="mfp-zoom-in">
                        <?php
                        if ($g == 3) { ?>
                            <div class="bg-btn">
                                <p>View Gallery</p>
                            </div>
                        <?php
                        }
                        ?>
                        <img src="<?= $relativeHomeUrl . $res['restaurants_gallery_image'] ?>" class="img-gallery" />
                    </a>
                    <?php
                    if ($g % 2 == 0 || $g == 0) {
                    ?>
                    </div>
            <?php
                    }
                    $g++;
                } ?>
        </div>
    </section>
    <section>
        <div class="detail_page_head clearfix">

            <div class="title">
                <h1><?= $dataFromRestaurant['restaurant_name']; ?></h1>
                <p><?= $dataFromAddressRestaurant['restaurant_street'] . ", " . $dataFromAddressRestaurant['restaurant_pincode'] . " " . $dataFromAddressRestaurant['restaurant_city']; ?> </p>
                <p><span>Opening and closing time</span><br />
                    <?php 
                    $isRestaurantClose = '';
                    foreach ($dataFromRestaurantTime as $res) {

                        if (date("l") == $res['timing_day']) {
                            $isRestaurantClose = $res['is_restaurant_close'];
							$restaurantStartTime = str_replace(":","",$res['restaurant_start_time']);
                            $restaurantEndTime = str_replace(":","",$res['restaurant_end_time']);
                    ?>
                            <span class="bold">
                            <?php } 
                            if($res['is_restaurant_close'] == 'Y') { ?>
                            <?= $res['timing_day'] . " - " . "Closed"; ?><br />
                           <?php } else {
                            ?>
                            <?= $res['timing_day'] . " - " . $res['restaurant_start_time'] . " till " . $res['restaurant_end_time'] ; ?><br />
                            <?php
                             }
                            if (date("l") == $res['timing_day']) { ?>
                            </span>
                    <?php }
                        } ?>
                </p>
                <ul class="tags">
                    <li><a href="#review-in-dialog" id="review-in"><i class="icon_star"></i> Add Reviews</a></li>
                    <li><a href="#share-in-dialog" id="share-in"><i class="social_share"></i> &nbsp; Share</a></li>
                </ul>

            </div>
            <div class="rating1">
                <ul>
                    <li>
						<strong><?=!empty($restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsCount'])?$restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsCount']:0;?></strong> Restaurant Reviews
                        <div class="rating">
							<?php if(!empty($restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsCount'])) { ?>
							<strong><?=number_format($restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsSum']/$restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsCount'], 1, '.', '');?></strong>
                            <?php
                            $reviewCount = 0;
                            $reviewCount = number_format($restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsSum']/$restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsCount'],1, '.', '');
                            for($r = 1; $r<=5; $r++) {
                                if($r <= $reviewCount) { ?>
                                    <span class="rates">☆</span>
                                <?php } else { ?>
                                    <span>☆</span>
                               <?php }
                            }
                            
                            ?>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
               <?php 
			   $reviewCountOrder = 0;
			   if(!empty($restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsCount'])) { ?>
				<ul style="padding-top: 12px;">
                    <li>
						<strong><?=!empty($restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsCount'])?$restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsCount']:0;?></strong> Delivery Reviews
                        <div class="rating">
							<strong><?=number_format($restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsSum']/$restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsCount'], 1, '.', '');?></strong>
                            <?php
                            if(!empty($restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsCount'])) {
                            $reviewCountOrder = number_format($restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsSum']/$restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsCount'], 1, '.', '');
                            for($r = 1; $r<=5; $r++) {
                                if($r <= $reviewCountOrder) { ?>
                                    <span class="rates">☆</span>
                                <?php } else { ?>
                                    <span>☆</span>
                               <?php }
                            }
                            
                            ?>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
            <?php } ?>
            </div>
        </div>

    </section>
</div>
<!--Container-->

<div class="container">
    <div class="row">
        <div class="col-lg-8">

            <div class="tabs_detail">
                <ul class="nav nav-tabs" role="tablist">
                <?php
                  if(!empty($dataFromRestaurantDishes)) {
                      $activeForPaneA = 'active';
                      $activeForPaneB = '';
                ?>
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab"><?=$orderTxt;?></a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Restaurant Reviews</a>
                    </li>

					<li class="nav-item">
                        <a id="tab-D" href="#pane-D" class="nav-link" data-toggle="tab" role="tab">Delivery Reviews</a>
                    </li>


                    <li class="nav-item">
                        <a id="tab-A" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Menu</a>
                    </li>
                <?php } else { 
                    $activeForPaneA = '';
                    $activeForPaneB = 'active';
                    ?>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
                    </li>
					<li class="nav-item">
                        <a id="tab-D" href="#pane-D" class="nav-link" data-toggle="tab" role="tab">Order Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-B" class="nav-link active" data-toggle="tab" role="tab">Menu</a>
                    </li>
					
                <?php } ?>
                </ul>

                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade show <?=$activeForPaneA?>" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5>
                                <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
                                    <?=$suplimentTxt;?>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body info_content">
                                <?php
                                $menuName = "";
                                $dishesCount = count($dataFromRestaurantDishes);
                                $disLoopCount = 0;
                                foreach ($dataFromRestaurantDishes as $res) {
                                    $disLoopCount++;
                                    if ($menuName != $res['menu_name']) {
                                ?>
                                        <table class="table table-striped cart-list">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    <p class="info_heading"><?= $res['menu_name']; ?></p>
                                                    </th>
                                                    <th>
                                                        &nbsp;
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php } ?>
                                            <tr>
                                                <td class="d-md-flex align-items-center">
                                                    <div class="flex-md-column">
                                                        <h4><span id="dish_name_<?=$res['dish_id'];?>"><?= $res['dish_name']; ?></span>
                                                        <?php if (!empty($res['dish_allergy_text'])) { ?> <button type="button" class="info_p" data-toggle="modal" data-target="#myModal_<?= $res['dish_id']; ?>">Product Info</button>
														<?php if($res['is_dish_halal'] == 'Y') {  ?>
														<span style="font-size: 12px;color: orange;outline: none;margin-left: 5px;background: no-repeat;">Halal</span>
														<?php } ?>
														</h4> <!-- Modal -->
                                                        <div class="modal fade" id="myModal_<?= $res['dish_id']; ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h3><?= $res['dish_name']; ?></h3>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p><?= $res['dish_allergy_text']; ?></p>
                                                                    </div>
                                                                    <button type="button" class="mfp-close" data-dismiss="modal"></button>
                                                                </div>
                                                            </div>
                                                        </div> <?php } ?>
                                                    <!-- Modal Closed -->
                                                    </h4>
                                                    <p> <?= $res['dish_info_english']; ?> </p> <strong>€<?= $res['dish_price']; ?></strong>
                                                    </div>
                                                </td>
                                                <td class="options menu-details">
												<?php 
												if($dataFromRestaurant['is_delivery_availabe'] != 'Y' || $isDeliveryAvailable == 'N') { ?>
												<button class="btn_1">Delivery not Availabe</button>                
												<?}else if($currentHour < $restaurantStartTime || $currentHour > $restaurantEndTime || $isRestaurantClose == 'Y') { ?>
                                                <button class="btn_1">Closed</button>                
												<?php } else { ?>
												<button class="btn_1" onclick="basketUpdate('add','display','<?= $res['dish_id']; ?>');" data-toggle="modal" data-target="#exampleModal">Add to Cart</button>
												<?php } ?>
                                                   <!-- <div class="input-group ">
                                                        <div class="input-group-prepend"> <button style="min-width: 2.5rem" class="btn btn-decrement btn-outline-secondary" type="button" onclick="basketUpdate('subs','display','<?= $res['dish_id']; ?>');"><strong>−</strong></button> </div> <input type="text" id="display_<?= $res['dish_id']; ?>" name="display_<?= $res['dish_id']; ?>" inputmode="decimal" style="text-align: center" class="form-control " disabled="disabled" placeholder="" value="1">
                                                        <div class="input-group-append"> <button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary" type="button" onclick="basketUpdate('add','display','<?= $res['dish_id']; ?>');"><strong>+</strong></button> </div> -->
                                                    </div> 
                                                    <?php if (!empty($displayDishSupliments[$res['restaurant_id']][$res['dish_id']]['suppliment_name'])) { ?> 
                                                        <a class="info_p2" role="button" data-toggle="collapse" href="#collapseExample_<?= $res['dish_id']; ?>" aria-expanded="false" aria-controls="collapseExample"><?=$suplimentTxt;?> Supplements</a> 
                                                        <?php } ?>
                                                </td>
                                            </tr>


                                        <?php if(!empty($displayDishSupliments[$res['restaurant_id']][$res['dish_id']]['suppliment_name'])) { ?>
                                        <tr>
                                            <td colspan="2" class="accord">
                                                <div class="collapse" id="collapseExample_<?=$res['dish_id'];?>">
                                                    <!-- <div class="well">
                                                    <?php foreach($displayDishSuplimentsArr[$res['dish_id']] as $suplimentId) { ?>
                                                        <?=$suplimentName."<br>";?>
                                                        <?php } ?>
                                                    </div> -->
                                                    <div class="well">
                                                        <div class="row">
                                                        <div class="col-md-3"></div>
                                                        <div class="col-md-6">
                                                            <form>
                                                                <!-- <div class="form-group">
                                                                    <label>Your sauce:</label>
                                                                    <select class="form-control"><option>Test</option><option>Test1</option></select>
                                                                </div> -->
                                                                <div class="sub-items">

                                                                <?php 
                                                                $sup = 0;
                                                                $suplimentCount = count($dishSuplimentsArr[$res['dish_id']]);
                                                                foreach($dishSuplimentsArr[$res['dish_id']] as $suplimentId) { 
                                                                    $sup++;
                                                                
                                                                    if($sup == 3 && $suplimentCount > 3)  { ?>
                                                                    <a class="btn btn-primary plus info_p1" role="button" data-toggle="collapse" href="#showmore_<?=$res['dish_id'];?>" aria-expanded="false" aria-controls="collapseExample">
                                                                            Show <?= $suplimentCount - 2?> more
                                                                        </a>
                                                                        <div class="collapse margin-top10" id="showmore_<?=$res['dish_id'];?>">
                                                                   <?php } ?>
																   
                                                                        <div class="clearfix">
                                                                            <div class="checkboxes float-left">
                                                                                <label class="container_check" > 
																				<?php if(!empty($dishSuplimentsNameArr[$res['dish_id']][$suplimentId])) { 
																				$suplimentIds = "";
																				$keyForSuplimentIds = "";
																				$checkedSupliment = '';
																				if(!empty($_SESSION["shopping_cart"][$restaurant_id])) {
																					$keyForSuplimentIds = array_search($res['dish_id'], array_column($_SESSION["shopping_cart"][$restaurant_id], 'dish_id'));
																					if($keyForSuplimentIds !== false) {
																						$suplimentIds = $_SESSION["shopping_cart"][$restaurant_id][$keyForSuplimentIds]['suplimentIds'];
																						$suplimentIdsArr = explode(",",$suplimentIds);
																						if(in_array($suplimentId,$suplimentIdsArr)) {
																							$checkedSupliment = "checked = checked";
																						}
																					}
																				}
																				?>
                                                                                <?=$dishSuplimentsNameArr[$res['dish_id']][$suplimentId];?>
                                                                                <input class="Checkbox_<?=$res['dish_id'];?>" type="checkbox" value="<?=$suplimentId?>" name="supliments" id="supliments_<?=$suplimentId;?>_dish_<?=$res['dish_id'];?>" <?=$checkedSupliment;?>>
                                                                                <span class="checkmark"></span>
																				<?php } ?>
                                                                                </label>
                                                                            </div>
																			
                                                                            <?php if(!empty($dishSuplimentsAIArr[$res['dish_id']][$suplimentId])) { ?>
                                                                            <div class="float-right mt-1"><button type="button" class="info_p1" data-toggle="modal" data-target="#myModalSup_<?=$suplimentId;?>">Product Info</button></div>

                                                                             <!-- Modal -->
                                                                                <div class="modal fade" id="myModalSup_<?=$suplimentId;?>" role="dialog">
                                                                                    <div class="modal-dialog">
                            
                                                                                    <!-- Modal content-->
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                        
                                                                                            <h3><?=$dishSuplimentsNameArr[$res['dish_id']][$suplimentId];?></h3>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                        <p><?=$dishSuplimentsAIArr[$res['dish_id']][$suplimentId];?></p>
                                                                                        </div>

                                                                                        <button type="button" class="mfp-close" data-dismiss="modal"></button>

                                                                                    </div>
                                                                                    
                                                                                    </div>
                                                                                </div>

                                                                            <?php } ?>
                                                                            
                                                                        </div>
                                                                    
                                                              <?php  
                                                                }
                                                                ?>
                                                                
                                                                            </div>
                                                                            <?php
                                                                        if($suplimentCount == $sup ) { ?>
                                                                        <div>
                                                                        <?php    
                                                                        }
                                                            ?>
                                                         <!--   <div class="clearfix mt-3 mb-3">
                                                                                <div class="checkboxes float-left mt-2">
                                                                                    <div class="input-group ">
                                                    
                                                      
                                                   

                                                </div> -->
                                                                                </div>
                                                                                <div class=" mt-1" style="width: 75%;float: right;">
																				<?php 
																					if($dataFromRestaurant['is_delivery_availabe'] != 'Y' || $isDeliveryAvailable == 'N') { ?>
																						<button class="btn_1">Delivery not Availabe</button>                
																					<?}else if($currentHour < $restaurantStartTime || $currentHour > $restaurantEndTime) { ?>
																						<button class="btn_1">Closed</button>
																				<?php } else { ?>
																					<a onclick="basketUpdate('add','supliment','<?=$res['dish_id'];?>');" class="btn_1 full-width mb_5" data-toggle="modal" >Add to Cart</a>
																				<?php } ?>
                                                                               </div>
                                                                </div>                                              
                                                            </form>
                                                    </div>
                                                </div>
                                                 </div>
                                               </div>
                                            </td>
                                        </tr>   
                                        <?php } ?>  





                                            <?php

                                            if ($disLoopCount == $dishesCount) {
                                            ?>
                                            </tbody>
                                        </table>
                                    <?php }
                                    ?>
                                <?php

                                    $menuName = $res['menu_name'];
                                }
                                ?>

                            </div>
                        </div>
                    </div>
					<input type="hidden" id="restaurant_id" name="restaurant_id" value="<?= base64_encode($dataFromRestaurant['restaurant_id']); ?>"/>
                    <input type="hidden" id="review_type" name="review_type" value="from-restaurant-details-page"/>
                    <!-- /tab -->
                    <div id="pane-B" class="card tab-pane <?=$activeForPaneB?>" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5>
                                <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="true" aria-controls="collapse-B">
                                    Information
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body info_content">


                                <div class="add_bottom_25"></div>
                                <h2><?= $dataFromRestaurant['restaurant_name']; ?> Menu</h2>
                                <div class="pictures magnific-gallery clearfix">
                                <?php
                                
                                foreach($restaurantGetMenus as $res) { ?>
                                    <figure><a href="<?= $relativeHomeUrl ?>/<?=$res['menu_image'];?>" title="Photo title" data-effect="mfp-zoom-in"><img src="<?= $relativeHomeUrl ?>/<?=$res['menu_image'];?>" data-src="<?= $relativeHomeUrl ?>/<?=$res['menu_image'];?>" class="lazy" alt=""></a></figure>
                                <?php } ?>
                                </div>
                                <!-- /pictures -->

                            </div>
                        </div>
                    </div>
                    <!-- /tab -->

                    <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
                        <div class="card-header" role="tab" id="heading-C">
                            <h5>
                                <a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-C">
                                    Reviews
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-C" class="collapse" role="tabpanel" aria-labelledby="heading-C">
                            <div class="card-body reviews">
                                <div class="row add_bottom_45 d-flex align-items-center">


                                    <div class="col-md-3">
                                        <div id="review_summary">
										    <em>Average</em>
                                            <strong><?=$reviewCount;?></strong>
                                            <small>Based on <?=!empty($restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsCount'])?$restaurantReviews[ENUM_FROM_RESTAURANT_DETAILS_PAGE]['reviewsCount']:0;?>  reviews</small>
                                        </div>
                                    </div>
									<div class="col-md-9 new-ratings">
										<div class="rating1">
										<ul>
											<li>
												<div class="rating">
													<?php
														for($r = 1; $r<=5; $r++) {
															if($r <= $reviewCount) { ?>
																<span class="rates">☆</span>
															<?php } else { ?>
																<span>☆</span>
														   <?php }
														}
													?>
												</div>
											</li>
										</ul>
										</div>
									</div>

                                    
                                </div>

                                <div id="reviews">
                                <?php foreach($restaurantGetReviews as $res) { 
                                    
                                    //echo $res['reviewed_on'];
                                    //$time = strtotime($res['reviewed_on']);
                                    /*$dbDate = new \DateTime($res['reviewed_on']);
                                    $currDate = new \DateTime();
                                    $interval = $currDate->diff($dbDate);*/
                                    //echo $interval->d." days ".$interval->h." hours";
                                    ?>
                                    <div class="review_card">
                                        <div class="row">
                                            <div class="col-md-2 user_info">
                                                <figure><img src="<?= $relativeHomeUrl ?>/img/avatar4.jpg" alt=""></figure>
                                                <h5><?= $res['reviewer_name'];?></h5>
                                            </div>
                                            <div class="col-md-10 review_content">
                                                <div class="clearfix add_bottom_15">

                                                    <span class="rating"><?=$res['tap_to_rate_your_experience'];?><small>/5</small> <strong>
													<div class="rating">
													<?php
														for($r = 1; $r<=5; $r++) {
															if($r <= $res['tap_to_rate_your_experience']) { ?>
																<span class="rates">☆</span>
															<?php } else { ?>
																<span>☆</span>
														   <?php }
														}
													?>
													</div>
													</strong></span>
                                                    <em><?=date("d.m.Y", strtotime($res['reviewed_on']));?></em>
                                                </div>
                                                <h4>"<?=$res['review_title'];?>"</h4>
                                                <p><?=$res['your_review'];?></p>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                <?php } ?>
                                    <!-- /review_card -->
                                    
                                    <!-- /review_card -->
                                    
                                    <!-- /review_card -->
                                </div>
                                <!-- /reviews -->
                                <!--<div class="text-right"><a href="leave-review.html" class="btn_1">Leave a review</a></div>-->
                            </div>

                        </div>
                    </div>

                    <div id="pane-D" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-D">
                        <div class="card-header" role="tab" id="heading-D">
                            <h5>
                                <a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-D">
                                    Reviews
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-D" class="collapse" role="tabpanel" aria-labelledby="heading-D">
                            <div class="card-body reviews">
                                <div class="row add_bottom_45 d-flex align-items-center">

                                    <div class="col-md-3">
                                        <div id="review_summary">
											<em>Average</em>
                                            <strong><?=$reviewCountOrder;?></strong>
                                            <small>Based on <?=!empty($restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsCount'])?$restaurantReviews[ENUM_FROM_ORDER_EMAIL]['reviewsCount']:0;?> Order Reviews</small>
                                        </div>
                                    </div>
                                    <div class="col-md-9 new-ratings">
										<div class="rating1">
										<ul>
											<li>
												<div class="rating">
													<?php
														for($r = 1; $r<=5; $r++) {
															if($r <= $reviewCountOrder) { ?>
																<span class="rates">☆</span>
															<?php } else { ?>
																<span>☆</span>
														   <?php }
														}
													?>
												</div>
											</li>
										</ul>
										</div>
									</div>
                                </div>

                                <div id="reviews">
                                <?php foreach($restaurantOrderReviews as $res) {  ?>
                                    <div class="review_card">
                                        <div class="row">
                                            <div class="col-md-2 user_info">
                                                <figure><img src="<?= $relativeHomeUrl ?>/img/avatar4.jpg" alt=""></figure>
                                                <h5><?= $res['reviewer_name'];?></h5>
                                            </div>
                                            <div class="col-md-10 review_content">
                                                <div class="clearfix add_bottom_15">
                                                    <span class="rating"><?=$res['tap_to_rate_your_experience'];?><small>/5</small> <strong>
													<div class="rating">
													<?php
														for($r = 1; $r<=5; $r++) {
															if($r <= $res['tap_to_rate_your_experience']) { ?>
																<span class="rates">☆</span>
															<?php } else { ?>
																<span>☆</span>
														   <?php }
														}
													?>
													</div>
													</strong></span>
                                                    <em><?=date("d.m.Y", strtotime($res['reviewed_on']));?></em>
                                                </div>
                                                <h4>"<?=$res['review_title'];?>"</h4>
                                                <p><?=$res['your_review'];?></p>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                <?php } ?>
                                    <!-- /review_card -->
                                    
                                    <!-- /review_card -->
                                    
                                    <!-- /review_card -->
                                </div>
                                <!-- /reviews -->
                                <!--<div class="text-right"><a href="leave-review.html" class="btn_1">Leave a review</a></div>-->
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /tabs_detail -->
        </div>
        <!-- /col -->

        <div class="col-lg-4" id="sidebar_fixed">
            <?= $this->render(
                'restaurant_basket',
                [
				"restaurantId" => $dataFromRestaurant['restaurant_id'],
				"dataFromRestaurant" => $dataFromRestaurant,
				]
            ); ?>
            <!-- /box_booking -->

        </div>

    </div>
    <!-- /row -->
</div>
<!-- /container -->

<!-- Review Modal -->
<input type="hidden" name="pageOpenFrom" id="pageOpenFrom" value="<?=$pageOpen;?>" />
<input type="hidden" id="home_url" name="home_url" value="<?= $relativeHomeUrl; ?>"/>
<input type="hidden" id="resturant_name" name="resturant_name" value="<?= $dataFromRestaurant['restaurant_name']; ?>"/>
<div id="review-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="modal_header">
        <h3>Write a Review</h3>
    </div>
    <?php
	
	if(empty($_SESSION["google_login"]["logged_email"])) { ?>
        <div style="text-align:center" id="my-signin2" data-redirecturi="<?=SITE_URL?>"></div>		

   <?php } else { ?>
    
   <div>
    <form method="post">
        <div class="box_general write_review">
        	<input type="hidden" id="star_ratings_by_user" name="star_rating_by_user" value="5"/>
            <label class="d-block add_bottom_15">Tap to rate your experience</label>
            <div class="reviews-stars" id="tap_to_rate_your_experience" name="tap_to_rate_your_experience" value="">
                <a href="#" id="astar_1" class="icons selected"><i class="icon_star star" id="star1" data-datac="1"></i></a>
                <a href="#" id="astar_2" class="icons selected"><i class="icon_star star" id="star2" data-datac="2"></i></a>
                <a href="#" id="astar_3" class="icons selected"><i class="icon_star star" id="star3" data-datac="3"></i></a>
                <a href="#" id="astar_4" class="icons selected"><i class="icon_star star" id="star4" data-datac="4"></i></a>
                <a href="#" id="astar_5" class="icons selected"><i class="icon_star star" id="star5" data-datac="5"></i></a>
                <div class="invalid-feedback" id="star_rating_error">
                            Please select Star Rating
                </div>
            </div>
            

            <div class="form-group">
                <label>Review Title</label>
                <input class="form-control" type="text" id="review_title" name="review_title" placeholder="If you could say it in one sentence, what would you say?">
            </div>
            <div class="form-group">
                <label>Your review</label>
                <textarea id="your_review" maxlength="300" rows="4" name="your_review" class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
				<span class="text-muted text-sm">Characters remaining:  <span id="hNotesChars">300</span></span>
                <div class="invalid-feedback" id="your_review_error">
                            Please enter review
                </div>
            </div>
            
            <input type="hidden" name="starReview" id="starReview" value="5">
            <input type="hidden" id="ordered_id" name="ordered_id" value=""/>
            <a href="" id="reviewsubmit" class="btn_1">Submit review</a>
        </div>
    </form>
    </div>
	<?php } ?>
    <!--form -->
</div>
<!-- /Review In Modal -->

<!-- Share Modal -->
<div id="share-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="modal_header">
        <h3>Share</h3>
    </div>
    <form>
        <div class="sign-in-wrapper new-box">
            <a href="" target="_blank" class="social-icons facebook"><i class="social_facebook"></i></a>
            <a href="" target="_blank" class="social-icons instagram"><i class="social_instagram"></i></a>
            <a href="" target="_blank" class="social-icons twitter"><i class="social_twitter"></i></a>
        </div>
    </form>
    <!--form -->
</div>
<!-- /Share In Modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <span id="dish_name_added">Double ka Mitha</span> added to shopping cart</span>
      </div>
    </div>
  </div>
</div>
<?php


$restaurant_details = $relativeHomeUrl . "js/restaurant_details.js?" . rand(1, 1000);
$this->registerJsFile($restaurant_details);
?>