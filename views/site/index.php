<?php
use yii\web\Session;
use app\models\RtCommonMethod;
use app\models\RiCommonMethods;
use app\models\RtSr;
use yii\helpers\Url;

$session = Yii::$app->session;

if ($session->has('formatted_address')) {
	$formatted_address = $session->get('formatted_address');
}
/* @var $this yii\web\View */
$relativeHomeUrl = Url::home();
$this->title = 'Roti Time';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$baseUrl =  Url::base('https');
$RtCommonMethod = new RtCommonMethod();
$RtSr = new RtSr();

$userLocationFromCookies = $RtSr->fnUserLocationFromCokiee();
?>
<!-- Modal -->
<main>

	<div class="hero_single version_2 call_section lazy"  data-opacity-mask="rgba(0, 0, 0, 0.6)" data-bg="url(<?=$relativeHomeUrl.$dataFromBannerImageResult['banner_image_path']?>)">
    <div class="opacity-mask">

				<div class="container">
					<div class="row justify-content-center" id="justify_content_div"> 
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>Discover Indian Foods</h1>
							<p>The best Indian restaurants at the best price</p>
							<form class="main-search">
								<div class="row no-gutters custom-search-input">
									<div class="col-lg-10">
										<div class="form-group">
											<span>Where:</span>
											<input class="form-control no_border_r address autocomplete" id="autocomplete" onFocus="geolocate()" type="text" placeholder="City or attraction..." value="<?=$userLocationFromCookies;?>">
											<i class="icon_pin_alt"></i>
										</div>
									</div>
									<div class="col-lg-2">
										<input type="submit" value="Search" id="searchSubmit" class="searchSubmit">
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
                        <div class="alert alert-danger" role="alert" id="address_alert" style="display: none" >
                        Please enter your address to see <span id="clicked_text"></span>
                        </div>
					</div>
				</div>
	</div></div>
			<!-- /call_section -->
			<div class="container menu-items">
				<div class="owl-carousel owl-theme dishes_cat">
						<?php foreach($dataFromHomeGreyPageSection as $res) { ?>
					<div class="item_version_2">
					    <a onclick="return checkAddressExists('<?= $res['grey_button_type']; ?>','<?= $res['grey_button_title']; ?>')" href="<?= $baseUrl ?>/site/restaurant-search-results?st=<?= $res['grey_button_type']; ?>&sk=<?= $res['grey_button_title']; ?>"><?php echo $res['grey_button_title']; ?>
						</a>
					</div>
						<?php } ?>


				</div>
			</div>

			<?php
			$i=1;

			foreach($dataFromViewHomePagesSections as $res) {

			$homeSectionImagesWithSectionIdRes = $RtCommonMethod ->fetchHomeSectionImagesWithSectionId($res['section_id']);

			if($i%2 == 0) { ?>
			<div class="bg_gray">
			<?php
			}
			?>
			<div class="container margin_60_40">
				<div class="main_title">
					<span><em></em></span>
					<h2>
						<?php
							$section_name = $res['section_name'];
							echo $section_name; ?>
					</h2>
				</div>

				<div class="owl-carousel owl-theme categories_carousel">
						<?php foreach($homeSectionImagesWithSectionIdRes as $res) { 
                            $linkToSearchResult = $baseUrl."/site/restaurant-search-results?st=".$res['section_category']."&sk=".$res['section_image_text'];
                        if($res['section_category'] == 'restaurant') {
                            $linkToSearchResult = "http://zefasa.com/rotitime/".$res['section_image_text'];
                        }   
                        ?>
						 <div class="item_version_2">
						   <a onclick="return checkAddressExists('<?= $res['section_category']; ?>','<?= $res['section_image_text']; ?>')"  href="<?= $linkToSearchResult; ?>">
							<figure>
							<img src="<?php echo 'https://zefasa.com/rotitime/'.$res['section_image']; ?>" data-src =<?= $relativeHomeUrl.$res['section_image'];  ?>  class="owl-lazy" onclick="return checkAddressExists()">
							 <div class="info">
						<h3><?php echo $res['section_image_text']; ?></h3>
							</div>
						   </figure>
						   </a>
						</div>
						<?php } ?>

				</div>
				<!-- /carousel -->
			</div>
			<?php
			if($i == 2) { ?>
			</div>
			<?php
			}
			$i++;
			} ?>

		<!-- /container -->

		<div class="bg_gray near-me">
			<div class="container margin_60_40">
				<div class="main_title center">
					<span><em></em></span>
					<h2>Explore other options for you here</h2>
				</div>
				<div>
				<div class="row">
					<div class="col-12">
						<div class="main_title version_2">
							<h2>Popular Restaurants</h2>
						</div>
					</div>
					<div class="col-md-12">
						<div class="list_home">
							<ul>
							<?php
							foreach($dataFromPopularRestaurants1 as $res) {
								?>
								<li>
									<a onclick="return checkAddressExists('restaurant','<?= $res['restaurant_name']; ?>')"  href="<?=$baseUrl.'/'.$res['restaurant_name']; ?>">
										<figure>
											<img src="<?= $relativeHomeUrl.$res['restaurant_logo_image']; ?>" data-src="<?= $relativeHomeUrl.$res['restaurant_logo_image']; ?>" alt="" class="lazy">
										</figure>
										<div class="score"><strong>9.5</strong></div>
										<em><?=$res['restaurant_type_english']; ?></em>
										<h3><?=$res['restaurant_name']; ?></h3>
										<small><?=$res['restaurant_street']; ?></small>
										<ul>
											<li>Average price $<?=$res['restaurant_rating']; ?></li>
										</ul>
									</a>
								</li>
							<?php } ?>

							<?php
							foreach($dataFromPopularRestaurants2 as $res) {
							?>
							<li>
								<a onclick="return checkAddressExists('restaurant','<?= $res['restaurant_name']; ?>')"  href="<?=$baseUrl.'/'.$res['restaurant_name']; ?>">
									<figure>
										<img src="<?= $relativeHomeUrl.$res['restaurant_logo_image']; ?>" data-src="<?= $relativeHomeUrl.$res['restaurant_logo_image']; ?>" alt="" class="lazy">
									</figure>
									<div class="score"><strong>9.5</strong></div>
									<em><?=$res['restaurant_type_english']; ?></em>
									<h3><?=$res['restaurant_name']; ?></h3>
									<small><?=$res['restaurant_street']; ?></small>
									<ul>
										<li>Average price $<?=$res['restaurant_rating']; ?></li>
									</ul>
								</a>
							</li>
						<?php } ?>
							</ul>
						</div>
					</div>
				</div>
					<div class="links add_bottom_25">
					<h4>The Restaurants we trust</h4>
						<?php foreach($dataFromRestaurantWeTrust as $res) { ?>
						<a onclick="return checkAddressExists('restaurant','<?= $res['we_trust_title']; ?>')" href="<?=$baseUrl.'/'.$res['we_trust_title']; ?>" class="sc-cVxdjG ksIlxp"><?php echo $res['we_trust_title']; ?></a>
						<span class="sc-faswKr fERJtH"></span>
						<?php } ?>


					</div>
			    </div>
		    </div>


	</div>
			</div>
		</div>
		<div class="call_section lazy" data-bg="url(<?=$relativeHomeUrl.$areYouResturantOwnerResult['are_u_owner_section_image_path']?>)">
		    <div class="container clearfix">
		        <div class="col-lg-5 col-md-6 float-right wow">
		            <div class="box_1">
		                <h3><?=$areYouResturantOwnerResult['are_u_owner_section_title']?></h3>
		                <p><?=$areYouResturantOwnerResult['are_u_owner_section_text']?></p>
						<span id="jsResult"></span>
		                <a href="#" class="btn_1">Read more</a>
						<p id="demo"></p>
		            </div>
		        </div>
    		</div>
    	</div>
   		<!--/call_section-->
		</div>

       <input type="hidden" id="clicked_type" name="clicked_type" />
       <input type="hidden" id="clicked_title" name="clicked_title" />

		<div id="location-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Enter delivery address</h3>
			<p>We do not have your address. Please enter here.</p>
		</div>

		<!--form -->
	</div>
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />


    <!-- Modal Closed -->

</main>
<?php
$validation_js = $relativeHomeUrl."js/restaurant_homepage.js?" . rand(1, 1000);
$this->registerJsFile($validation_js);
?> 