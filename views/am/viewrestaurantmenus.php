<?php
use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Restaurant Menus';
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
        <li class="breadcrumb-item active">View Restaurant Menus</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>View Restaurant Menus</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No</th>
		 <th>Restaurant Name</th>
        <th>Menu Name</th>
        <th>Menu Type</th>
        <th>Is Active</th>
		<th>Menu Display Sequence Number</th>
        <th>Menu Added At</th>
		<th>action</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($dataFromViewRestaurantMenus as $res)
	
	{?>
	
	
      <tr>
        <td><?= $res['restaurant_menu_id'] ?></td>
        <td><?php if(!empty($displayRestaurantNames[$res['restaurant_id']])) echo $displayRestaurantNames[$res['restaurant_id']]; ?></td>
        <td><?= $res['menu_name'] ?></td>
        <td><?= $res['menu_type'] ?></td>
        <td><?= $res['is_active'] ?></td>
		<td><?= $res['menu_display_sequence_number'] ?></td>
        <td><?= $res['menu_added_at'] ?></td>
		<td><a href="<?=$relativeHomeUrl;?>am/edit-restaurant-menus?rec_id=<?= $res['restaurant_menu_id']; ?>">Edit</a></td>
		<td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteRestaurantMenuRow('<?= $res['restaurant_menu_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
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
            <button class="btn btn-primary" type="button" id="confirmDeleteRestaurantMenuRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
