<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Restaurant Dishes';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
$actionName =  $this->context->action->id;
?>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Restaurant Dishes</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Edit Restaurant Dishes</h2>
        </div>
		
		
 <form method="post" enctype="multipart/form-data"  id="editDishes" name="editdishes">
 
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
 
 <?= $this->render('logged_in_user_restaurants', [
                               "restaurant_id" => $restaurant_id,
                            ]
                        ); ?>

    <div class="col-md-6">
			  <div class="form-group">
				<label for="dish_name">Dish Name:</label>
				<input type="text" class="form-control" id="dish_name" name="dish_name" value="<?= $dish_name; ?>">
				<input type="hidden" name="dish_name_hidden" id="dish_name_hidden" value="<?= $dish_name;?>">
				<div class="invalid-feedback" id="dish_name_validation">
					Please enter Dish Name
				</div>
				<div class="invalid-feedback" id="dish_same_name_validation">
				  Dish Name Already Exist
				</div>
			  </div>
    </div>
	
	<div class="col-md-6">
		<div class="form-group">
		 <label for="dish_category">Dish Category:</label>
		            <div class="styled-select">
								<select id="dish_category" name="dish_category" value="<?= $dish_category; ?>">
									<option value=''>Dish Category</option>
							<option <?php if($dish_category == 'main dish') { ?> selected = 'selected' <?php } ?> value='main dish'>Main Dish</option>
							<option <?php if($dish_category == 'sweets') { ?> selected = 'selected' <?php } ?> value='sweets'>Sweets</option>
							<option <?php if($dish_category == 'starters') { ?> selected = 'selected' <?php } ?> value='starters'>Starters</option>
							<option <?php if($dish_category == 'Drinks') { ?> selected = 'selected' <?php } ?> value='Drinks'>Drinks</option>
							<option <?php if($dish_category == 'ice cream') { ?> selected = 'selected' <?php } ?> value='ice cream'>Ice Cream</option>
							<option <?php if($dish_category == 'side dish') { ?> selected = 'selected' <?php } ?> value='side dish'>Side Dish</option>
							<option <?php if($dish_category == 'indian bread') { ?> selected = 'selected' <?php } ?> value='indian bread'>Indian Bread</option>
							<option <?php if($dish_category == 'soups') { ?> selected = 'selected' <?php } ?> value='soups'>Soups</option>
							<option <?php if($dish_category == 'Salads') { ?> selected = 'selected' <?php } ?> value='Salads'>Salads</option>
							<option <?php if($dish_category == 'vegan') { ?> selected = 'selected' <?php } ?> value='vegan'>Vegan</option>
							<option <?php if($dish_category == 'sea food') { ?> selected = 'selected' <?php } ?> value='sea food'>Sea Food</option>
							<option <?php if($dish_category == 'rice dish') { ?> selected = 'selected' <?php } ?> value='rice dish'>Rice Dish</option>
							<option <?php if($dish_category == 'tandoori') { ?> selected = 'selected' <?php } ?> value='tandoori'>Tandoori</option>
							<option <?php if($dish_category == 'south indian') { ?> selected = 'selected' <?php } ?> value='south indian'>South Indian</option>
							<option <?php if($dish_category == 'north indian') { ?> selected = 'selected' <?php } ?> value='north indian'>North Indian</option>
							<option <?php if($dish_category == 'east indian') { ?> selected = 'selected' <?php } ?> value='east indian'>East Indian</option>
							<option <?php if($dish_category == 'west indian') { ?> selected = 'selected' <?php } ?> value='west indian'>West Indian</option>
							<option <?php if($dish_category == 'halal') { ?> selected = 'selected' <?php } ?> value='halal'>Halal</option>
							<option <?php if($dish_category == 'grill') { ?> selected = 'selected' <?php } ?> value='grill'>Grill</option>

								</select>
					</div>
		    <div class="invalid-feedback" id="dish_category_validation">
					Please enter Dish Category
			</div>					
		 </div>
    </div>
	
	<div class="col-md-6">
		  <div class="form-group">
		 <input type="hidden" id="is_dish_halal" name="is_dish_halal"  value="N" <?php if($is_dish_halal == 'N') { ?> checked = "checked" <?php } ?>>
		 <input type="checkbox" id="is_dish_halal" name="is_dish_halal"  value="Y" <?php if($is_dish_halal == 'Y') { ?> checked = "checked" <?php } ?>>
          <label for="is_dish_halal">Is Dish Halal</label><br>
			<div class="invalid-feedback" id="is_dish_halal_validation">
				Please enter Is Dish Halal
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
			  <div class="form-group">
				<label for="dish_allergy_text">Dish Allergy Text:</label>
				<input type="text" class="form-control" id="dish_allergy_text" name="dish_allergy_text"  value="<?= $dish_allergy_text; ?>">
				<div class="invalid-feedback" id="dish_allergy_text_validation">
					Please enter Dish Allergy Text
				</div>
			  </div>
    </div>
  
    <div class="col-md-6">
			 <div class="form-group">
			 <label for="Select Menu">Select Menu With This Dish:</label>
			  <div class="styled-select">
									<select id="restaurant_menu_id" name="restaurant_menu_id">
										<option value=''>Select Menu</option>
										<?php foreach($dataFromViewRestaurantMenusInEdit as $res) { ?>
										<option <?php if($restaurant_menu_id == $res['restaurant_menu_id']) { ?> selected = 'selected' <?php } ?> value='<?= $res['restaurant_menu_id']; ?>'><?= $res['menu_name']; ?></option>
										<?php } ?>
									</select>
								</div>
			<div class="invalid-feedback" id="dish_number_in_menu_validation">
					Please Select Menu With This Dish
				  </div>					
			 </div>
    </div> 
 
    <div class="col-md-6">
		  <div class="form-group">
			<label for="dish_price">Dish Price:</label>
			<input type="text" class="form-control" id="dish_price" name="dish_price" value="<?= $dish_price; ?>">
			<div class="invalid-feedback" id="dish_price_validation">
				Please enter Dish Price
			</div>
		  </div>
    </div>
	
	 <div class="col-md-6">
			  <div class="form-group">
				<label for="dish_discount_percentage">Dish Discount Percentage:</label>
				<input type="text" class="form-control" name="dish_discount_percentage" id="dish_discount_percentage" onblur="dish_disco()" value="<?+$dish_discount_percentage; ?>">
				<div class="invalid-feedback" id="dish_discount_percentage_validation">
					Please enter Dish Discount Percentage
				</div>
			  </div>
    </div>
  
    <div class="col-md-6">
		  <div class="form-group">
			<label for="dish_discount_price">Dish Discount Price:</label>
			<input type="text" class="form-control" name="dish_discount_price" id="dish_discount_price"  class="nu_field" readonly/ value="<?= $dish_discount_price; ?>">
			<div class="invalid-feedback" id="dish_discount_price_validation">
				Please enter Dish Discount Price
			</div>
		  </div>
    </div>
                                                                                                                         
    <div class="col-md-6">
		  <div class="form-group">
		   <label for="dish_image">Dish Image:</label><br>
		   <input type="file" name="dish_image" id="dish_image" value="<?= $dish_image;?>">
		   <input type="hidden" name="dish_image_hidden" id="dish_image_hidden" value="<?= $dish_image;?>">
		   <input type="hidden" name="dish_image_type" id="dish_image_type" value="edit">
		   <figure>
		 <img src="<?= 'http://zefasa.com/rotitime/web/'.$dish_image; ?>" data-src ="<?= 'http://zefasa.com/rotitime/web/'.$dish_image; ?>">
		 <div>
			Image size: 460*310
		   </div>
		 </figure>
		    <div class="invalid-feedback" id="dish_image_validation">
				Please enter Dish Image
			</div>
		   <div class="invalid-feedback" id="dish_image_extension_validation">
			 Please upload file with extension .jpeg/.jpg/.png only
		   </div>
		  </div>
    </div>

    <div class="col-md-6">
			 <div class="form-group">
				<label for="dish_image_alt_text_english">Dish Image Alt Text English:</label>
				<input type="txt" class="form-control" id="dish_image_alt_text_english" name="dish_image_alt_text_english" value="<?= $dish_image_alt_text_english; ?>">
			  </div>
    </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_image_alt_text_german">Dish Image Alt Text German:</label>
			<input type="text" class="form-control" id="dish_image_alt_text_german" name="dish_image_alt_text_german" value="<?= $dish_image_alt_text_german; ?>">
		  </div>
    </div>
 
 
    <div class="col-md-6">
			  <div class="form-group">
				<label for="dish_image_title_text_english">Dish Image Title Text English:</label>
				<input type="text" class="form-control" id="dish_image_title_text_english" name="dish_image_title_text_english" value="<?= $dish_image_title_text_english; ?>">
			  </div>
    </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_image_title_text_german">Dish Image Title Text German:</label>
			<input type="text" class="form-control" id="dish_image_title_text_german" name="dish_image_title_text_german" value="<?= $dish_image_title_text_german; ?>">
		  </div>
    </div>
                                                                                                                         
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_type">Dish Type:</label>
			<div class="styled-select">
								<select id="dish_type" name="dish_type" value="<?= $dish_type; ?>">
							<option value=''>Dish type</option>
							<option <?php if($dish_type == 'Veg') { ?> selected = 'selected' <?php } ?> value='Veg'>Veg</option>
							<option <?php if($dish_type == 'Non-Veg') { ?> selected = 'selected' <?php } ?> value='Non-Veg'>Non-Veg</option>
							<option <?php if($dish_type == 'Starter') { ?> selected = 'selected' <?php } ?> value='Starter'>Starter</option>
							<option <?php if($dish_type == 'Drinks') { ?> selected = 'selected' <?php } ?> value='Drinks'>Drinks</option>
							<option <?php if($dish_type == 'Dessert') { ?> selected = 'selected' <?php } ?> value='Dessert'>Dessert</option>
							</select>
			</div>
			    <div class="invalid-feedback" id="dish_type_validation">
				Please enter Dish Type
			    </div>
		  </div>
    </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_link">Dish Link:</label>
			<input type="text" class="form-control" id="dish_link" name="dish_link" value="<?= $dish_link; ?>">
		  </div>
    </div>
  
    <div class="col-md-6">
			 <div class="form-group">
				<label for="dish_info_english">Dish Info English:</label>
				<input type="text" class="form-control" id="dish_info_english" name="dish_info_english" value="<?= $dish_info_english; ?>">
				<div class="invalid-feedback" id="dish_info_english_validation">
					Please enter Dish Info English
				</div>
			  </div>
    </div>
 
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_info_german">Dish Info German:</label>
			<input type="text" class="form-control" id="dish_info_german" name="dish_info_german" value="<?= $dish_info_german; ?>">
			<div class="invalid-feedback" id="dish_info_german_validation">
				Please enter Dish Info German
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
			<div class="form-group">
			<label for="is_delivery_availabe">Is Delivery Availabe:</label><br>
			<input type="radio" id="is_delivery_availabe" name="is_delivery_availabe" value="Y" <?php if($is_delivery_availabe == 'Y') { ?> checked = "checked" <?php } ?>>
			<label for="Y">Yes</label><br>

			<input type="radio" id="is_delivery_availabe" name="is_delivery_availabe" value="N" <?php if($is_delivery_availabe == 'N') { ?> checked = "checked" <?php } ?>>
			<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_delivery_availabe_validation">
				Please enter Is Delivery Available
			</div>
		  </div>
    </div>
  
  
    <div class="col-md-6">
			<div class="form-group">
			<label for="is_dish_active">Is Active:</label><br>
			<input type="radio" id="is_dish_active" name="is_dish_active" value="Y" <?php if($is_dish_active == 'Y') { ?> checked = "checked" <?php } ?>>
			<label for="Y">Yes</label><br>

			<input type="radio" id="is_dish_active" name="is_dish_active" value="N"<?php if($is_dish_active == 'N') { ?> checked = "checked" <?php } ?>>
			<label for="N">No</label><br>
			<div class="invalid-feedback" id="is_dish_active_validation">
				Please enter Is Dish Active
			</div>
		  </div>
    </div>
    <input type="hidden" name="pageName" id="pageName" value="<?=$actionName;?>">

	 <input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
    
    <button type="button" class="btn btn-default btn_1 medium" id ="dishesedit">Submit</button>
     <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurant-dishes'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

</form>
</div>
</div>
</div>

  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>

