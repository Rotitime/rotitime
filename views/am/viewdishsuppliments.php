<?php
use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Dish Suppliments';
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
        <li class="breadcrumb-item active">Dish Suppliments</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>View Dish Suppliments</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Dish Name</th>
        <th>Suppliment Name</th>
		<th>Allergy Information</th>
        <th>Is Active</th>
		<th>Added At</th>
		<th>action</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($dataFromViewDishSuppliments as $res)
	
	{?>
	
	
      <tr>
        <td><?= $res['dish_suppliments_id'] ?></td>
	    <td><?php if(!empty($displayRestaurantDishName[$res['dish_id']])) echo $displayRestaurantDishName[$res['dish_id']]; ?></td>
        <td><?= $res['suppliment_name'] ?></td>
        <td><?= $res['allergy_information'] ?></td>
        <td><?= $res['is_active'] ?></td>
		<td><?= $res['added_at'] ?></td>
		<td><a href="<?=$relativeHomeUrl;?>am/edit-dish-suppliments?rec_id=<?= $res['dish_suppliments_id']; ?>">Edit</a></td>
		 <td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteDishSupplimentsRow('<?= $res['dish_suppliments_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
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
            <button class="btn btn-primary" type="button" id="confirmDeleteDishSupplimentsRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
