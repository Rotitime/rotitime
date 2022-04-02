<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Restaurant Owner';
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
			<li class="breadcrumb-item active">Edit Restaurant Owner</li>
		  </ol>

		  <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Edit Restaurant Owner</h2>
			</div>


	<form method="POST" method="post" enctype="multipart/form-data" id="editOwnerForm" name="editownerform">

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
		<label for="owner_email">Owner Email:</label>
		<input type="email" class="form-control" id="owner_email" name="owner_email" value="<?php echo $owner_email;?>">
	    <input type="hidden" name="owner_email_hidden" id="owner_email_hidden" value="<?php echo $owner_email;?>">
		  <div class="invalid-feedback" id="owner_email_validation">
			Please enter Owner Email
		  </div>
		  <div class="invalid-feedback" id="same_email_validation">
		  Email Already Exists
		  </div>
		</div>
		</div>


		<div class="col-md-6">
		<div class="form-group">
		<label for="owner_first_name">Owner First Name:</label>
		<input type="text" class="form-control" id="owner_first_name" name="owner_first_name" value="<?php echo $owner_first_name;?>">
		  <div class="invalid-feedback" id="owner_first_name_validation">
			Please enter First Name
		  </div>
		</div>
		</div>


		<div class="col-md-6">
		<div class="form-group">
		<label for="owner_last_name">Owner Last Name:</label>
		<input type="text" class="form-control" id="owner_last_name" name="owner_last_name" value="<?php echo $owner_last_name;?>">
		  <div class="invalid-feedback" id="owner_last_name_validation">
			Please enter Owner Last Name
		  </div>
		</div>
		</div>




		<div class="col-md-6">
		<div class="form-group">
		<label for="password_encrypted">Password:</label>
		<input type="password" class="form-control" id="password_encrypted" name="password_encrypted" value="<?php echo $password_encrypted;?>">
		  <div class="invalid-feedback" id="password_encrypted_validation">
			Please enter Password
		  </div>
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="re_enter_password">Re Enter Password:</label>
		<input type="password" class="form-control" id="re_enter_password" name="re_enter_password">
		  <div class="invalid-feedback" id="re_enter_password_validation">
			Please enter Re Enter Password
		  </div>
		  <div class="invalid-feedback" id="password_validation">
			Your Password Did Not Match
		  </div>
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="is_active ">Is Active:</label><br>
		<input type="radio" id="is_active" name="is_active" value="Y" <?php if($is_active == 'Y') { ?> checked = "checked" <?php } ?>>
		<label for="Y">Yes</label><br>

		<input type="radio" id="is_active" name="is_active" value="N" <?php if($is_active == 'N') { ?> checked = "checked" <?php } ?>>
		<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_active_validation">
			Please enter Is Active
		  </div>
		</div>
		</div>
	


		<div class="col-md-6">
		<div class="form-group">
		<label for="owner_note">Owner Note:</label>
		<input type="text" class="form-control" id="owner_note" name="owner_note"  value="<?php echo $owner_note;?>">
		  <div class="invalid-feedback" id="owner_note_validation">
			Please enter Restaurant Owner Note
		  </div>
		</div>
		</div>



   <button type="button" class="btn btn-default btn_1 medium" id = "editowner">submit</button>
   <a href="<?php echo Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurant-owner'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

    </form>
	</div>
	</div>
	</div>


	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>