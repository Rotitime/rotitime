<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add  Restaurant Cities';
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
        <li class="breadcrumb-item active">Add  Restaurant Cities</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add  Restaurant Cities</h2>
        </div>
			  
			  <form  method="post" id="addPopularRestaurants" name="addPopularRestaurants">
			  
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
				<label for="restaurant_cities">Restaurant Cities:</label>
				<input type="text" class="form-control" id="restaurant_cities" name="restaurant_cities">
				<div class="invalid-feedback" id="restaurant_cities_validation">
					Please enter restaurant cities
				</div>
			  </div>
			  </div>
	
				 <button type="submit" class="btn btn-default btn_1 medium" id ="RestaurantCitiesSubmit">Submit</button>
			    <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-restaurant-cities'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 medium">Cancel</a>
			  </form>

			  </div>
			     </div>
				 </div>
				 
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>