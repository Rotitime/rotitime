<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Select Restaurant City';
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
        <li class="breadcrumb-item active">SELECT RESTAURANT CITY</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>SELECT RESTAURANT CITY</h2>
        </div>
			  
			  <form  method="post" id="selectRestaurantForms" name="selectRestaurantForms">
			  
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
				<select class="js-example-basic-single form-control" name="restaurant_city" id="restaurant_city">
					<option value="">Select Restaurant City</option>
				   <?php foreach($dataFromViewRestaurantCities as $res) { ?>
					<option value='<?= $res['restaurant_cities']; ?>'><?= $res['restaurant_cities']; ?></option>
					<?php } ?>
				</select>
			  </div>
			  </div>
			  
				
				 <button type="submit" class="btn btn-default btn_1 medium" id ="selectcity">Search Restaurants</button>
				
				 
			    
			  </form>

			  </div>
			     </div>
				 </div>
				 
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>