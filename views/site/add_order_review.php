<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurant Owner';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

$restaurant_id = 12;

?>


	<main class="bg_gray pattern">
		
		<div class="container margin_60_40">
		    <div class="row justify-content-center">
		        <div class="col-lg-6">
		        	<div class="sign_up">
		                <div class="head">
		                    <div class="title">
		                    <h3>Write a Review</h3>
		                </div>
		                </div>
		                <!-- /head -->
		                <div class="main">
		                	<!--<h6>Restaurant Name</h6>-->
                            <?php  if($isReviewAdded == 'Y') {  ?>
                                <h6>Reviews added for this order.</h6>
                           <?php } else if($currentDateTime > $dateAfterTwoWeeksTime) { ?>
                                <h6>Link Expired. You can add review within 2 weeks of ordered date.</h6>
                            <?php } else { ?>
                            <form method="post">
                                <div class="box_general write_review">
                                <h4 class="d-block text-center"><strong><?=$dataFromRestaurant['restaurant_name'];?></strong></h4>
                            <p class="d-block text-center"><?= $dataFromAddressRestaurant['restaurant_street']." ".$dataFromAddressRestaurant['restaurant_city'];?></p>
                            <?php foreach($orderDetailsSummary as $res) { ?>
                            <label class="d-block"><?= $res['dish_quantity']?>x <?=$res['dish_name']?></td></label>
                            <?php } ?>
                                    <span class="add_bottom_15">&nbsp;</span>
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
                                        <textarea id="your_review" name="your_review" class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
                                        <div class="invalid-feedback" id="your_review_error">
                                                    Please enter review
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="starReview" id="starReview" value="5">
                                    <input type="hidden" id="restaurant_id" name="restaurant_id" value="<?= base64_encode($ordered_restaurant_id); ?>"/>
                                    <input type="hidden" id="ordered_id" name="ordered_id" value="<?= base64_encode($orderedId); ?>"/>
                                    <input type="hidden" id="review_type" name="review_type" value="from-order-email"/>
									<input type="hidden" id="home_url" name="home_url" value="<?= $relativeHomeUrl; ?>"/>
                                    <a href="" id="reviewsubmit" class="btn_1">Submit review</a>
                                </div>
                         </form>
                         <?php } ?>
						</div>
		            </div>
		            <!-- /box_booking -->
		        </div>
		        <!-- /col -->

		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->
		
	</main>


	<?php


$restaurant_details = $relativeHomeUrl . "js/restaurant_details.js?" . rand(1, 1000);
$this->registerJsFile($restaurant_details);
?>