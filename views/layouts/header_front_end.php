<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\User;

AppAsset::register($this);
$relativeHomeUrl = Url::home();
$controllerName = Yii::$app->controller->id;
$actionName = Yii::$app->controller->action->id; // get action name



$stlyeClassHeader = "";
if($controllerName == 'ab') {
	$stlyeClassHeader = "header_in";
}
$restaurantDetailsPageClass = 'bodyId';
if($actionName == 'restaurant-details') {
	$restaurantDetailsPageClass = "details";
}
$Users = new User();
$LoggedUserId = $Users->GetLoginUserId();
$LoggedUserType = $Users->GetLoginUserType();
$LoggedInUserName = $Users->GetLoginUserName();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head> 
  <meta name="google-signin-client_id" content="712694426839-0mprkf9l7ee1oik6ucjq0eh858dbtgt6.apps.googleusercontent.com">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="RotiTime - Discover & Book the best restaurants at the best price">
    <meta name="author" content="Ansonika">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
	
	<!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

	
</head>
<body id="<?=$restaurantDetailsPageClass;?>">
<?php $this->beginBody() ?>

<header class="header clearfix element_to_stick <?=$stlyeClassHeader;?>">
		<div class="container">
		<div id="logo">
			<a href="<?= $relativeHomeUrl ?>">
				<img src="<?= $relativeHomeUrl ?>img/logo.png" alt="" class="logo_normal">
				<img src="<?= $relativeHomeUrl ?>img/logo1.png" alt="" class="logo_sticky">
			</a>
		</div>


		<a href="#0" class="open_close">
			<i class="icon_menu"></i><span>Menu</span>
		</a>
		<nav class="main-menu">
			<div id="header_menu">
				<a href="#0" class="open_close">
					<i class="icon_close"></i><span>Menu</span>
				</a>
				<a href="index.html"><img src="<?= $relativeHomeUrl ?>img/logo1.png" alt=""></a>
			</div>
			<ul>
				<?php if(empty($LoggedUserId)) { ?>
					<li><a href="#restraunt-in-dialog" id ="restraunt-in" class="btn_1">Restaurant Owners Login</a></li>
				<?php } else { ?>
					<li><a  class="btn_1"><?=$LoggedInUserName;?></a></li>
				<?php } ?>
				
			</ul>
		</nav>
		<!-- <ul id="top_menu">
			<li id="language-selector">
				<select class="selectpicker" data-width="fit">
					<option data-content='<span class="flag-icon flag-icon-us"></span>'></option>
				  <option  data-content='<span class="flag-icon flag-icon-de"></span>'></option>
				</select>
			</li>				
			<li class="submenu">
				<a href="#sign-in-dialog" id="sign-in" class=""><i class="fas fa-user"></i></a>
			</li>
		</ul> -->
		<!-- /top_menu -->		
	</div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Enter delivery address</h3>
                </div>
                <div class="modal-body">
                    <p>We do not have your address. Please enter here.</p>
                    <form method="post" class="main-search">
                        <div class="row no-gutters custom-search-input">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <span>Where:</span>
                                    <input class="form-control no_border_r address autocomplete" type="text" id="autocomplete_popup" onFocus="geolocate()" type="text" placeholder="City or attraction..." value="<?=$userLocationFromCookies;?>">
                                    <i class="icon_pin_alt"></i>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <input type="submit" value="Search" id="searchSubmit_popup" class="searchSubmit">
                            </div>
                        </div>
                        <!-- /row -->

                        <div class="row justify-content-center">
                            <div class="col-lg-12 text-center">
                                <a rel="nofollow" id="precise_location_popup" href="javascript:void(0);" onclick="getLocation()" role="button" class="search_nearby nearby_link precise_location"><i class="fas fa-location-arrow"></i>Use my precise location</a>
                            </div>
                        </div>
                    </form>
                </div>

                <button type="button" class="mfp-close" data-dismiss="modal"></button>

            </div>

        </div>
    </div>
	</header>

	<!-- /Sign In Modal -->

	<!-- Restraunt Owner In Modal -->
	<div id="restraunt-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Sign In</h3>
		</div>
		<form>
			<div class="sign-in-wrapper">
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="owner_email" id="owner_email">
					<div class="invalid-feedback" id="owner_email_validation">
						Please enter Email
					  </div>
					<div class="invalid-feedback" id="email_validation">
					  The email or password you entered is incorrect! 
					 </div>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="owner_password" id="owner_password" value="">
					<div class="invalid-feedback" id="owner_password_validation">
						Please enter Password
					  </div>
				</div>
				<div class="clearfix add_bottom_15">
					<div class="checkboxes float-left">
						<label class="container_check">Remember me
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</div>
					<div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
				</div>
				<div class="text-center">
					<input type="button" value="Log In" id="ownerLogin" class="btn_1 full-width mb_5">
					
<!--<div class="fb-login-button float-right mt-1" data-width="50" data-size="medium" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>--->				
								
				</div>
				<div class="form-group">Don�t have an account? <a href="<?=Yii::$app->homeUrl;?>ab/add-restaurant-owner">Sign up</a>	</div>	
				<div id="forgot_pw">
					<div class="form-group">
						<label>Please confirm login email below</label>
						<input type="email" class="form-control" name="email_forgot" id="email_forgot">
						<i class="icon_mail_alt"></i>
					</div>
					<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
					<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>					
				</div>
                <input type="hidden" id="relativeHomeUrl" value="<?= $relativeHomeUrl ?>" name="relativeHomeUrl" >
		 	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>

			</div>
		</form>
		<!--form -->
	</div>
	<!-- /Sign In Modal -->
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/te_IN/sdk.js#xfbml=1&version=v10.0&appId=927457057798837&autoLogAppEvents=1" nonce="D8t4aOcQ"></script>
	<script>
    function onSuccess(googleUser) {      

		//alert('Logged in as: ' + googleUser.getBasicProfile().getName());
		//alert('Logged in as: ' + googleUser.getBasicProfile().getEmail());
		var profile = googleUser.getBasicProfile();
		console.log('ID: ' + profile.getId());
		console.log('Full Name: ' + profile.getName());
		console.log('Given Name: ' + profile.getGivenName());
		console.log('Family Name: ' + profile.getFamilyName());
		console.log('Image URL: ' + profile.getImageUrl());
		console.log('Email: ' + profile.getEmail());

		var logged_in_email = googleUser.getBasicProfile().getEmail();
        var logged_in_name = googleUser.getBasicProfile().getName();

		var resturant_name = $("#resturant_name").val();
        
        var relativeHomeUrl = $("#relativeHomeUrl").val();

		logged_email = btoa(logged_in_email);
		logged_name = btoa(logged_in_name);
		
		posturl = relativeHomeUrl+"site/google-login";
		$.post(
		posturl, {
			logged_email: logged_email,
			logged_name:logged_name,
			_csrf: csrfTokenPage,
		},
		function (ResponseData){
				window.location.href = relativeHomeUrl+resturant_name+"?from=gsignin";
				signOut();
			//alert(ResponseData);
		/*if($.trim(ResponseData) == 'exist') {
			$("#display_sequence_number").focus();
			$("#sequence_number_validation").show();
			e.preventDefault();
			return false;
		} else {
			$("#editGreyButtonForm").submit();
		} */


		}

		);
    }
    function onFailure(error) {
        console.log(error);
	}
	
    function renderButton() {
        gapi.signin2.render('my-signin2', {
            'scope': 'profile email',
            'width': 150,
            'height': 30,
            'longtitle': true,
            'theme': 'dark',
            'redirect_uri': 'www.google.com',
            'onsuccess': onSuccess,
            'onfailure': onFailure
        });
    }
</script>

<script>
      function signOut() {

        var auth2 = gapi.auth2.getAuthInstance();

        auth2.signOut().then(function () {
          console.log('User signed out.');

        });
      }
     
    </script>
<script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>