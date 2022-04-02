<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Review';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');


?>	
	
	
	
		<div class="modal_header">
			<h3>Write a Review</h3>
		</div>
		<form method="post" id="reviewForm" name="reviewform">
			<div class="box_general write_review">

				<label class="d-block add_bottom_15">Tap to rate your experience</label>
				<div class="reviews-stars" id="tap_to_rate_your_experience" name="tap_to_rate_your_experience" >
					<a href="" class="icons"><i class="icon_star" value="1"></i></a>
					<a href="" class="icons"><i class="icon_star" value="2"></i></a>
					<a href="" class="icons"><i class="icon_star" value="3"></i></a>
					<a href="" class="icons"><i class="icon_star" value="4"></i></a>
					<a href="" class="icons"><i class="icon_star" value="5"></i></a>
				</div>
				
				<div class="form-group">
					<label>What was not upto the mark?</label>
					<input class="form-control" type="text" id="what_was_not_upto_the_mark" name="what_was_not_upto_the_mark" placeholder="If you could say it in one sentence, what would you say?">
				</div>
				<div class="form-group">
					<label>Your review</label>
					<textarea class="form-control"  id="your_review" name="your_review" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
				</div>
				<a id = "reviewsubmit" href="" class="btn_1">Submit review</a>


			</div>
		</form>
		<!--form -->
<?php
		$restaurant_details = $relativeHomeUrl."js/restaurant_details.js?" . rand(1, 1000);
		$this->registerJsFile($restaurant_details);
	?>	