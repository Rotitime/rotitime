<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Restaurant Orders';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
?>




<!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Restaurant Orders</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> View Restaurant Orders</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No </th> 
        <th>Order Number </th>
        <th>Order Sub Total </th>
        <th>Order Price </th>
        <th>Minimum Order Amount For Delivery </th>
        <th>Order Delivery Charges</th>
        <th>Order Comments</th>
        <th>Ordered On</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
<?php foreach($dataFromViewRestaurantOrders as $res) { ?>

      <tr>
        <td><?php echo $res['order_id']; ?></td>
        <td><?php echo $res['order_number']; ?></td>
		<td><?php echo $res['order_sub_total']; ?></td>
		<td><?php echo $res['order_price']; ?></td>
		<td><?php echo $res['minimum_order_amount_for_delivery']; ?></td>
		<td><?php echo $res['order_delivery_charges']; ?></td>
		<td><?php echo $res['order_comments']; ?></td>
		<td><?php echo $res['ordered_on']; ?></td>
        <td><a href="<?php echo $res['order_id']; ?>">view</a></td>
       </tr>
	<?php } ?>

    </tbody>
  </table>
  <input type="hidden" name="deleteRowId" id="deleteRowId" />
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
	  </div>
	  <!-- /.container-fluid-->
   	</div>
<!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Are you really want to delete.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="button" id="confirmDeleteRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>