
<?php

/* @var $this yii\web\View */

$this->title = 'Roti Time';
$this->registerJsFile('js/jquery-3.4.1.min.js');

if(!empty($error)) {
	echo $error;
}

?>




			<div class="content-wrapper">
				<div class="container-fluid">
				  <!-- Breadcrumbs-->
				  <ol class="breadcrumb">
					<li class="breadcrumb-item">
					  <a href="#">Dashboard</a>
					</li>
					<li class="breadcrumb-item active">Orders</li>
				  </ol>

				  <div class="box_general padding_bottom">
					<div class="header_box version_2">
						<h2><i class="fa fa-file"></i>Basic info</h2>
					</div>
  
  
  
   <form method="POST">
    <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_name">Restaurant Name:</label>
    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="<?php echo $restaurant_name; ?>">
  </div>
  </div>

 
    <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_street">Restaurant Street:</label>
    <input type="text" class="form-control" id="restaurant_street" name="restaurant_street" value="<?php echo $restaurant_street; ?>">
  </div>
  </div>


    <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_house_no">Restaurant House No:</label>
    <input type="text" class="form-control" id="restaurant_house_no" name="restaurant_house_no" value="<?php echo $restaurant_house_no; ?>">
  </div>
  </div>

 
    <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_pincode">Restaurant Pincode:</label>
    <input type="number" class="form-control" id="restaurant_pincode" name="restaurant_pincode" value="<?php echo $restaurant_pincode; ?>">
  </div>
  </div>


   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_district">Restaurant District:</label>
    <input type="text" class="form-control" id="restaurant_district" name="restaurant_district" value="<?php echo $restaurant_district; ?>">
  </div>
  </div>
 
 
   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_city">Restaurant City:</label>
    <input type="text" class="form-control" id="restaurant_city" name="restaurant_city" value="<?php echo $restaurant_city; ?>">
  </div>
  </div>


   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_country">Restaurant Country:</label>
    <input type="text" class="form-control" id="restaurant_country" name="restaurant_country" value="<?php echo $restaurant_country; ?>">
  </div>
  </div>

    <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_telephone_no">Restaurant Tel No:</label>
    <input type="tel_no" class="form-control" id="restaurant_telephone_no" name="restaurant_telephone_no" value="<?php echo $restaurant_telephone_no; ?>">
  </div>
  </div>




   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_fax_no">Restaurant Fax No:</label>
    <input type="number" class="form-control" id="restaurant_fax_no" name="restaurant_fax_no" value="<?php echo $restaurant_fax_no; ?>">
  </div>
  </div>

 

   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_mobile_no">Restaurant  Mobile No:</label>
    <input type="number" class="form-control" id="restaurant_mobile_no" name="restaurant_mobile_no" value="<?php echo $restaurant_mobile_no; ?>">
  </div>
  </div>

 
   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_contact_person_name">Restaurant Contact Person Name:</label>
    <input type="text" class="form-control" id="restaurant_contact_person_name" name="restaurant_contact_person_name" value="<?php echo $restaurant_contact_person_name; ?>">
  </div>
  </div>


   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_email">Restaurant Email:</label>
    <input type="text" class="form-control" id="restaurant_email" name="restaurant_email" value="<?php echo $restaurant_email; ?>">
  </div>
  </div>


   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_website">Restaurant Website:</label>
    <input type="url" class="form-control" id="restaurant_website" name="restaurant_website" value="<?php echo $restaurant_website; ?>">
  </div>
  </div>


   <div class="col-md-6">
   <div class="form-group">
    <label for="restaurant_rating">Restaurant Rating:</label>
    <input type="text" class="form-control" id="restaurant_rating" name="restaurant_rating" value="<?php echo $restaurant_rating; ?>">
  </div>
  </div>




   
  <button type="submit" class="btn btn-default btn_1 medium" id = "submitbutton">submit</button>
</form>

</div>
      </div>
    </div>
