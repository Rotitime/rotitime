<?php
use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Restaurant Dishes';
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
        <li class="breadcrumb-item active">View Restaurant Dishes</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>View Restaurant Dishes</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No</th>
		 <th>Restaurant Name</th>
        <th>Dish Name</th>
		<th>Dish Type</th>
		<th>Dish Category</th>
		<th>Is Dish Halal</th>
		<th>Dish Allergy Text</th>
		<th>Menu With This Dish</th>
        <th>Dish Price</th>
        <th>Dish Discount Price</th>
        <th>Dish Discount Percentage</th>
		<th>action</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($dataFromViewRestaurantDishes as $res)
	
	{?>
	
	
      <tr>
        <td><?= $res['dish_id'] ?></td>
        <td><?php if(!empty($displayRestaurantNamee[$res['restaurant_id']])) echo $displayRestaurantNamee[$res['restaurant_id']]; ?></td>
        <td><?= $res['dish_name'] ?></td>
		<td><?= $res['dish_type'] ?></td>
		<td><?= $res['dish_category'] ?></td>
		<td><?= $res['is_dish_halal'] ?></td>
		<td><?= $res['dish_allergy_text'] ?></td>
        <td><?php if(!empty($displayRestaurantsMenus[$res['restaurant_menu_id']])) echo $displayRestaurantsMenus[$res['restaurant_menu_id']]; ?></td>
        <td><?= $res['dish_price'] ?></td>
        <td><?= $res['dish_discount_price'] ?></td>
        <td><?= $res['dish_discount_percentage'] ?></td>
		<td><a href="<?=$relativeHomeUrl;?>am/edit-restaurant-dishes?rec_id=<?= $res['dish_id']; ?>">Edit</a></td>
		 <td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteRestaurantDishRow('<?= $res['dish_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
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
            <button class="btn btn-primary" type="button" id="confirmDeleteRestaurantDishRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
