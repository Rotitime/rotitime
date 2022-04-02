<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurnat Specialities';
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
        <li class="breadcrumb-item active">RESTAURANT SPECIALITIES</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>ADD RESTAURANT SPECIALITIES</h2>
        </div>
		
		<div class="row">
			<?= $this->render('add_restaurant_steps', [
									   
									]
								); ?>		
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
			<label for="speciality_type">Speciality Type:</label><br>
			<input type="radio" id="speciality_type1" name="speciality_type" value="Y" class="special">
			<label for="Y">Yes</label><br>

			<input type="radio" id="speciality_type2" name="speciality_type" value="N" class="special">
			<label for="N">No</label><br>
			
		  
			<div class="invalid-feedback" id="speciality_type_validation">
				Please enter Speciality Type
			</div>
		  </div>
    </div>
 	  <input type="hidden" name="specType" id="specType" value="">
    <div class="col-md-6">
		  <div class="form-group" id="restaurant_spec">
			<label for="restaurant_speciality">Restaurant Speciality:</label>
			<input type="text" class="form-control" id="restaurant_speciality" name="restaurant_speciality">
			
			<div class="invalid-feedback" id="restaurant_speciality_validation">
				Please enter Restaurant Speciality
			  </div>
		  </div>
    </div>

	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>

  
  <button type="submit" class="btn btn-default btn_1 medium" id = "addspecialities">submit</button>
  <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-restaurant-specialities'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
</form>
</div>
</div>
</div>
</div>

	<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>