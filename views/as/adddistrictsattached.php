
<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Districts Attached';
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
			<li class="breadcrumb-item active">Add Districts Attached</li>
		  </ol>

		  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Add Districts Attached</h2>
			</div>


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
		
		
		<div class="col-md-6">
			<div class="form-group">
				<label for="restaurant_city">City Name</label>
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
			  
		
		<div class="col-md-6">
		<div class="form-group">
		<label for="district_name">District Name:</label>
		<input type="text" class="form-control" id="district_name" name="district_name">
		  <div class="invalid-feedback" id="district_name_validation">
			Please enter District Name
		  </div>
		</div>
		</div>



		
		<div class="col-md-6">
			<div id="inputFormRow">
			<label for="attached_district">Attach District:</label>
				<div class="input-group mb-3">
					<input type="text" id="attached_district" name="attached_district[]" class="form-control m-input" placeholder="Attach District" autocomplete="off">
					<div class="input-group-append">                
						<button id="removeRow" type="button" style="padding: .60rem .60rem;" class="btn btn-danger">Remove</button>
					</div>
				</div>
			</div>
		<div id="newRow"></div>
			<button id="addRow" type="button" class="btn btn-info">Add Row</button>
        </div>



    <div class="col-md-6" style="padding-top: 20px;">
   <button type="submit" class="btn btn-default btn_1 medium" id="districtsubmit">submit</button>
	  <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-districts-attached'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
    </div>
    </form>
	</div>
	</div>
	</div>


	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>