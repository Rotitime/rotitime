<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurants Dishes';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
$restaurant_name = '';
?>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Restaurants Dishes</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Restaurants Dishes</h2>
        </div>
	
	<div class="row">
			<?= $this->render('add_restaurant_steps', [
									   
									]
								); ?>	
 <form method="POST" method="post" enctype="multipart/form-data" id="addDishes" name="adddishes">
 
 
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
				<input type="text" class="form-control" id="dish_name" name="dish_name">
				<input type="hidden" name="dish_name_hidden" id="dish_name_hidden" value="<?php echo $dish_name;?>">
				<div class="invalid-feedback" id="dish_name_validation">
					Please enter Dishe Name
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
								<select id="dish_category" name="dish_category">
									<option value=''>Dish Category</option>
									<option  value='main dish'>Main Dish</option>
									<option  value='sweets'>Sweets</option>
									<option value='starters'>Starters</option>
									<option  value='drinks'>Drinks</option>
									<option  value='ice cream'>Ice Cream</option>
									<option value='side dish'>Side Dish</option>                                                     
									<option  value='indian bread'>Indian Bread</option>
									<option  value='soups'>Soups</option>
									<option value='salads'>Salads</option>                                                     
									<option  value='vegan'>Vegan</option>
									<option  value='sea food'>Sea Food</option>
									<option  value='rice dish'>Rice Dish</option>
									<option value='tandoori'>Tandoori</option>                                                     
									<option  value='south indian'>South Indian</option>
									<option  value='north indian'>North Indian</option>
									<option value='east indian'>East Indian</option>                                                     
									<option  value='west indian'>West Indian</option>
									<option value='halal'>Halal</option>                                                     
									<option  value='grill'>Grill</option>
								</select>
				</div>
		    <div class="invalid-feedback" id="dish_category_validation">
				Please enter Dish Category
			</div>				
		 </div>
    </div>
	
	<div class="col-md-6">
		  <div class="form-group">
		    <input type="hidden" id="is_dish_halal" name="is_dish_halal"  value="N">
            <input type="checkbox" id="is_dish_halal" name="is_dish_halal" value="Y">
            <label for="is_dish_halal">Is Dish Halal</label><br>
			<div class="invalid-feedback" id="is_dish_halal_validation">
				Please enter Is Dish Halal
			</div>
		  </div>
    </div>
	
  
    <div class="col-md-6">
		  <div class="form-group">
			<label for="dish_allergy_text">Dish Allergy Text:</label>
			<input type="text" class="form-control" id="dish_allergy_text" name="dish_allergy_text">
			<div class="invalid-feedback" id="dish_allergy_text_validation">
				Please enter Dish Allergy Text
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
			 <div class="form-group">
			 <label for="restaurant_menu_id">Select Menu With This Dish:</label>
			  <div class="styled-select">
									<select id="restaurant_menu_id" name="restaurant_menu_id">
										<option value=''>Select Menu</option>
										<?php 
										//if(!empty($CheckDishMenu)){
										foreach($dataFromViewRestaurantMenus as $res) { ?>
										<option  <?php if($restaurant_menu_id == $res['restaurant_menu_id']) { ?> selected = 'selected' <?php } ?> value='<?php echo $res['restaurant_menu_id']; ?>'><?php echo $res['menu_name']; ?></option>
										<?php 
										} 
										}
										?>
									</select>
								</div>
			<div class="invalid-feedback" id="dish_number_in_menu_validation">
					Please select Dish Number In Menu
				  </div>					
			 </div>
    </div>
 
    <div class="col-md-6">
		  <div class="form-group">
			<label for="dish_price">Dish Price:</label>
			<input type="text" class="form-control" id="dish_price" name="dish_price">
			<div class="invalid-feedback" id="dish_price_validation">
				Please enter Dish Price
			</div>
		  </div>
    </div>
  
  <div class="col-md-6">
		  <div class="form-group">
			<label for="dish_discount_percentage">Dish Discount Percentage:</label>
			<input type="text" class="form-control" name="dish_discount_percentage" id="dish_discount_percentage" onblur="dish_disco()">
			<div class="invalid-feedback" id="dish_discount_percentage_validation">
				Please enter Dish Discount Percentage
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
			  <div class="form-group">
				<label for="dish_discount_price">Dish Discount Price:</label>
				<input type="text" class="form-control" name="dish_discount_price" id="dish_discount_price"  class="nu_field" readonly/>
				<div class="invalid-feedback" id="dish_discount_price_validation">
					Please enter Dish Discount Price
				</div>
			  </div>
    </div>
                                                                                                                         
 
    <div class="col-md-6">
		  <div class="form-group">
		   <label for="dish_image">Dish Image:</label><br>
		   <input type="file" name="fileToUpload" id="fileToUpload">
		   <div>
			Image size: 460*310
		   </div>
		   <div class="invalid-feedback" id="dish_image_validation">
				Please enter Dish Image
			</div>
		  </div>
    </div>

 <div class="col-md-6">
 <div class="form-group">
    <label for="dish_image_alt_text_english">Dish Image Alt Text English:</label>
    <input type="txt" class="form-control" id="dish_image_alt_text_english" name="dish_image_alt_text_english">
  </div>
  </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_image_alt_text_german">Dish Image Alt Text German:</label>
			<input type="text" class="form-control" id="dish_image_alt_text_german" name="dish_image_alt_text_german">
		  </div>
    </div>
 
 
    <div class="col-md-6">
		  <div class="form-group">
			<label for="dish_image_title_text_english">Dish Image Title Text English:</label>
			<input type="text" class="form-control" id="dish_image_title_text_english" name="dish_image_title_text_english">
		  </div>
    </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_image_title_text_german">Dish Image Title Text German:</label>
			<input type="text" class="form-control" id="dish_image_title_text_german" name="dish_image_title_text_german">
		  </div>
    </div>
                                                                                                                         
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_type">Dish Type:</label>
		    <div class="styled-select">
			                    <select id="dish_type" name="dish_type">
									<option value=''>Dish type</option>
									<option  value='Veg'>Veg</option>
									<option  value='Non-Veg'>Non-Veg</option>
									<option value='Starter'>Starter</option>
									<option  value='Drinks'>Drinks</option>
									<option  value='Dessert'>Dessert</option>
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
			<input type="text" class="form-control" id="dish_link" name="dish_link"> 
		  </div>
    </div>
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_info_english">Dish Info English:</label>
			<input type="text" class="form-control" id="dish_info_english" name="dish_info_english">
			<div class="invalid-feedback" id="dish_info_english_validation">
				Please enter Dish Info English
			</div>
		  </div>
    </div>
 
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="dish_info_german">Dish Info German:</label>
			<input type="text" class="form-control" id="dish_info_german" name="dish_info_german">
			<div class="invalid-feedback" id="dish_info_german_validation">
				Please enter Dish Info German
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
			<div class="form-group">
			<label for="is_delivery_availabe">Is Delivery Availabe:</label><br>
			<input type="radio" id="is_delivery_availabe" name="is_delivery_availabe" value="Y">
			<label for="Y">Yes</label><br>

			<input type="radio" id="is_delivery_availabe" name="is_delivery_availabe" value="N">
			<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_delivery_availabe_validation">
				Please enter Is Delivery Available
			</div>
		  </div>
    </div>
  
  
    <div class="col-md-6">
			<div class="form-group">
			<label for="is_dish_active">Is Active:</label><br>
			<input type="radio" id="is_dish_active" name="is_dish_active" value="Y">
			<label for="Y">Yes</label><br>

			<input type="radio" id="is_dish_active" name="is_dish_active" value="N">
			<label for="N">No</label><br>
			<div class="invalid-feedback" id="is_dish_active_validation">
				Please enter Is Dish Active
			</div>
		  </div>
    </div>
	
	  <input type="hidden" name="addType" id="addType" value="">


  <button type="button" class="btn btn-default btn_1 medium submitbuttondishes" id = "addOneDish" value ="addOneDish">Add Dishes</button>
    <button type="button" class="btn btn-default btn_1 medium submitbuttondishes" id = "addMultipleDishes" value ="addMultipleDishes">Add Multiple Dishes In The Same Restaurant</button>
     <a href="<?php echo Yii::$app->homeUrl.'/'.$controllerName.'/add-restaurant-dishes'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

</form>
</div>
</div>
</div>
</div>

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>

