<?php
use yii\helpers\Url;

$relativeHomeUrl = Url::home();

/* @var $this yii\web\View */

$this->title = 'View Resataurant Delivery Postal Codes';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');
?>

<!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?=$relativeHomeUrl;?>reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Resataurant Delivery Postal Codes</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>View Resataurant Delivery Postal Codes</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No</th>
		<th>Restaurant City</th>
		<th>Restaurant Name</th>
		<th>No of Postal Codes</th>
		<th>Postal Code Added At</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php 
	$i = 1;
	foreach($dataFromViewRestaurantDeliveryPostalCodes as $res)
	
	{?>
	
	
      <tr>
		<td><?= $i; ?></td>
        <td><?= $res['restaurant_city']; ?></td>
        <td><?= $res['restaurant_name']; ?></td>
		 <td><?= $res['cnt']; ?></td>
        <td><?= $res['restaurant_delivery_postal_code_added_at']; ?></td>
		<td><a href="<?=$relativeHomeUrl;?>am/edit-restaurant-delivery-postal-codes?restaurant_id=<?= $res['restaurant_id']; ?>">Edit</a></td>

	
       </tr>
	<?php 
		$i++;   
	   } ?>

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
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
