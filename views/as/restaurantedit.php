
<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Restaurant';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

if(!empty($error)) {
	echo $error;
}
?>

	<div class="content-wrapper">
		<div class="container-fluid">
		  <!-- Breadcrumbs-->
		  <ol class="breadcrumb">
			<li class="breadcrumb-item">
			  <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">Edit Restaurant</li>
		  </ol>

		  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Edit Restaurant</h2>
			</div>
	  
	  
	<form method="POST" method="post" enctype="multipart/form-data">
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_name">Restaurant Name:</label>
		<input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="<?php echo $restaurant_name;?>">
		  <div class="invalid-feedback" id="restaurant_name_validation">
			Please enter Restaurant Name
		  </div>
	  </div>
		</div>

	  
	   
		 <div class="col-md-6">
		<div class="form-group">
	   <label for="restaurant_image">Restaurant Image:</label><br>
	  <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $restaurant_image;?>">
		<input type="hidden" name="restaurant_image_hidden" id="restaurant_image_hidden" value="<?php echo $restaurant_image;?>">
	   <input type="hidden" name="page_type" id="page_type" value="edit">
	   <figure>
	 <img src="<?php echo 'http://zefasa.com/rotitime/web/'.$restaurant_image; ?>" data-src ="<?php echo 'http://zefasa.com/rotitime/web/'.$restaurant_image; ?>">
	 </figure>
		  <div class="invalid-feedback" id="restaurant_image_validation">
			Please enter Restaurant Image
		  </div>
	  </div>
		</div>


	 <div class="col-md-6">
		<div class="form-group">
	   <label for="restaurant_logo_image">Restaurant Logo Image:</label><br>
	  <input type="file" name="fileToUploa" id="fileToUploa" value="<?php echo $restaurant_logo_image;?>">
		<input type="hidden" name="restaurant_image_hidden" id="restaurant_image_hidden" value="<?php echo $restaurant_logo_image;?>">
		<input type="hidden" name="logo_image" id="logo_image" value="edit">
	 <figure>
	 <img src="<?php echo 'http://zefasa.com/rotitime/web/'.$restaurant_logo_image; ?>" data-src ="<?php echo 'http://zefasa.com/rotitime/web/'.$restaurant_logo_image; ?>">
	 </figure>
		  <div class="invalid-feedback" id="restaurant_logo_image_validation">
			Please enter Restaurant Logo Image
		  </div>
	  </div>
		</div>
	 
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_alt_text_english">Restaurant Alt Text English:</label>
		<input type="text" class="form-control" id="restaurant_alt_text_english" name="restaurant_alt_text_english" value="<?php echo $restaurant_alt_text_english;?>">
	  </div>
		</div>

	 <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_alt_text_german">Restaurant Alt Text German:</label>
		<input type="text" class="form-control" id="restaurant_alt_text_german" name="restaurant_alt_text_german" value="<?php echo $restaurant_alt_text_german;?>">
	  </div>
		</div>
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_title_text_english">Restaurant Title Text English:</label>
		<input type="text" class="form-control" id="restaurant_title_text_english" name="restaurant_title_text_english" value="<?php echo $restaurant_title_text_english;?>">
	  </div>
		</div>

	 <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_title_text_german">Restaurant Title Text German:</label>
		<input type="text" class="form-control" id="restaurant_title_text_german" name="restaurant_title_text_german" value="<?php echo $restaurant_title_text_german;?>">
	  </div>
		</div>
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_city">Restaurant City:</label>
		<input type="text" class="form-control" id="restaurant_city" name="restaurant_city" value="<?php echo $restaurant_city;?>">
		  <div class="invalid-feedback" id="restaurant_city_validation">
			Please enter Restaurant City
		  </div>
	  </div>
		</div>

	 
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_type_english">Restaurant Type English:</label>
		<input type="text" class="form-control" id="restaurant_type_english" name="restaurant_type_english" value="<?php echo $restaurant_type_english;?>">
		  <div class="invalid-feedback" id="restaurant_type_english_validation">
			Please enter Restaurant Type English
		  </div>
	  </div>
		</div>

	 
	  <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_type_german">Restaurant Type German:</label>
		<input type="text" class="form-control" id="restaurant_type_german" name="restaurant_type_german" value="<?php echo $restaurant_type_german;?>">
	  </div>
		</div>

	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_discount">Restaurant Discount:</label>
		<input type="tel_no" class="form-control" id="restaurant_discount" name="restaurant_discount" value="<?php echo $restaurant_discount;?>">
		  <div class="invalid-feedback" id="restaurant_discount_validation">
			Please enter Restaurant Discount
		  </div>
	  </div>
		</div>

	 
	 
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="is_restaurant_premium ">Is Restaurant Premium:</label><br>
		<input type="radio" id="is_restaurant_premium" name="is_restaurant_premium" value="Y" <?php if($is_restaurant_premium == 'Y') { ?> checked = "checked" <?php } ?> >
		<label for="Y">Yes</label><br>
		
		<input type="radio" id="is_restaurant_premium" name="is_restaurant_premium" value="N" <?php if($is_restaurant_premium == 'N') { ?> checked = "checked" <?php } ?>>
		<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_restaurant_premium_validation">
			Please enter Is Restaurant Premium
		  </div>
	  </div>
		</div>

	 
	 
		<div class="col-md-6">
	  <div class="form-group">
		<label for="is_restaurant_active  ">Is Restaurant Active:</label><br>
		<input type="radio" id="is_restaurant_active" name="is_restaurant_active" value="Y" <?php if($is_restaurant_active == 'Y') { ?> checked = "checked" <?php } ?>>
		<label for="Y">Yes</label><br>
		
		<input type="radio" id="is_restaurant_active" name="is_restaurant_active" value="N" <?php if($is_restaurant_active == 'N') { ?> checked = "checked" <?php } ?>>
		<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_restaurant_active_validation">
			Please enter Is Restaurant Active
		  </div>
	  </div>
		</div>

	 
	 
		<div class="col-md-6">
	 <div class="form-group">
		<label for="is_delivery_availabe">Is Delivery Avaliable:</label><br>
		<input type="radio" id="is_delivery_availabe" name="is_delivery_availabe" value="Y" <?php if($is_delivery_availabe == 'Y') { ?> checked = "checked" <?php } ?>>
		<label for="Y">Yes</label><br>
		
		<input type="radio" id="is_delivery_availabe" name="is_delivery_availabe" value="N" <?php if($is_delivery_availabe == 'N') { ?> checked = "checked" <?php } ?>>
		<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_delivery_availabe_validation">
			Please enter Is Delivery Avaliable
		  </div>
	  </div>
		</div>

	 
	  
	   
		 <button type="submit" class="btn btn-default btn_1 medium" id ="submitbutton">Submit</button>
		<a href="<?php echo Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurants'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 medium">Cancel</a>

	</form>

</div>
</div>
</div>

 	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>