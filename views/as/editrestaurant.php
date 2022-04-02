<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Restaurant';
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
			<li class="breadcrumb-item active">Edit Restaurant</li>
		  </ol>

		  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Edit Restaurant</h2>
			</div>
	  
	  
	<form  method="post" enctype="multipart/form-data" id="restaurantEdit" name="restaurantedit">
	 
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
		
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_name">Restaurant Name:</label>
		<input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="<?= $restaurant_name;?>">
		<input type="hidden" name="restaurant_name_hidden" id="restaurant_name_hidden" value="<?= $restaurant_name;?>">
		  <div class="invalid-feedback" id="restaurant_name_validation">
			Please enter Restaurant Name
		  </div>
		  <div class="invalid-feedback" id="same_name_validation">
			Restaurant Name Already Exist
		  </div>
	  </div>
		</div>

	  
	   
		 <div class="col-md-6">
		<div class="form-group">
	   <label for="restaurant_image">Restaurant Image:</label><br>
	  <input type="file" name="restaurant_image" id="restaurant_image" value="<?= $restaurant_image;?>">
		<input type="hidden" name="restaurant_image_hidden" id="restaurant_image_hidden" value="<?= $restaurant_image;?>">
	   <input type="hidden" name="image_type" id="image_type" value="edit">
	   <figure class="upload-img">
	 <img src="<?= 'http://zefasa.com/rotitime/web/'.$restaurant_image; ?>" data-src ="<?= 'http://zefasa.com/rotitime/web/'.$restaurant_image; ?>">
	 </figure>
	 <div>
			Image size: 800*450
		   </div>
		  <div class="invalid-feedback" id="restaurants_image_validation">
			Please enter Restaurant Image
		  </div>
		  <div class="invalid-feedback" id="image_extension_validation">
			Please upload file with extension .jpeg/.jpg/.png only
		  </div>
	  </div>
		</div>


	 <div class="col-md-6">
		<div class="form-group">
	   <label for="restaurant_logo_image">Restaurant Logo Image:</label><br>
	  <input type="file" name="restaurant_logo_image" id="restaurant_logo_image" value="<?= $restaurant_logo_image;?>">
		<input type="hidden" name="restaurants_image_hidden" id="restaurants_image_hidden" value="<?= $restaurant_logo_image;?>">
		<input type="hidden" name="logo_image" id="logo_image" value="edit_1">
	 <figure class="upload-img">
	 <img src="<?= 'http://zefasa.com/rotitime/web/'.$restaurant_logo_image; ?>" data-src ="<?='http://zefasa.com/rotitime/web/'.$restaurant_logo_image; ?>">
	 </figure>
	 <div>
			Image size: 350*233
		   </div>
		  <div class="invalid-feedback" id="restaurants_logo_image_validation">
			Please enter Restaurant Logo Image
		  </div>
		  <div class="invalid-feedback" id="logo_image_extension_validation">
			Please upload file with extension .jpeg/.jpg/.png only
		  </div>
	  </div>
		</div>
	 
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_alt_text_english">Restaurant Alt Text English:</label>
		<input type="text" class="form-control" id="restaurant_alt_text_english" name="restaurant_alt_text_english" value="<?= $restaurant_alt_text_english;?>">
	  </div>
		</div>

	 <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_alt_text_german">Restaurant Alt Text German:</label>
		<input type="text" class="form-control" id="restaurant_alt_text_german" name="restaurant_alt_text_german" value="<?= $restaurant_alt_text_german;?>">
	  </div>
		</div>
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_title_text_english">Restaurant Title Text English:</label>
		<input type="text" class="form-control" id="restaurant_title_text_english" name="restaurant_title_text_english" value="<?= $restaurant_title_text_english;?>">
	  </div>
		</div>

	 <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_title_text_german">Restaurant Title Text German:</label>
		<input type="text" class="form-control" id="restaurant_title_text_german" name="restaurant_title_text_german" value="<?= $restaurant_title_text_german;?>">
	  </div>
		</div>
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_city">Restaurant City:</label>
		<input type="text" class="form-control" id="restaurant_city" name="restaurant_city" value="<?= $restaurant_city;?>">
		  <div class="invalid-feedback" id="restaurants_city_validation">
			Please enter Restaurant City
		  </div>
	  </div>
		</div>

	 
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_type_english">Restaurant Type English:</label>
		<input type="text" class="form-control" id="restaurant_type_english" name="restaurant_type_english" value="<?= $restaurant_type_english;?>">
		  <div class="invalid-feedback" id="restaurants_type_english_validation">
			Please enter Restaurant Type English
		  </div>
	  </div>
		</div>

	 
	  <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_type_german">Restaurant Type German:</label>
		<input type="text" class="form-control" id="restaurant_type_german" name="restaurant_type_german" value="<?= $restaurant_type_german;?>">
	  </div>
		</div>

	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="restaurant_discount">Restaurant Discount:</label>
		<input type="tel_no" class="form-control" id="restaurant_discount" name="restaurant_discount" value="<?= $restaurant_discount;?>">
	  </div>
		</div>

	 
	 
	 
	   <div class="col-md-6">
	  <div class="form-group">
		<label for="is_restaurant_premium ">Is Restaurant Premium:</label><br>
		<input type="radio" id="is_restaurant_premium" name="is_restaurant_premium" value="Y" <?php if($is_restaurant_premium == 'Y') { ?> checked = "checked" <?php } ?>>
		<label for="Y">Yes</label><br>
		
		<input type="radio" id="is_restaurant_premium" name="is_restaurant_premium" value="N" <?php if($is_restaurant_premium == 'N') { ?> checked = "checked" <?php } ?>>
		<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_restaurants_premium_validation">
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
		  <div class="invalid-feedback" id="is_restaurants_active_validation">
			Please enter Is Restaurant Active
		  </div>
	  </div>
		</div>

	 
	 
		<div class="col-md-6">
	 <div class="form-group">
		<label for="is_delivery_availabe">Is Delivery Avaliable:</label><br>
		<input type="radio" id="is_delivery_availabe1" name="is_delivery_availabe" class="edit_delivery" value="Y" <?php if($is_delivery_availabe == 'Y') { ?> checked = "checked" <?php } ?>>
		<label for="Y">Yes</label><br>
		
		<input type="radio" id="is_delivery_availabe2" name="is_delivery_availabe" class="edit_delivery" value="N" <?php if($is_delivery_availabe == 'N') { ?> checked = "checked" <?php } ?>>
		<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_deliverys_availabe_validation">
			Please enter Is Delivery Avaliable
		  </div>
	  </div>
		</div>

 	  <input type="hidden" name="deliveryType" id="deliveryType" value="">
		
		
	<div class="col-md-6">
		  <div class="form-group delType">
			<label for="restaurant_delivery_chargers">Restaurant Delivery Chargers:</label>
			<input type="text" class="form-control" id="restaurant_delivery_chargers" name="restaurant_delivery_chargers" value="<?= $restaurant_delivery_chargers; ?>">
			<div class="invalid-feedback" id="restaurant_delivery_chargers_validation">
				Please enter Dish Price
			</div>
		  </div>
    </div>	

    <div class="col-md-6">
		<div class="form-group delType">
		<label for="minimum_order_amount_for_delivery">Minimum Order Amount For Delivery:</label>
		<input type="text" class="form-control" id="minimum_order_amount_for_delivery" name="minimum_order_amount_for_delivery" value="<?= $minimum_order_amount_for_delivery; ?>">
		  <div class="invalid-feedback" id="minimum_order_amount_for_delivery_validation">
		    Please enter Minimum Order Amount For Delivery
	      </div>
		</div>
    </div>	

        <div class="col-md-6">
		<div class="form-group delType">
		<label for="minimum_order_delivery_time_in_minutes">Minimum Order Delivery Time In Minutes:</label>
		<input type="number" class="form-control" id="minimum_order_delivery_time_in_minutes" name="minimum_order_delivery_time_in_minutes"  value="<?= $minimum_order_delivery_time_in_minutes; ?>">
			<div class="invalid-feedback" id="minimum_order_delivery_time_in_minutes_validation">
				Please enter Minimum Order Delivery Time In Minutes
			 </div>
			<div class="invalid-feedback" id="order_delivery_time_in_minutes_validation">
				Please enter Minimum Order Delivery Time 1 to 100 minutes
			 </div>
		</div>
        </div>	

	  <input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
	   
    <button type="button" class="btn btn-default btn_1 medium" id="editrestaurant">submit</button>
   <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurants'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

	</form>

</div>
</div>
</div>
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

 	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>