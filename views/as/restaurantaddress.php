
<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$select2Css = $relativeHomeUrl."plugins/select2/dist/css/select2.min.css";
$this->registerCssFile($select2Css);

$this->title = 'Roti Time';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

if(!empty($error)) {
	echo $error;
}
?>



<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Restaurant Address</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Restaurant Address</h2>
        </div>
  
  
 <form method="POST">
 
 
   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_name">Restaurant Name:</label>
    <input type="text" class="form-control" id="restaurant_name" name="restaurant_name">
  </div>
    </div>

  <div class="form-group row">
<label for="inputEmail3" class="col-md-3 text-right control-label col-form-label">Controller
	Name</label>
<div class="col-md-6">
	<select class="js-example-basic-single form-control" name="controller_name" id="controller_name" onchange="">
		<option value="">Select</option>
		<option value="">Option 1</option>
		<option value="">Option 2</option>
	</select>
</div>
</div>

    <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_street">Restaurant Street:</label>
    <input type="text" class="form-control" id="restaurant_street" name="restaurant_street">
  </div>
    </div>

 
    <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_house_no">Restaurant House No:</label>
    <input type="text" class="form-control" id="restaurant_house_no" name="restaurant_house_no">
  </div>
    </div>

 
 
 
   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_pincode">Restaurant Pincode:</label>
    <input type="number" class="form-control" id="restaurant_pincode" name="restaurant_pincode">
  </div>
    </div>

  
  
   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_district">Restaurant District:</label>
    <input type="text" class="form-control" id="restaurant_district" name="restaurant_district">
  </div>
    </div>

 
 
     <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_city">Restaurant City:</label>
    <input type="text" class="form-control" id="restaurant_city" name="restaurant_city">
  </div>
    </div>

 
  <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_country">Restaurant Country:</label>
    <input type="text" class="form-control" id="restaurant_country" name="restaurant_country">
  </div>
    </div>

 
 
 
   <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_telephone_no">Restaurant Telephone No:</label>
    <input type="number" class="form-control" id="restaurant_telephone_no" name="restaurant_telephone_no">
  </div>
    </div>

 
 
  <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_fax_no">Restaurant Fax No:</label>
    <input type="number" class="form-control" id="restaurant_fax_no" name="restaurant_fax_no">
  </div>
    </div>

 
 
 
  <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_mobile_no">Restaurant Mobile No:</label>
    <input type="number" class="form-control" id="restaurant_mobile_no" name="restaurant_mobile_no">
  </div>
    </div>

 
 
 
  <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_contact_person_name">Restaurant Contact Person Name:</label>
    <input type="text" class="form-control" id="restaurant_contact_person_name" name="restaurant_contact_person_name">
  </div>
    </div>

 
 
  <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_email">Restaurant Email:</label>
    <input type="text" class="form-control" id="restaurant_email" name="restaurant_email">
  </div>
    </div>

 
 
  <div class="col-md-6">
  <div class="form-group">
    <label for="restaurant_website">Restaurant Website:</label>
    <input type="text" class="form-control" id="restaurant_website" name="restaurant_website">
  </div>
    </div>

 
 
  <div class="col-md-6">
   <div class="form-group">
    <label for="restaurant_rating">Restaurant Rating:</label>
    <input type="text" class="form-control" id="restaurant_rating" name="restaurant_rating">
  </div>
    </div>


 
   
  <button type="submit" class="btn btn-default btn_1 medium"  id="submitbutton">submit</button>
</form>

          </div>
       </div>
    </div>

<?php


$select2 = $relativeHomeUrl."plugins/select2/dist/js/select2.full.min.js";
$this->registerJsFile($select2);

$selectJs = $relativeHomeUrl."plugins/bootstrap-select/bootstrap-select.min.js";
$this->registerJsFile($selectJs);

$validation_js = $relativeHomeUrl."js/restaurant_homepage.js?" . rand(1, 1000);
$this->registerJsFile($validation_js);

?>
