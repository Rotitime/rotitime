<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Restaurants';
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
        <li class="breadcrumb-item active">View Restaurants</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> View Restaurants</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No </th> 
        <th>Restaurant Name </th>
        <th>Restaurant City </th>
        <th>Restaurant Type English </th>
        <th>Is Restaurant Premium </th>
        <th>Is Restaurant Active</th>
        <th>Is Delivery Avaliable </th>		
        <th>Restaurant Registred At</th>
		<th>Action</th>
		<th>Delete</th>
      </tr>
    </thead>
    <tbody>
<?php foreach($dataFromRestaurantDisplay as $res) { ?>

      <tr>
        <td><?php echo $res['restaurant_id']; ?></td>
        <td><?php echo $res['restaurant_name']; ?></td>
		<td><?php echo $res['restaurant_city']; ?></td>
		<td><?php echo $res['restaurant_type_english']; ?></td>
		<td><?php echo $res['is_restaurant_premium']; ?></td>
		<td><?php echo $res['is_restaurant_active']; ?></td>
		<td><?php echo $res['is_delivery_availabe']; ?></td>
		<td><?php echo $res['restaurant_registred_at']; ?></td>
        <td><a href="http://zefasa.com/rotitime/web/as/restaurant-edit?rec_id=<?php echo $res['restaurant_id']; ?>">Edit</a></td>
		 <td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteRow('<?= $res['restaurant_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
		 </td>

	
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