<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use app\models\RtCommonMethod;
$RtCommonMethod = new RtCommonMethod();
$loggedInOwnerRestaurants = $RtCommonMethod->fnGetLoggedInOwnerRestaurants();

$restaurant_url = Yii::$app->getRequest()->getQueryParam('restaurant_id');

if(!empty($restaurant_url)) {
	$restaurant_id = $restaurant_url;
	$restaurantCityName = $RtCommonMethod->fnGetRestaunrantCity($restaurant_id);

}


$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurant Delivery Postal Codes';
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
        <li class="breadcrumb-item active">Restaurant Delivery Postal Codes</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Restaurant Delivery Postal Codes</h2>
        </div>
		
<div class="row">
			<?= $this->render('add_restaurant_steps', [
									   
									]
								); ?>	
 <form method="POST" enctype="multipart/form-data">
 
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
		<?php if(empty($restaurnat_ids_arr)) { ?>
		 <div class="col-md-6">
			  <div class="form-group">
				<label for="restaurant_city">Select Restaurant City</label>
				<select class="js-example-basic-single form-control" name="restaurant_city" id="restaurant_city" onchange="return fnGetCityRestaurants()">
					<option value="">Select Restaurant City</option>
				   <?php foreach($dataFromViewRestaurantCities as $res) { ?>
					<option <?php if($restaurantCityName == $res['restaurant_city']) { ?> selected = 'selected' <?php } ?> value='<?= $res['restaurant_city']; ?>'><?= $res['restaurant_city']; ?></option>
					<?php } ?>
				</select>
				<input type="hidden" id="selectedRestId" name="selectedRestId" >
				<input type="hidden" id="relativeUrl" name="relativeUrl"  value="<?=$relativeHomeUrl;?>">
			  </div>
			  </div>
		<?php } ?>
		<div class="col-md-6">
			  <div class="form-group">
				<label for="grey_button_title">Select Restaurant</label>
				<select class="js-example-basic-single form-control" name="selectRestaurant" id="selectRestaurant">
					<option value="">Select Restaurant</option>
				   <?php foreach($loggedInOwnerRestaurants as $res) { ?>
					<option <?php if($restaurant_id == $res['restaurant_id']) { ?> selected = 'selected' <?php } ?> value='<?= $res['restaurant_id']; ?>'><?= $res['restaurant_name']; ?></option>
					<?php } ?>
				</select>
				<input type="hidden" id="selectedRestId" name="selectedRestId" >
				<input type="hidden" id="relativeUrl" name="relativeUrl"  value="<?=$relativeHomeUrl;?>">
			  </div>
			  </div>
			  

		<div class="col-md-6">
			<div id="inputFormRow">
			<label for="restaurant_delivery_postal_code">Restaurant Delivery Postal Code:</label>
				<div class="input-group mb-3">
					<input type="text" name="restaurant_delivery_postal_code[]" id="restaurant_delivery_postal_code"class="form-control m-input" placeholder="Enter Postal code" autocomplete="off">
					<div class="input-group-append">                
						<button id="removeRow" type="button" style="padding: .75rem .75rem;" class="btn btn-danger">Remove</button>
					</div>
				</div>
			</div>

			<div id="newRow"></div>
			<button id="addRow" type="button" class="btn btn-info">Add Row</button>
        </div>
		<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
		<div class="col-md-6" style="padding-top: 20px;">
	  <button type="submit" class="btn btn-default btn_1 medium" id = "submitbuttonpostalcodes">submit</button>
	  <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-restaurant-delivery-postal-codes'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
	  </div>
</form>
</div>
</div>
</div>
</div>

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>