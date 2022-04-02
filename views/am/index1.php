<?php
use app\models\RtCommonMethod;
use app\models\RiCommonMethods;
/* @var $this yii\web\View */

$this->title = 'Roti Time';
$this->registerJsFile('js/jquery-3.4.1.min.js');

$RtCommonMethod = new RtCommonMethod();
?>
<main>
	
		
    <div class="call_section lazy" data-bg="url(<?='http://zefasa.com/rotitime/web/'.$ ['banner_image_path']?>)">
		  
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>Discover Indian Foods</h1>
							<p>The best Indian restaurants at the best price</p>
							<form method="post" class="main-search">
								<div class="row no-gutters custom-search-input">
									<div class="col-lg-10">
										<div class="form-group">
											<span>Where:</span>
											<input class="form-control no_border_r address" type="text" placeholder="City or attraction...">
											<i class="icon_pin_alt"></i>
										</div>
									</div>
									<div class="col-lg-2">
										<input type="submit" value="Search">
									</div>
								</div>
								<!-- /row -->
							</form>
						</div>
					</div>          
					<!-- /row -->

					<div class="row justify-content-center">
						<div class="col-lg-12">
							<a rel="nofollow" id="precise_location" href="javascript:void(0);" role="button" class="search_nearby nearby_link"><i class="fas fa-location-arrow"></i>Use my precise location</a> 
						</div>
					</div>
				</div>
	</div>
			<!-- /call_section -->
			<div class="container menu-items">
				<div class="owl-carousel owl-theme dishes_cat">
						<?php foreach($dataFromHomeGreyPageSection as $res) { ?>
					<div class="item_version_2">
					    <a href="<?php echo $res['grey_button_type']; ?>"><?php echo $res['grey_button_title']; ?>						
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
					<h2><?php echo $res['section_name']; ?></h2>
				</div>

				<div class="owl-carousel owl-theme categories_carousel">
						<?php foreach($homeSectionImagesWithSectionIdRes as $res) { ?>
						 <div class="item_version_2">
						   <a href="#">
							<figure>
							<img src="<?php echo 'http://zefasa.com/rotitime/web/'.$res['section_image']; ?>" data-src =<?php echo 'http://zefasa.com/rotitime/web/'.$res['section_image']; ?>  class="owl-lazy" >
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
					<div class="col-md-6">
						<div class="list_home">
							<ul>
							<?php 
							foreach($dataFromPopularRestaurants1 as $res) { 	
								?>
								<li>
									<a href="#">
										<figure>
											<img src="<?php echo 'http://zefasa.com/rotitime/web/'.$res['restaurant_logo_image']; ?>" data-src="<?php echo 'http://zefasa.com/rotitime/web/'.$res['restaurant_logo_image']; ?>" alt="" class="lazy">
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
					<div class="col-md-6">
						<div class="list_home">
							<ul>
								<?php 
								foreach($dataFromPopularRestaurants2 as $res) { 	
								?>
								<li>
									<a href="#">
										<figure>
											<img src="<?php echo 'http://zefasa.com/rotitime/web/'.$res['restaurant_logo_image']; ?>" data-src="<?php echo 'http://zefasa.com/rotitime/web/'.$res['restaurant_logo_image']; ?>" alt="" class="lazy">
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
						<a href="#" target="_blank" class="sc-cVxdjG ksIlxp"><?php echo $res['we_trust_title']; ?></a>
						<span class="sc-faswKr fERJtH"></span>
						<?php } ?>
						
						
					</div>										
			</div>
		</div>

			
		</div>				
			</div>
		</div>		
		<div class="call_section lazy" data-bg="url(<?='http://zefasa.com/rotitime/web/'.$areYouResturantOwnerResult['are_u_owner_section_image_path']?>)">
		    <div class="container clearfix">
		        <div class="col-lg-5 col-md-6 float-right wow">
		            <div class="box_1">
		                <h3><?=$areYouResturantOwnerResult['are_u_owner_section_title']?></h3>
		                <p><?=$areYouResturantOwnerResult['are_u_owner_section_text']?></p>
		                <a href="#" class="btn_1">Read more</a>
		            </div>
		        </div>
    		</div>
    	</div>
   		<!--/call_section-->
		
	</main>
<?php
$validation_js = "js/restaurant_homepage.js?" . rand(1, 1000);
$this->registerJsFile($validation_js);
?>