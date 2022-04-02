<?php

/* @var $this yii\web\View */

$this->title = 'Restaurant Address Display';
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
        <li class="breadcrumb-item active">View Restaurants Address</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> View Restaurants Address</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">   
				
			  <table class="table table-bordered">
				<thead>
				  <tr>
					<th>Restaurant Address Id</th>
					<th>Restaurant Id</th>
					<th>Restaurant Name</th>
					<th>Restaurant Street</th>
			        <th>Restaurant House No</th>
					<th>Restaurant Pincode</th>
					<th>Restaurant District</th>
					<th>Restaurant City</th>
					<th>Restaurant Country</th>
					<th>Restaurant Tel No</th>
					<th>Restaurant Fax Fo</th>
					<th>Restaurant Mobile No</th>
					<th>Restaurant Contact Person Name</th>
					<th>Restaurant Email</th>
					<th>Restaurant Website</th>
					<th>Restaurant Rating</th>
					<th>Action</th>
					<th>Action</th>

				  </tr>
				</thead>
				<tbody>
			<?php foreach($dataFromRestaurantAddressDisplay as $res) {?>

				  <tr>
					<td><?php echo $res['restaurant_address_id'] ?></td>
					<td><?php echo $res['restaurant_id'] ?></td>
					<td><?php echo $res['restaurant_name'] ?></td>
					<td><?php echo $res['restaurant_street'] ?></td>
					<td><?php echo $res['restaurant_house_no'] ?></td>
					<td><?php echo $res['restaurant_pincode'] ?></td>
					<td><?php echo $res['restaurant_district'] ?></td>
					<td><?php echo $res['restaurant_city'] ?></td>
					<td><?php echo $res['restaurant_country'] ?></td>
					<td><?php echo $res['restaurant_telephone_no'] ?></td>
					<td><?php echo $res['restaurant_fax_no'] ?></td>
					<td><?php echo $res['restaurant_mobile_no'] ?></td>
					<td><?php echo $res['restaurant_contact_person_name'] ?></td>
					<td><?php echo $res['restaurant_email'] ?></td>
					<td><?php echo $res['restaurant_website'] ?></td>
					<td><?php echo $res['restaurant_rating'] ?></td>
					<td><a href="http://zefasa.com/rotitime/web/as/restaurant-address-edit?rec_id=<?php echo $res['restaurant_address_id']; ?>" target="_blank">Edit</a></td>
					<td><a onclick="ConfirmDelete('<?php echo $res['restaurant_address_id']; ?>'); " >Delete</a></td>
					 


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