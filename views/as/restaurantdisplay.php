<?php

/* @var $this yii\web\View */

$this->title = 'Roti Time';
$this->registerJsFile('js/jquery-3.4.1.min.js');
?>




<!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
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
	    <th>Restaurant Image</th>
		<th>Restaurant Logo Image</th>
        <th>Restaurant City </th>
        <th>Restaurant Type English </th>
        <th>Restaurant Type German </th>
        <th>Restaurant Discount</th>
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
        <td><?php echo $res['restaurant_id'] ?></td>
        <td><?php echo $res['restaurant_name'] ?></td>
        <td><?php echo $res['restaurant_image'] ?></td>
        <td><?php echo $res['restaurant_logo_image'] ?></td>		
		<td><?php echo $res['restaurant_city'] ?></td>
		<td><?php echo $res['restaurant_type_english'] ?></td>
		<td><?php echo $res['restaurant_type_german'] ?></td>
		<td><?php echo $res['restaurant_discount'] ?></td>
		<td><?php echo $res['is_restaurant_premium'] ?></td>
		<td><?php echo $res['is_restaurant_active'] ?></td>
		<td><?php echo $res['is_delivery_availabe'] ?></td>
		<td><?php echo $res['restaurant_registred_at'] ?></td>
        <td><a href="http://zefasa.com/rotitime/web/as/restaurant-edit?rec_id=<?php echo $res['restaurant_id']; ?>" target="_blank">Edit</a></td>
        <td><a onclick="ConfirmDelete('<?php echo $res['restaurant_id']; ?>'); " >Delete</a></td>
		 


 </tr>
<?php }
?>

  
    </tbody>
  </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
	  </div>
	  <!-- /.container-fluid-->
   	</div>