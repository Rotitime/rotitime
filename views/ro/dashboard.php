<?php
use yii\helpers\Url;

$relativeHomeUrl = Url::home();
$this->title = 'RT - Dashbaord';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
?>

  <!-- Navigation-->
  
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
	  <!-- Icon Cards-->
    <!--Calendar-->
    <div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-calendar-check-o"></i>Date</h2>
			</div>
      <div class="row">

        <div class="col-xl-3 col-sm-6 mb-3">      
      <input type="text" name="dates" id="report_dates" value="<?=$report_dates;?>" class="form-control pull-right">
        </div>
        </div>
		</div>
 <!--Calendar-->
      <div class="row">
		<?php if(empty($restaurnat_ids)) { ?>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-envelope-open"></i>
              </div>
              <div class="mr-5"><h5><span id="newRsCount"><?=$restaurantCnt;?></span> New Restraunts!</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?=$relativeHomeUrl?>reports/view-restaurants?selected_dates=<?=base64_encode($report_dates);?>">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

	<?php } ?>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-calendar-check-o"></i>
              </div>
              <div class="mr-5"><h5><span id="orderCount"><?=$ordersCnt;?></span> New Orders!</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?=$relativeHomeUrl?>reports/view-restaurant-orders?selected_dates=<?=base64_encode($report_dates);?>">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-star"></i>
              </div>
				<div class="mr-5"><h5><?=$reviewsCnt;?> New Reviews!</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="<?=$relativeHomeUrl?>reports/view-reviews?selected_dates=<?=base64_encode($report_dates);?>">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <!--<div class="col-xl-3 col-sm-6 mb-3">
          <div class="card dashboard text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-heart"></i>
              </div>
              <div class="mr-5"><h5>10 New Pending Orders</h5></div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div> -->
		</div>
		<!-- /cards -->
		<h2></h2>
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-bar-chart"></i>Statistic</h2>
			</div>
		
		</div>
      </div>
      <input type="hidden" value="<?=$relativeHomeUrl;?>" id="homeUrl" name="homeUrl" />
	  <!-- /.container-fluid-->
   	</div>
    <!-- /.container-wrapper-->
    <!-- Scroll to Top Button-->

