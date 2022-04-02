<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurants Address';
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
        <li class="breadcrumb-item active">Restaurants Address</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Restaurants Address</h2>
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
			<label for="restaurant_latitude">Restaurant Latitude:</label>
			<input type="text" class="form-control" id="restaurant_latitude" name="restaurant_latitude">
			<a href="https://developer.mapquest.com/documentation/tools/latitude-longitude-finder/" target="_blank">To get Latitude Please click here</a>
			<div class="invalid-feedback" id="restaurant_latitude_validation">
				Please enter Restaurant Latitude
			  </div>
		  </div>
    </div>


    <div class="col-md-6">
		  <div class="form-group">
			<label for="restaurant_longitude">Restaurant Longitude:</label>
			<input type="text" class="form-control" id="restaurant_longitude" name="restaurant_longitude">
			<a href="https://developer.mapquest.com/documentation/tools/latitude-longitude-finder/" target="_blank">To get Longitude Please click here</a>
			<div class="invalid-feedback" id="restaurant_longitude_validation">
				Please enter Restaurant Longitude
			  </div>
		  </div>
    </div>	

    <div class="col-md-6">
		  <div class="form-group">
			<label for="restaurant_street">Restaurant Street:</label>
			<input type="text" class="form-control" id="restaurant_street" name="restaurant_street">
			<div class="invalid-feedback" id="restaurant_street_validation">
				Please enter Restaurant Street
			  </div>
		  </div>
    </div>
  
    <div class="col-md-6">
		  <div class="form-group">
			<label for="restaurant_house_no">Restaurant House No:</label>
			<input type="text" class="form-control" id="restaurant_house_no" name="restaurant_house_no">
			<div class="invalid-feedback" id="restaurant_house_no_validation">
				Please enter Restaurant House No
			  </div>
		  </div>
    </div>
  
    <div class="col-md-6">
		  <div class="form-group">
			<label for="restaurant_pincode">Restaurant Pincode:</label>
			<input type="text" class="form-control" id="restaurant_pincode" name="restaurant_pincode">
			<div class="invalid-feedback" id="restaurant_pincode_validation">
				Please enter Restaurant Pincode
			  </div>
		  </div>
    </div>
  
    <div class="col-md-6">
		  <div class="form-group">
		   <label for="restaurant_district">Restaurant District:</label><br>
		   <input type="text" class="form-control" id="restaurant_district" name="restaurant_district">
		   <div class="invalid-feedback" id="restaurant_district_validation">
				Please enter Restaurant District
			  </div>
		  </div>
    </div>

    <div class="col-md-6">
		 <div class="form-group">
			<label for="restaurant_city">Restaurant City:</label>
			<input type="text" class="form-control" id="restaurant_city" name="restaurant_city">
			<div class="invalid-feedback" id="restaurant_city_validation">
				Please enter Restaurant City
			  </div>
		  </div>
    </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="restaurant_country">Restaurant Country:</label>
			<input type="text" class="form-control" id="restaurant_country" name="restaurant_country">
			<div class="invalid-feedback" id="restaurant_country_validation">
				Please enter Restaurant Country
			  </div>
		  </div>
    </div>
 
 
    <div class="col-md-6">
		  <div class="form-group">
			<label for="restaurant_telephone_no">Restaurant Telephone No:</label>
			<input type="text" class="form-control" id="restaurant_telephone_no" name="restaurant_telephone_no">
			<div class="invalid-feedback" id="restaurant_telephone_no_validation">
				Please enter Restaurant Telephone No
			  </div>
		  </div>
    </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="restaurant_fax_no">Restaurant Fax No:</label>
			<input type="text" class="form-control" id="restaurant_fax_no" name="restaurant_fax_no">
			<div class="invalid-feedback" id="restaurant_fax_no_validation">
				Please enter Restaurant Fax No
			  </div>
		  </div>
    </div>
 
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="restaurant_mobile_no">Restaurant Mobile No:</label>
			<input type="text" class="form-control" id="restaurant_mobile_no" name="restaurant_mobile_no">
			<div class="invalid-feedback" id="restaurant_mobile_no_validation">
				Please enter Restaurant Mobile No
			  </div>
		  </div>
    </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="restaurant_contact_person_name">Restaurant Contact Person Name:</label>
			<input type="text" class="form-control" id="restaurant_contact_person_name" name="restaurant_contact_person_name">
			<div class="invalid-feedback" id="restaurant_contact_person_name_validation">
				Please enter Restaurant Contact Person Name
			  </div>
		  </div>
    </div>
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="restaurant_email">Restaurant Email:</label>
			<input type="email" class="form-control" id="restaurant_email" name="restaurant_email">
			<div class="invalid-feedback" id="empty_email_validation">
				Please enter Email
			 </div>
			<div class="invalid-feedback" id="restaurant_email_validation">
			   Example:test@test.com
			  </div>
		  </div>
    </div>
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="restaurant_website">Restaurant Website:</label>
			<input type="text" class="form-control" id="restaurant_website" name="restaurant_website">
			<div class="invalid-feedback" id="restaurant_website_validation">
				Please enter Restaurant Website
			  </div>
		  </div>
    </div>
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="restaurant_rating">Restaurant Rating:</label>
			<input type="text" class="form-control" id="restaurant_rating" name="restaurant_rating">
			<div class="invalid-feedback" id="restaurant_rating_validation">
				Please enter Restaurant Rating
			  </div>
		  </div>
    </div>

	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>  
 
  <button type="submit" class="btn btn-default btn_1 medium" id = "submitbuttonaddress">submit</button>
  <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-restaurant-address'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
</form>
</div>
</div>
</div>
</div>

	<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>