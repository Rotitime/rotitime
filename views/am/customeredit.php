<?php

/* @var $this yii\web\View */

$this->title = 'Roti Time';
$this->registerJsFile('js/jquery-3.4.1.min.js');

?>



<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Customer Delivery Details</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Edit</h2>
        </div>
		
 
 <form method="POST" method="post" enctype="multipart/form-data">
 
 <div class="col-md-6">
  <div class="form-group">
    <label for="cust_email ">cust email:</label>
    <input type="email" class="form-control" id="cust_email" name="cust_email" value="<?php echo $cust_email; ?>">
  </div>
  </div>
 
   <div class="col-md-6">
  <div class="form-group">
    <label for="cust_first_name">cust first name:</label>
    <input type="text" class="form-control" id="cust_first_name" name="cust_first_name" value="<?php echo $cust_first_name; ?>">
  </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
    <label for="cust_last_name">cust last name:</label>
    <input type="text" class="form-control" id="cust_last_name" name="cust_last_name" value="<?php echo $cust_last_name; ?>">
  </div>
  </div>
  
 <div class="col-md-6">
  <div class="form-group">
    <label for="cust_sur_name">cust sur name:</label>
    <input type="text" class="form-control" id="cust_sur_name" name="cust_sur_name" value="<?php echo $cust_sur_name; ?>">
  </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
   <label for="cust_phone_number">cust phone number:</label><br>
   <input type="number" class="form-control" id="cust_phone_number" name="cust_phone_number" value="<?php echo $cust_phone_number; ?>">
  </div>
  </div>

 <div class="col-md-6">
 <div class="form-group">
    <label for="cust_house_number">cust house number:</label>
    <input type="txt" class="form-control" id="cust_house_number" name="cust_house_number" value="<?php echo $cust_house_number; ?>">
  </div>
  </div>
 
  <div class="col-md-6">
 <div class="form-group">
    <label for="cust_pin_code">cust pin code:</label>
    <input type="number" class="form-control" id="cust_pin_code" name="cust_pin_code" value="<?php echo $cust_pin_code; ?>">
  </div>
  </div>
 
 
  <div class="col-md-6">
  <div class="form-group">
    <label for="cust_city">cust city:</label>
    <input type="text" class="form-control" id="cust_city" name="cust_city" value="<?php echo $cust_city; ?>">
  </div>
  </div>
 
    <div class="col-md-6">
    <div class="form-group">
    <label for="is_active">Is Active:</label><br>
    <input type="radio" id="is_active" name="is_active" value="Y">
    <label for="Y">Yes</label><br>

    <input type="radio" id="is_active1" name="is_active1" value="N">
    <label for="N">No</label><br>
  </div>
  </div>


  <div class="col-md-6">
 <div class="form-group">
    <label for="cust_land_line_number">cust_land_line_number:</label>
    <input type="text" class="form-control" id="cust_land_line_number" name="cust_land_line_number" value="<?php echo $cust_land_line_number; ?>">
  </div>
  </div>
 
 <div class="col-md-6">
 <div class="form-group">
    <label for="cust_comment_by_admin">cust comment by admin:</label>
    <input type="text" class="form-control" id="cust_comment_by_admin" name="cust_comment_by_admin" value="<?php echo $cust_comment_by_admin; ?>">
  </div>
  </div>
  
 
   
    
 <button type="submit" class="btn btn-default btn_1 medium" id = "submitbutton">submit</button></form>
</div>
</div>
</div>
