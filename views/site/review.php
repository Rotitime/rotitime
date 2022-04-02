<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Review';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');


?>	
	
	
	<!-- Review Modal -->
		<div class="modal_header">
			<h3>Write a Review</h3>
		</div>
		<form  method="post">
			<div class="box_general write_review">

				<label class="d-block add_bottom_15">Tap to rate your experience</label>
				<div class="reviews-stars">
					<a href="" class="icons"><i class="icon_star"></i></a>
					<a href="" class="icons"><i class="icon_star"></i></a>
					<a href="" class="icons"><i class="icon_star"></i></a>
					<a href="" class="icons"><i class="icon_star"></i></a>
					<a href="" class="icons"><i class="icon_star"></i></a>
				</div>
				
				<div class="form-group">
					<label>What was not upto the mark?</label>
					<input class="form-control" type="text" id="what_was_not_upto_the_mark" name="what_was_not_upto_the_mark" placeholder="If you could say it in one sentence, what would you say?">
				</div>
				<div class="form-group">
					<label>Your review</label>
					<textarea id="your_review" maxlength="300" name="your_review" class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
					<span class="text-muted text-sm">Characters remaining:  <span id="hNotesChars">300</span></span>
				</div>
				<a href="" id="reviewsubmit"  class="btn_1">Submit review</a>
			</div>
		</form>
		<!--form -->
		<!--form -->
		
<?php
		$restaurant_details = $relativeHomeUrl."js/restaurant_details.js?" . rand(1, 1000);
		$this->registerJsFile($restaurant_details);
?>