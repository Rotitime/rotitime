<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = '';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

?>
	
		

		  
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
											<input class="form-control no_border_r address" id= "dish_name" name="dish_name" type="text" placeholder="City or attraction...">
											<i class="icon_pin_alt"></i>
										</div>
									</div>
									<div class="col-lg-2">
				 <button type="button" class="btn btn-default btn_1 medium" id ="find_dish">Submit</button>
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
	
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>