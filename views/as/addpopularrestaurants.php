<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Popular Restaurants';
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
        <li class="breadcrumb-item active">Popular Restaurants</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Popular Restaurants</h2>
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
			  
			     <div class="col-md-4">
			  <div class="form-group">
				<label for="grey_button_title">Popular Restaurants:</label>
				<select class="js-example-basic-multiple form-control" name="popularRestaurants[]" multiple="multiple">
				   <?php foreach($dataFromRestaurantDisplay as $res) { ?>
					<option <?php if($restaurant_id == $res['restaurant_id']) { ?> selected = 'selected' <?php } ?> value='<?= $res['restaurant_id']; ?>'><?= $res['restaurant_name']."ID:".$res['restaurant_id']; ?></option>
					<?php } ?>
				</select>
			  </div>
			  </div>
			  <input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
	
				 <button type="submit" class="btn btn-default btn_1 medium" id ="popularRestaurantSubmit">Submit</button>
			    <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-popular-restaurants'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
			  </form>

			  </div>
			     </div>
				 </div>
				 
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>