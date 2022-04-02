<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Dish Suppliments';
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
        <li class="breadcrumb-item active">Dish Suppliments</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Edit Dish Suppliments</h2>
        </div>
		
		
 <form  method="post" enctype="multipart/form-data">
 
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
			 <label for="dish_suppliments_id">Dish Name:</label>
			  <div class="styled-select">
									<select id="dish_id" name="dish_id">
										<option value=''>Select Dish</option>
										<?php foreach($dataFromViewRestaurantDishesInEdit as $res) { ?>
										<option <?php if($dish_id == $res['dish_id']) { ?> selected = 'selected' <?php } ?> value='<?= $res['dish_id']; ?>'><?= $res['dish_name']; ?></option>
										<?php } ?>
									</select>
								</div>
			<div class="invalid-feedback" id="section_category_valid">
					Please select Dish Name
				  </div>					
			 </div>
    </div>
 
    <div class="col-md-6">
		  <div class="form-group">
			<label for="suppliment_name">Suppliment Name:</label>
			<input type="text" class="form-control" id="suppliment_name" name="suppliment_name" value="<?= $suppliment_name; ?>">
			<div class="invalid-feedback" id="suppliment_name_validation">
				Please enter Suppliment Name
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
		  <div class="form-group">
			<label for="allergy_information">Allergy Information:</label>
			<input type="text" class="form-control" id="allergy_information" name="allergy_information" value="<?= $allergy_information; ?>">
			<div class="invalid-feedback" id="allergy_information_validation">
				Please enter Allergy Information
			</div>
		  </div>
    </div>
  
  
  
    <div class="col-md-6">
			<div class="form-group">
			<label for="is_active">Is Active:</label><br>
			<input type="radio" id="is_active" name="is_active" value="Y" <?php if($is_active == 'Y') { ?> checked = "checked" <?php } ?>>
			<label for="Y">Yes</label><br>

			<input type="radio" id="is_active" name="is_active" value="N" <?php if($is_active == 'N') { ?> checked = "checked" <?php } ?>>
			<label for="N">No</label><br>
			<div class="invalid-feedback" id="is_active_validation">
				Please enter Is Active
			</div>
		  </div>
    </div>
 
	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
    
  <button type="submit" class="btn btn-default btn_1 medium submitbuttonsuppliment" id = "submitb">submit</button>
     <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-dish-suppliments'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

</form>
</div>
</div>
</div>

  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>

