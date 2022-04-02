<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Orders';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
?>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?=SITE_URL?>reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Orders</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> Orders Table Example</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Order Number</th>
                      <th>Restaurant</th>
                      <th>Order Total</th>
                      <th>Is Review Mail Sent</th>
                      <th>Is Reviews Added</th>
                      <th>Order At</th>
                      <th>View</th>
                    </tr>
                  </thead>
                  <tbody>
		    <?php foreach($orderedWithinDurationArr as $res) { ?>
                    <tr>
                    <td><?= $res['order_number']; ?></td>
                      <td><?= $res['restaurant_name']; ?></td>
 					  <td><?= $res['order_price']; ?></td>
                      <td><?= $res['is_request_for_review_email_sent']=='Y'?'Yes':'No';?></td>
                      <td><?= $res['is_review_added']=='Y'?'Yes':'No';?></td>
                      <td><?= $res['ordered_at']; ?></td>
                      <td><a href="<?=SITE_URL?>reports/view-restaurant-order-details?rec_id=<?= base64_encode($res['order_id']); ?>"><strong>View</strong></a></td>
                    </tr>
			<?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
	  </div>
	  <!-- /.container-fluid-->
   	</div>
    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © RotiTime 2019</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
