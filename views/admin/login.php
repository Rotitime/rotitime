<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$session = Yii::$app->session;
$relativeHomeUrl = Url::home();

$this->title = 'Admin Login';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');



$editor_css = $relativeHomeUrl."admin_section/js/editor/summernote-bs4.css?" . rand(1, 1000);
$this->registerCssFile($editor_css);


$controllerName = Yii::$app->controller->id;

?>

<main class="login-form">
    <div class="container">
        <div class="row justify-content-center  pt-5 mt-5 mb-4" >
            <a class="navbar-brand" href="dashboard.html"><img src="<?=$relativeHomeUrl?>img/logo1.png" data-retina="true" alt="" ></a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8">
                <div class="card">
				<?php
					if ($session->hasFlash('ErrorMessage'))
					{
					?>
						<div class="alert alert-danger alert-dismissible" role="alert">
							<div class="alert-message p-2 pl-3"><?= $session->getFlash('ErrorMessage'); ?> </div>
						</div>
					<?php } ?>
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="post" action="<?=$relativeHomeUrl?>admin/login-submit"  id="loginform" >
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="LoginForm[email_address]" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="LoginForm[password]" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>

<?php
		$validation_js = $relativeHomeUrl."js/reports.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>