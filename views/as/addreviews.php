<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Review';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

?>


		<div class="content-wrapper">
		<div class="container-fluid">
		  <!-- Breadcrumbs-->
		  <ol class="breadcrumb">
			<li class="breadcrumb-item">
			  <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Add Review</li>
		  </ol>

		  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Add Review</h2>
			</div>


	<form method="POST" enctype="multipart/form-data" id="addReviewForm" name="addreviewform">

        <div class="col-md-6">
		<div class="form-group">
		<?php
		if(!empty($error)) { ?>
		<div class="alert alert-danger" role="alert">

		<?=$error;?>
		</div>
		<?php
		}
		?>
		</div>
		</div>
		


	<div id="review-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Write a Review</h3>
		</div>
		<form>
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
					<input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
				</div>
				<div class="form-group">
					<label>Your review</label>
					<textarea class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
				</div>
				<a href="confirm.html" class="btn_1">Submit review</a>
			</div>
		</form>
		<!--form -->
	</div>





   <button type="button" class="btn btn-default btn_1 medium" id = "reviewsubmit">submit</button>
   <a href="<?php echo Yii::$app->homeUrl.'/'.$controllerName.'/add-restaurant-owner'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

    </form>
	</div>
	</div>
	</div>


	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>