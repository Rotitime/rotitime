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
?>
<main>
	
		<!--Add this div if address is prefteched-->
		<!--<div class="hero_single inner_pages background-image" data-background="url(img/home_section_1.jpg)">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				</div>
			</div>
		</div>
		/hero_single -->

		<?php if(empty($restaurantDetailsPostalCodes) && empty($restaurantDetailsArr)) { ?>
		<div class="hero_single version_2">
			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>Discover Indian Foods</h1>
							<p>The best Indian restaurants at the best price</p>
							<form method="post" class="main-search" action="https://zefasa.com/rotitime/web/site/restaurant-search-results">
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
					<h2>Restaurants in <?=$userClickedAddTxt;?></h2>
				</div>
				<div>
				<div class="row">
					<div class="col-md-12">
						<div class="list_home">
							<ul id="LoadMoreResraurants">
								<?php foreach($restaurantDetailsPostalCodes as $res) { ?>
								<li>
									<a href="http://zefasa.com/rotitime/web/ab/restaurant-basket?restaurant_id=<?php echo $res['restaurant_id']; ?>">
										<figure>
											<img src="<?= 'http://zefasa.com/rotitime/web/'.$res['restaurant_image']; ?>" data-src="<?= 'http://zefasa.com/rotitime/web/'.$res['restaurant_image']; ?>" alt="" class="lazy">
										</figure>
										<h3><?= $res['restaurant_name']; ?></h3>
										<small><?= $res['restaurant_street']; ?></small>
										<ul>
											<li>
												Reviews
												<div class="rating">
												<span class="rates">☆</span><span class="rates">☆</span><span>☆</span><span>☆</span><span>☆</span>
												</div>
											</li>
											<li>Delivery<br/> <strong>Yes</strong></li>
											<li>Delivery Charges <br/>  <strong>Free</strong></li>
										</ul>
									</a>
								</li>
							<?php } ?>	
							
							<?php foreach($restaurantDetailsArr as $res) { ?>
								<li>
									<a href="details.html">
										<figure>
											<img src="<?= 'http://zefasa.com/rotitime/web/'.$res['restaurant_image']; ?>" data-src="<?= 'http://zefasa.com/rotitime/web/'.$res['restaurant_image']; ?>" alt="" class="lazy">
										</figure>
										<h3><?= $res['restaurant_name']; ?></h3>
										<small><?= $res['restaurant_street']; ?></small>
										<ul>
											<li>
												Reviews
												<div class="rating">
												<span class="rates">☆</span><span class="rates">☆</span><span>☆</span><span>☆</span><span>☆</span>
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