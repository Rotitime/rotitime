<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Select Restaurant to Edit';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

$rtAdminStepsArr = array('Restaurant','Address','Timings','Specialities','Menus','Dishes','Supliments');

//$rtAdminStepsUrlArr = array('as/restaurant-edit','am/edit-restaurant-address','am/edit-restaurant-timings','am/edit-restaurant-specialities','am/edit-restaurant-menus','am/edit-restaurant-dishes','am/edit-dish-suppliments');

$rtAdminStepsUrlArr = array('restaurant','address','timings','specialities','menus','dishes','suppliments');

?>



	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">SELECT RESTAURANT TO UPDATE</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>SELECT RESTAURANT TO UPDATE</h2>
        </div>
			  
			  <form  method="post" id="selectRestaurantForm" name="selectRestaurantForm">
			  
			    <div class="col-md-6">
				<div class="form-group">
				<?php
				if(!empty($error)) { ?>
				<div class="alert alert-danger" role="alert">

				<?=$error;?>
				</div>				<?php
				}
				?>
				</div>
				</div>
			  
			  <div class="col-md-6">
			  <div class="form-group">
				<label for="restaurant_city">Select Restaurant City</label>
				<select class="js-example-basic-single form-control" name="restaurant_city" id="restaurant_city" onchange="return fnGetCityRestaurants()">
					<option value="">Select Restaurant City</option>
				   <?php foreach($dataFromViewRestaurantCities as $res) { ?>
					<option value='<?= $res['restaurant_city']; ?>'><?= $res['restaurant_city']; ?></option>
					<?php } ?>
				</select>
			  </div>
			  </div>


			  <div class="col-md-6">
			  <div class="form-group">
				<label for="grey_button_title">Select Restaurant</label>
				<select class="js-example-basic-single form-control" name="selectRestaurant" id="selectRestaurant">
					<option value="">Select Restaurant</option>
				   <?php foreach($dataFromRestaurantDisplay as $res) { ?>
					<option value='<?= $res['restaurant_id']; ?>'><?= $res['restaurant_name']; ?></option>
					<?php } ?>
				</select>
				<input type="hidden" id="selectedRestId" name="selectedRestId" >
				<input type="hidden" id="relativeUrl" name="relativeUrl"  value="<?=$relativeHomeUrl;?>">
			  </div>
			  </div>
			  

				<?php 
					
					$i = 0;
					foreach($rtAdminStepsArr as $res) { 


					?>
					<button type="button" class="btn btn-default btn_1" onclick = "return fnUpdateLink('<?=$rtAdminStepsUrlArr[$i]?>');"><?=$res;?></button>
				<?php 
					$i++;	
					} ?>
				 
			    
			  </form>

			  </div>
			     </div>
				 </div>
				 
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>