<?php
use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Restaurant Address';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
?>

<!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?=$relativeHomeUrl;?>reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Restaurant Address</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>View Restaurant Address</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No</th>
		<th>Restaurant Name</th>
		<th>Restaurant Latitude</th>
		<th>Restaurant Longitude</th>
        <th>Restaurant City</th>
        <th>Restaurant Country</th>
        <th>Restaurant Telephone No</th>
        <th>Restaurant Mobile No</th>
		<th>Restaurant Email</th>
		<th>Restaurant Rating</th>
		<th>action</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($dataFromViewRestaurantAddress as $res)
	
	{?>
	
	
      <tr>
        <td><?= $res['restaurant_address_id'] ?></td>
        <td><?php if(!empty($displayRestaurantsName[$res['restaurant_id']])) echo $displayRestaurantsName[$res['restaurant_id']]; ?></td>
		<td><?= $res['restaurant_latitude'] ?></td>
		<td><?= $res['restaurant_longitude'] ?></td>
        <td><?= $res['restaurant_city'] ?></td>
        <td><?= $res['restaurant_country'] ?></td>
        <td><?= $res['restaurant_telephone_no'] ?></td>
        <td><?= $res['restaurant_mobile_no'] ?></td>
        <td><?= $res['restaurant_email'] ?></td>
        <td><?= $res['restaurant_rating'] ?></td>
		<td><a href="<?=$relativeHomeUrl;?>am/edit-restaurant-address?rec_id=<?= $res['restaurant_address_id']; ?>">Edit</a></td>
		<td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteRestaurantAddressRow('<?= $res['restaurant_address_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
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
            <button class="btn btn-primary" type="button" id="confirmDeleteRestaurantAddressRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>