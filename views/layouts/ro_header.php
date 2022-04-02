<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetRo;

AppAssetRo::register($this);

$relativeUrl = Yii::$app->homeUrl;
$controllerName = Yii::$app->controller->id;
$actionName = Yii::$app->controller->action->id;

?>
<?php $this->beginPage() ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
 <link rel="shortcut icon" href="<?=$relativeUrl?>admin_section/img/favicon.ico" type="image/x-icon">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light nav-grn" style="background:#5eb530">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     </ul>
	 <h5 class="" style="margin:0 auto; font-weight:bold; color:#fff;">Orders</h5>
	 <a href="<?=SITE_URL?>reports/dashboard" class="nav-link"><h5 class="pull-right" style="font-weight:bold; color:#fff;">Restaurant Admin</h5></a>
     </nav>
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <a href="<?=SITE_URL?>reports/dashboard" class="brand-link">
      <img src="<?=SITE_URL?>img/logo.png" data-retina="true" alt="" width="142" height="36">
    </a>
  <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item">
            <a href="<?=SITE_URL?>ra/current-orders" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                New Orders
               </p>
            </a>
         </li>
		 <li class="nav-header accnt-sctn">Account</li>
          <li class="nav-item menu-">
			<a href="<?=SITE_URL?>reports/dashboard" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                My Account
                </p>
            </a>
		 </li>
		 <li class="nav-header accnt-sctn">Setting</li>
		  <li class="nav-item">
            <a  class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
             <p>
                Feedback
               </p>
            </a>
          </li> 
		  <li class="nav-item">
            <a  class="nav-link">
              <i class="nav-icon fas fa-language"></i>
             <p>Languages</p> </a>
          </li> 
		  <li class="nav-item">
            <a  class="nav-link">
              <i class="nav-icon fas fa-print"></i>
                <p>Thermal Printer</p>
              </a>
          </li> 
		  <li class="nav-item">
            <a  class="nav-link">
              <i class="nav-icon fas fa-book"></i>
                <p>Terms</p>
              </a>
          </li>
		   <li class="nav-item">
            <a class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
                <p>About</p>
              </a>
          </li>
		  <li class="nav-item">
            <a href="<?=SITE_URL;?>site/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
          </li>
		 </ul>
      </nav>
     </div>
   </aside>
	
