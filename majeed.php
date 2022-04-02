<?php
$error     = "";
include_once("pdo_connect.php");

$sth = $conn->prepare("SELECT * FROM hotel_db.home_page_sections WHERE section_name = 'Dishes'");
$sth->execute();
$resultsDishes = $sth->fetchAll();

$sql = $conn->prepare("SELECT * FROM hotel_db.home_page_sections WHERE  section_name ='Explore'");
$sql->execute();
$resultsExplore = $sql->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="RotiTime - Discover & Book the best restaurants at the best price">
    <meta name="author" content="Ansonika">
    <title>RotiTime - Discover Indian Foods | the best restaurants at the best price</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

	<!--Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css'>

    <!-- BASE CSS -->
    <link href="css/bootstrap_customized.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="css/home.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>

<body>
				
	<header class="header clearfix element_to_stick">
		<div class="container">
		<div id="logo">
			<a href="index.html">
				<img src="img/logo.png" alt="" class="logo_normal">
				<img src="img/logo1.png" alt="" class="logo_sticky">
			</a>
		</div>


		<a href="#0" class="open_close">
			<i class="icon_menu"></i><span>Menu</span>
		</a>
		<nav class="main-menu">
			<div id="header_menu">
				<a href="#0" class="open_close">
					<i class="icon_close"></i><span>Menu</span>
				</a>
				<a href="index.html"><img src="img/logo1.png" alt=""></a>
			</div>
			<ul>


				<li><a href="#" class="btn_1">Restaurant Owners Login</a></li>
			</ul>
		</nav>
		<ul id="top_menu">
			<li id="language-selector">
				<select class="selectpicker" data-width="fit">
					<option data-content='<span class="flag-icon flag-icon-us"></span>'></option>
				  <option  data-content='<span class="flag-icon flag-icon-de"></span>'></option>
				</select>
			</li>				
			<li class="submenu">
				<a href="#sign-in-dialog" id="sign-in" class=""><i class="fas fa-user"></i></a>
			</li>
		</ul>
		<!-- /top_menu -->		
	</div>
	</header>
	<!-- /header -->
	
	<main>
	
		<div class="hero_single version_2">



			<div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-9 col-lg-10 col-md-8">
							<h1>Discover Indian Foods</h1>
							<p>The best Indian restaurants at the best price</p>
							<form method="post" class="main-search">
								<div class="row no-gutters custom-search-input">
									<div class="col-lg-4">
										<div class="form-group">
											<span>Find:</span>
											<input class="form-control" type="text" placeholder="Restaurant, dish...">
											<i class="icon_search"></i>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<span>Where:</span>
											<input class="form-control no_border_r address" type="text" placeholder="City or attraction..." id ="restaurant_city" name ="restaurant_city">
											 

											<i class="icon_pin_alt"></i>
										</div>
									</div>
									<div class="col-lg-2">
										<input type="submit" value="Search" id="submitbutton"class="btn_1">
									</div>
								</div>
								<!-- /row -->
							</form>
						</div>
					</div>
					<!-- /row -->

                  <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <button rel="nofollow" type="button" class="search_nearby nearby_link"class="btn_1"><i class="fas fa-location-arrow"></i>Use my precise location</button>

                    </div>
					</div>
				</div>
			</div>
		</div>
		<!-- /hero_single -->
		<div class="container menu-items">
			<div class="owl-carousel owl-theme dishes_cat">
				<div class="item_version_2">
					<a href="#">
						VEG							
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						NON-VEG							
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						CHAT						
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						STARTERS						
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						DRINKS						
					</a>
				</div>																
			</div>
		</div>		
		<div class="container margin_30_40">
			<div class="main_title">
				<span><em></em></span>
				<h2>Dishes</h2>
			</div>
			<div class="owl-carousel owl-theme categories_carousel">
			<?php foreach($resultsDishes as $res) { ?>
            <div class="item_version_2">
            <a href="<?php echo $res['section_image_link']; ?>">
            <figure>
           <img src="<?php echo 'http://localhost/practice/'.$res['section_image']; ?>" data-src="<?php echo 'http://localhost/practice/'.$res['section_image']; ?>" alt="<?php echo $res['section_image_alt_text']; ?>" class="owl-lazy" title="<?php echo $res['section_image_title_text']; ?>">
           <div class="info">
           <h3><?php echo $res['section_title']; ?></h3>
           </div>
           </figure>
           </a>
           </div>
          <?php } ?>

			</div>
			<!-- /carousel -->
		</div>
		<!-- /container -->		

		<div class="bg_gray">
			<div class="container margin_60_40">
				<div class="main_title">
					<span><em></em></span>
					<h2>Top Neighborhoods</h2>
				</div>
				<!-- /main_title -->
				<div class="owl-carousel owl-theme categories_carousel">
					<div class="item_version_2">
						<a href="#">
							<figure>
								<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_pizza.jpg" alt="" class="owl-lazy">
								<div class="info">
									<h3>Mitte</h3>
								</div>
							</figure>							
						</a>
					</div>
					<div class="item_version_2">
						<a href="#">
							<figure>
								<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_sushi.jpg" alt="" class="owl-lazy">
								<div class="info">
									<h3>Charlottenburg</h3>
								</div>
							</figure>							
						</a>
					</div>
					<div class="item_version_2">
						<a href="#">
							<figure>
								<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_hamburgher.jpg" alt="" class="owl-lazy">
								<div class="info">
									<h3>Kreuzberg</h3>
								</div>
							</figure>							
						</a>
					</div>
					<div class="item_version_2">
						<a href="#">
							<figure>
								<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_vegetarian.jpg" alt="" class="owl-lazy">
								<div class="info">
									<h3>Mitte</h3>
								</div>
							</figure>							
						</a>
					</div>
					<div class="item_version_2">
						<a href="#">
							<figure>
								<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_bakery.jpg" alt="" class="owl-lazy">
								<div class="info">
									<h3>Charlottenburg</h3>
								</div>
							</figure>							
						</a>
					</div>
					<div class="item_version_2">
						<a href="#">
							<figure>
								<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_chinesse.jpg" alt="" class="owl-lazy">
								<div class="info">
									<h3>Kreuzberg</h3>
								</div>
							</figure>							
						</a>
					</div>
					<div class="item_version_2">
						<a href="#">
							<figure>
								<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_mexican.jpg" alt="" class="owl-lazy">
								<div class="info">
									<h3>Mitte</h3>
								</div>
							</figure>							
						</a>
					</div>
				</div>
				<!-- /carousel -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_gray -->


		
		<div class="container margin_60_40">
			<div class="main_title">
				<span><em></em></span>
				<h2>Explore</h2>
			</div>
			
			<div class="owl-carousel owl-theme categories_carousel">
			<?php foreach($resultsExplore as $resu) { ?>
			<div class="item_version_2">
			<a href="<?php echo $resu['section_image_link']; ?>">
			<figure>
			<img src="<?php echo 'http://localhost/practice/'.$resu['section_image']; ?>" data-src="<?php echo 'http://localhost/practice/'.$resu
			['section_image']; ?>" alt="<?php echo $resu['section_image_alt_text']; ?>" class="owl-lazy" title="<?php echo $resu['section_image_title_text']; ?>">
			<div class="info">
			<h3><?php echo $resu['section_title']; ?></h3>
			</div>
			</figure>
			</a>
			</div>
<?php } ?>

			<div class="owl-carousel owl-theme categories_carousel">
				<div class="item_version_2">
					<a href="#">
						<figure>
							<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_pizza.jpg" alt="" class="owl-lazy">
							<div class="info">
								<h3>Veg</h3>
							</div>
						</figure>							
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						<figure>
							<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_sushi.jpg" alt="" class="owl-lazy">
							<div class="info">
								<h3>North Indian</h3>
							</div>
						</figure>							
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						<figure>
							<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_hamburgher.jpg" alt="" class="owl-lazy">
							<div class="info">
								<h3>South Indian</h3>
							</div>
						</figure>							
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						<figure>
							<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_vegetarian.jpg" alt="" class="owl-lazy">
							<div class="info">
								<h3>Chat</h3>
							</div>
						</figure>							
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						<figure>
							<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_bakery.jpg" alt="" class="owl-lazy">
							<div class="info">
								<h3>Veg</h3>
							</div>
						</figure>							
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						<figure>
							<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_chinesse.jpg" alt="" class="owl-lazy">
							<div class="info">
								<h3>North Indian</h3>
							</div>
						</figure>							
					</a>
				</div>
				<div class="item_version_2">
					<a href="#">
						<figure>
							<img src="img/home_cat_placeholder.jpg" data-src="img/home_cat_mexican.jpg" alt="" class="owl-lazy">
							<div class="info">
								<h3>South Indian</h3>
							</div>
						</figure>							
					</a>
				</div>
			</div>
			<!-- /carousel -->


		</div>
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
								<li>
									<a href="#">
										<figure>
											<img src="img/location_list_placeholder.png" data-src="img/location_list_1.jpg" alt="" class="lazy">
										</figure>
										<div class="score"><strong>9.5</strong></div>
										<em>Italian</em>
										<h3>La Monnalisa</h3>
										<small>8 Patriot Square E2 9NF</small>
										<ul>
											<li>Average price $35</li>
										</ul>
									</a>
								</li>
								<li>
									<a href="#">
										<figure>
											<img src="img/location_list_placeholder.png" data-src="img/location_list_2.jpg" alt="" class="lazy">
										</figure>
										<div class="score"><strong>8.0</strong></div>
										<em>Mexican</em>
										<h3>Alliance</h3>
										<small>27 Old Gloucester St, 4563</small>
										<ul>
											<li>Average price $30</li>
										</ul>
									</a>
								</li>
								<li>
									<a href="#">
										<figure>
											<img src="img/location_list_placeholder.png" data-src="img/location_list_3.jpg" alt="" class="lazy">
										</figure>
										<div class="score"><strong>9.0</strong></div>
										<em>Sushi - Indian</em>
										<h3>Sushi Gold</h3>
										<small>Old Shire Ln EN9 3RX</small>
										<ul>
											<li>Average price $20</li>
										</ul>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<div class="list_home">
							<ul>
								<li>
									<a href="#">
										<figure>
											<img src="img/location_list_placeholder.png" data-src="img/location_list_4.jpg" alt="" class="lazy">
										</figure>
										<div class="score"><strong>9.5</strong></div>
										<em>Vegetarian</em>
										<h3>Mr. Pepper</h3>
										<small>27 Old Gloucester St, 4563</small>
										<ul>
											<li>Average price $20</li>
										</ul>
									</a>
								</li>
								<li>
									<a href="#">
										<figure>
											<img src="img/location_list_placeholder.png" data-src="img/location_list_5.jpg" alt="" class="lazy">
										</figure>
										<div class="score"><strong>8.0</strong></div>
										<em>Indian</em>
										<h3>Dragon Tower</h3>
										<small>22 Hertsmere Rd E14 4ED</small>
										<ul>
											<li>Average price $35</li>
										</ul>
									</a>
								</li>
								<li>
									<a href="#">
										<figure>
											<img src="img/location_list_placeholder.png" data-src="img/location_list_6.jpg" alt="" class="lazy">
										</figure>
										<div class="score"><strong>8.5</strong></div>
										<em>Pizza - Italian</em>
										<h3>Bella Napoli</h3>
										<small>135 Newtownards Road BT4</small>
										<ul>
											<li>Average price $25</li>
										</ul>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="links add_bottom_25">
					<h4>The Restaurants we trust</h4>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Bakeries near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Bars near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Beverage Shops near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Bhojanalya near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Cafés near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Casual Dining near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Clubs near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Cocktail Bars near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Confectioneries near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Dessert Parlors near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Dhabas near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Fine Dining near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Food Courts near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Food Trucks near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Irani Cafes near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Kiosks near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Lounges near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Meat Shops near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp"> near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Microbreweries near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Paan Shop near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Pubs near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Quick Bites near me</a>
					<span class="sc-faswKr fERJtH"></span>
					<a href="#" target="_blank" class="sc-cVxdjG ksIlxp">Sweet Shops near me</a>
				</div>									
			</div>
		</div>

			
		</div>				
			</div>
		</div>		
		<div class="call_section lazy" data-bg="url(img/bg_call_section.jpg)">
		    <div class="container clearfix">
		        <div class="col-lg-5 col-md-6 float-right wow">
		            <div class="box_1">
		                <h3>Are you a Restaurant Owner?</h3>
		                <p>Join Us to increase your online visibility. You'll have access to even more customers who are looking to enjoy your tasty dishes at home.</p>
		                <a href="#" class="btn_1">Read more</a>
		            </div>
		        </div>
    		</div>
    	</div>
   		<!--/call_section-->
		
	</main>
	<!-- /main -->

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_1">Company</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_1">
						<ul>
							<li><a href="#">About us</a></li>
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">Terms and Conditions</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Impressum</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_2">Our Top Locations</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_2">
						<ul>
							<li><a href="#">Berlin</a></li>
							<li><a href="#">Dubai</a></li>
							<li><a href="#">London</a></li>
							<li><a href="#">New York</a></li>
							<li><a href="#">All Cities</a></li>							
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_3">Contacts</h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						<ul>
							<li><i class="icon_house_alt"></i>97845 Baker st. 567<br>Los Angeles - US</li>
							<li><i class="icon_mobile"></i>+94 123-23-221</li>
							<li><i class="icon_mail_alt"></i><a href="#0">info@domain.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_4">Follow Us</h3>
					<div class="collapse dont-collapse-sm" id="collapse_4">

						<div class="follow_us">
							<ul>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/twitter_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/facebook_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/instagram_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="img/youtube_icon.svg" alt="" class="lazy"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /row-->
			<hr>
			<div class="row">

				<div class="col-lg-12">
					<p class="text-center copyrights">© 2020 RotiTime</p>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->

	<div id="toTop"></div><!-- Back to top button -->
	
	<div class="layer"></div><!-- Opacity Mask Menu Mobile -->
	
	<!-- Sign In Modal -->
	<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Sign In</h3>
		</div>
		<form>
			<div class="sign-in-wrapper">
				<a href="#0" class="social_bt facebook">Login with Facebook</a>
				<a href="#0" class="social_bt google">Login with Google</a>
			</div>
		</form>
		<!--form -->
	</div>
	<!-- /Sign In Modal -->
	
	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.min.js"></script>
	<script src="js/common_func.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
	<script>
		$(function(){
		$('.selectpicker').selectpicker();
	});
	
	</script>
	
	<script>
	$("#submitbutton").click(function(){
				var restaurant_city         =$("#restaurant_city").val();


		
		posturl = "http://localhost/practice/restaurantname_remote.php";
		

	$.post(
	
	  posturl, {
		 restaurant_city:restaurant_city,
		
	},	
	 function (ResponseData) {
alert(ResponseData);
if($.trim(ResponseData) === 'sucess') {

alert(ResponseData);
location.reload();
	 }
	 });
	 
	});
		
	</script>
	
	<script>
	  $(document).ready(function(){
	  $("button").click(function(){
     
		  posturl = "http://localhost/rotitime/ipadress1.php";
		

	$.post(
	  posturl, {		
	  		
	},	
	function (ResponseData){
		alert(ResponseData);
		if($.trim(ResponseData) === 'sucess') {
			location.reload();
} 

	
	}
	
	); 
	
		  
	  });
	  });
	  </script>


</body>
</html>