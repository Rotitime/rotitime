<?php
use yii\web\Session;
use app\models\RtCommonMethod;
use app\models\RiCommonMethods;
use app\models\RtSr;
$session = Yii::$app->session;

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();
$RtSr = new RtSr();

$this->title = 'Roti Time Search Result Page';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$RtCommonMethod = new RtCommonMethod();
$formatted_address = "";
if ($session->has('formatted_address')) {
	$formatted_address = $session->get('formatted_address');
}
$city = "";
if ($session->has('city')) {
	$city = $session->get('city');
}
$searchValue = Yii::$app->getRequest()->getQueryParam('sk');
			
$searchType = Yii::$app->getRequest()->getQueryParam('st');


$userLocationFromCookies = $RtSr->fnUserLocationFromCokiee();

if($searchType == 'city-dist' || $searchType == 'city') {
    $userClickedAddTxt = $searchValue;
}

$supportTextForMessage = "Restaurants in ";

if($searchType == 'dish' || $searchType == 'dish name') {
	$userClickedAddTxt = "Restaurants for ".$searchValue." in ". $userClickedAddTxt ;
	$supportTextForMessage = "";
}

?>
<main>
	
		<!--Add this div if address is prefteched-->
		<!--<div class="hero_single inner_pages background-image" data-background="url(img/home_section_1.jpg)">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				</div>
			</div>
		</div>
		/hero_single -->

		<?php 
			$isResPresentInAddress = 'Y';
			if(empty($restaurantDetailsPostalCodes) && empty($restaurantsInSearchDistrictDisplay) && empty($restaurantDetailsArrAttachedDist)) { 
			$isResPresentInAddress = 'N';
		?>
		<div class="hero_single version_2">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>Discover Indian Foods</h1>
							<p>The best Indian restaurants at the best price</p>
							<form method="post" class="main-search" action="<?=$relativeHomeUrl;?>site/restaurant-search-results">
								<div class="row no-gutters custom-search-input">
									<div class="col-lg-10">
										<div class="form-group">
											<span>Where:</span>
											<input class="form-control no_border_r address" id="autocomplete" onFocus="geolocate()" type="text" placeholder="City or attraction..." value="<?=$userLocationFromCookies;?>">
											<i class="icon_pin_alt"></i>
										</div>
									</div>
									<div class="col-lg-2">
										<input type="submit" value="Search" id="searchSubmit">
									</div>
								</div>
								<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
								<!-- /row -->
							</form>
						</div>
					</div>
					<!-- /row -->

					<div class="row justify-content-center">
						<div class="col-lg-12">
							<a rel="nofollow" id="precise_location" href="javascript:void(0);" onclick="getLocation()" role="button" class="search_nearby nearby_link"><i class="fas fa-location-arrow"></i>Use my precise location</a> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>


		<div class="near-me search-results">
			<div class="container margin_60_40">
				<div class="main_title center add_bottom_25">
					<span><em></em></span>
					<?php if($isResPresentInAddress == 'Y') { ?>
						<h2><?=$supportTextForMessage.$userClickedAddTxt;?></h2>
					<?php } else { ?>
						<h2>Sorry! till now we do not have Restaurants from <?=$userClickedAddTxt;?></h2>
					<?php } ?>
				</div>
				<div>
				<div class="row">
					<div class="col-md-12">
						<div class="list_home">
							<ul id="LoadMoreResraurants">
								<?php foreach($restaurantDetailsPostalCodes as $res) { 
								$restaurant_reviews_ratings = $res['restaurant_reviews'];
								$order_review_ratings        = $res['order_reviews'];
								
								?>
								<li>
									<a href="<?=$relativeHomeUrl.$res['restaurant_name']; ?>">
										<figure>
											<img src="<?= $relativeHomeUrl.$res['restaurant_image']; ?>" data-src="<?= $relativeHomeUrl.$res['restaurant_image']; ?>" alt="" class="lazy">
										</figure>
										<h3><?= $res['restaurant_name']; ?></h3>
										<small><?= $res['restaurant_street']; ?></small>
										<ul>
											<li>
												Restaurant Reviews
												<div class="rating">
												<?php
												for($r = 1; $r<=5; $r++) {
													if($r <= $restaurant_reviews_ratings) { ?>
														<span class="rates">☆</span>
													<?php } else { ?>
														<span>☆</span>
												   <?php }
												}	
												?>
												</div>
											</li>
											<?php if($res['is_delivery_availabe'] != 'Y') { ?>
												<li>Delivery<br/> <strong>No</strong></li>
											<?php } else {  ?>
												<li>Delivery<br/> <strong>Yes</strong></li>
											<?php } ?>
											<li>
												Delivery Reviews
												<div class="rating">
												<?php
												for($r = 1; $r<=5; $r++) {
													if($r <= $order_review_ratings) { ?>
														<span class="rates">☆</span>
													<?php } else { ?>
														<span>☆</span>
												   <?php }
												}	
												?>
												</div>
											</li>
										</ul>
									</a>
								</li>
							<?php } ?>	
							
							<?php foreach($restaurantsInSearchDistrictDisplay as $res) { 
									$restaurant_reviews_ratings = $res['restaurant_reviews'];
									$order_review_ratings        = $res['order_reviews'];
							?>
								<li>
									<a href="<?=$relativeHomeUrl.$res['restaurant_name']; ?>">
										<figure>
											<img src="<?= $relativeHomeUrl.$res['restaurant_image']; ?>" data-src="<?= $relativeHomeUrl.$res['restaurant_image']; ?>" alt="" class="lazy">
										</figure>
										<h3><?= $res['restaurant_name']; ?></h3>
										<small><?= $res['restaurant_street']; ?></small>
										<ul>
											<li>
												Restaurant Reviews
												<div class="rating">
												<?php
												for($r = 1; $r<=5; $r++) {
													if($r <= $restaurant_reviews_ratings) { ?>
														<span class="rates">☆</span>
													<?php } else { ?>
														<span>☆</span>
												   <?php }
												}	
												?>
												</div>
											</li>
											<li>Delivery<br/> <strong>No</strong></li>
											<!--<li>Delivery Charges <br/>  <strong>Free</strong></li>-->
										</ul>
									</a>
								</li>
							<?php } ?>

							<?php foreach($restaurantDetailsArrAttachedDist as $res) { 
									$restaurant_reviews_ratings = $res['restaurant_reviews'];
									$order_review_ratings        = $res['order_reviews'];
							?>
								<li>
									<a href="<?=$relativeHomeUrl.$res['restaurant_name']; ?>">
										<figure>
											<img src="<?= $relativeHomeUrl.$res['restaurant_image']; ?>" data-src="<?= $relativeHomeUrl.$res['restaurant_image']; ?>" alt="" class="lazy">
										</figure>
										<h3><?= $res['restaurant_name']; ?></h3>
										<small><?= $res['restaurant_street']; ?></small>
										<ul>
											<li>
												Restaurant Reviews
												<div class="rating">
												<?php
												for($r = 1; $r<=5; $r++) {
													if($r <= $restaurant_reviews_ratings) { ?>
														<span class="rates">☆</span>
													<?php } else { ?>
														<span>☆</span>
												   <?php }
												}	
												?>
												</div>
											</li>
											<li>Delivery<br/> <strong>No</strong></li>
											<!--<li>Delivery Charges <br/>  <strong>Free</strong></li>-->
										</ul>
									</a>
								</li>
							<?php } ?>

							</ul>
						</div>
					</div>

				</div>
								
			</div>
		</div>

			
		</div>				

	
	<input type="hidden" id="UserLocation" name="UserLocation" />
	<input type="hidden" id="searchValue" name="searchValue" value="<?=$searchValue?>" />
	<input type="hidden" id="searchType" name="searchType" value="<?=$searchType?>"  />
		
	</main>
<?php
$validation_js = "js/restaurant_homepage.js?" . rand(1, 1000);
$this->registerJsFile($validation_js);
?> 