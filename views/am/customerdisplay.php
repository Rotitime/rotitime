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
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
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
        <th>customer_id</th>
        <th>cust_email</th>
        <th>cust_first_name</th>
        <th>cust_last_name</th>
        <th>cust_sur_name</th>
        <th>cust_phone_number</th>
		<th>cust_house_number</th>
        <th>cust_pin_code</th>
        <th>cust_city</th>
        <th>is_active</th>
		<th>cust_land_line_number</th>
		<th>cust_comment_by_admin</th>
        <th>cust_delivery_at</th>
		<th>action</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($dataFromCustomerDisplay as $res)
	
	{?>
	
	
      <tr>
        <td><?php echo $res['customer_id'] ?></td>
        <td><?php echo $res['cust_email'] ?></td>
        <td><?php echo $res['cust_first_name'] ?></td>
        <td><?php echo $res['cust_last_name'] ?></td>
        <td><?php echo $res['cust_sur_name'] ?></td>
        <td><?php echo $res['cust_phone_number'] ?></td>
		<td><?php echo $res['cust_house_number'] ?></td>
        <td><?php echo $res['cust_pin_code'] ?></td>
        <td><?php echo $res['cust_city'] ?></td>
        <td><?php echo $res['is_active'] ?></td>
        <td><?php echo $res['cust_land_line_number'] ?></td>
		<td><?php echo $res['cust_comment_by_admin'] ?></td>
        <td><?php echo $res['cust_delivery_at'] ?></td>
		<td><a href="http://zefasa.com/rotitime/web/am/customer-edit?rec_id=<?php echo $res['customer_id']; ?>" target="_blank">Edit</a></td>
		 <td><a onclick="ConfirmDelete('<?php echo $res['customer_id']; ?>'); " >Delete</a></td>

	
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

