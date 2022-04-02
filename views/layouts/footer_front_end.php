<?php
use app\models\BsCommonMethods;
$BsCommonMethods = new BsCommonMethods();
$cmsPages = $BsCommonMethods ->getCmsPages();
?>
<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_1">Company</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_1">
						<ul>
							<?php foreach($cmsPages as $res) { ?>
							<li><a href="<?=SITE_URL.strtolower(str_replace(" ","-",$res['page_name']));?>"><?=$res['page_name']?></a></li>
						    <?php } ?>
							<li><a href="<?=SITE_URL?>site/contact-us">Contact Us</a></li>
							<!--<li><a href="#">Terms and Conditions</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">FAQs</a></li>
							<li><a href="#">Impressum</a></li> -->
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
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE_URL;?>img/twitter_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE_URL;?>img/facebook_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE_URL;?>img/instagram_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE_URL;?>img/youtube_icon.svg" alt="" class="lazy"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /row-->
			<hr>
			<div class="row">

				<div class="col-lg-12">
					<p class="text-center copyrights">� 2020 RotiTime</p>
				</div>
			</div>
		</div>
	</footer>