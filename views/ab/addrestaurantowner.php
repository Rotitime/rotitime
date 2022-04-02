<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurant Owner';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

?>


	<main class="bg_gray pattern">
		
		<div class="container margin_60_40">
		    <div class="row justify-content-center">
		        <div class="col-lg-4">
		        	<div class="sign_up">
		                <div class="head">
		                    <div class="title">
		                    <h3>Sign Up</h3>
		                </div>
		                </div>
		                <!-- /head -->
		                <div class="main">
		                	<h6>Personal details</h6>
						<form  method="post" enctype="multipart/form-data" id="ownerSubmitForm" name="ownersubmit">

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
							<div class="form-group">
								<input type="email" class="form-control" name="register_email" id="register_email" placeholder="Email Address" >
								  <div class="invalid-feedback" id="owner_emails_validation">
									Please enter Owner Email
								  </div>
								  <div class="invalid-feedback" id="same_emails_validation">
									Email Already Exist
								  </div>
									<div class="invalid-feedback" id="email_format_validation">
									   Example:test@test.com
									  </div>
		            			<i class="icon_mail"></i>
		            		</div>
							<div class="form-group">
								<input type="text" class="form-control" id="owner_first_name" name="owner_first_name" placeholder="First Name">
		            			
								<div class="invalid-feedback" id="owner_first_name_validation">
			                     Please enter First Name
		                        </div>
								 <i class="icon_pencil"></i>
		            		</div>
		                	<div class="form-group">
								<input type="text" class="form-control" id="owner_last_name" name="owner_last_name" placeholder="Last Name">
								<div class="invalid-feedback" id="owner_last_name_validation">
			                    Please enter Owner Last Name
		                        </div>
								<i class="icon_pencil"></i>
		            		</div>
		            		<div class="form-group">
								<input type="password" class="form-control" id="password_encrypted" name="password_encrypted" placeholder="Password Encrypted">
		                       <div class="invalid-feedback" id="password_encrypted_validation">
			                   Please enter Password Encrypted
		                       </div>
		            			<i class="icon_lock"></i>
		            		</div>
							<div class="form-group">
								<input type="password" class="form-control" id="re_enter_password" name="re_enter_password" placeholder="Password Encrypted">
		                        <div class="invalid-feedback" id="re_enter_password_validation">
			                    Please enter Re Enter Password
		                       </div>
		                       <div class="invalid-feedback" id="password_validation">
			                   Your Password Did Not Match
		                       </div>
		            			<i class="icon_lock"></i>
		            		</div>
							<div class="form-group add_bottom_15">
								<input type="text" class="form-control" id="owner_note" name="owner_note" placeholder="owner note">
		            			<i class="icon_pencil"></i>
		            		</div>
 	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>

							<button type="button" class="btn_1 full-width mb_5" id="submitbuttonowner">Sign up Now</button>
						</form>
						</div>
		            </div>
		            <!-- /box_booking -->
		        </div>
		        <!-- /col -->

		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->
		
	</main>

  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>