<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurant We Trust Section';
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
        <li class="breadcrumb-item active">Add Restaurant We Trust Section</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Restaurant We Trust Section</h2>
        </div>
			  
	    <form  method="post" id="addRestaurantWeTrustForm" name="addrestaurantwetrustform">
			  
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
				<label for="we_trust_title">We Trust Title:</label>
				<input type="text" class="form-control" id="we_trust_title" name="we_trust_title">
				  <div class="invalid-feedback" id="we_trust_title_validation">
					Please enter We Trust Title
				  </div>
			  </div>
			  </div>
			  
			     <div class="col-md-6">
			  <div class="form-group">
				<label for="we_trust_type">We Trust Type:</label>
				<input type="text" class="form-control" id="we_trust_type" name="we_trust_type">
				  <div class="invalid-feedback" id="we_trust_type_validation">
					Please enter We Trust Type
				  </div>
			  </div>
			  </div>

			     <div class="col-md-6">
			  <div class="form-group">
				<label for="we_trust_sequence_number">We Trust Sequence Number:</label>
				<input type="number" class="form-control" id="we_trust_sequence_number" name="we_trust_sequence_number">
		        <input type="hidden" name="we_trust_sequence_number_hidden" id="we_trust_sequence_number_hidden" value="<?= $we_trust_sequence_number;?>">
				  <div class="invalid-feedback" id="we_trust_sequence_number_validation">
					Please enter We Trust Sequence Number
				  </div>
				  <div class="invalid-feedback" id="we_trust_same_number_validation">
					We Trust Sequence Number Already Exist
				  </div>
			  </div>
		     </div>
			 
			 <input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>

				 <button type="button" class="btn btn-default btn_1 medium" id ="addrestaurantwetrust">Submit</button>
                 <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurants'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

		</form>

			  </div>
			     </div>
				 </div>
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>