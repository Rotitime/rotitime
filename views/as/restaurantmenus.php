
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Orders</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Basic info</h2>
        </div>

 <form  method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="menu_name">Menu Name:</label>
    <input type="text" class="form-control" id="menu_name" name="menu_name">
  </div>
  
  <div class="form-group">
    <label for="menu_image_title_text">Menu Option Title:</label>
    <input type="text" class="form-control" id="menu_image_title_text" name="menu_image_title_text">
  </div>
  <div class="form-group">
    <label for="menu_type">Menu Type:</label>
    <input type="text" class="form-control" id="menu_type" name="menu_type">
  </div>
  <div class="form-group">
   <label for="menu_image">Menu Image:</label><br>
  <input type="file" name="fileToUpload" id="fileToUpload">
  </div>
  <div class="form-group">
    <label for="is_active">Is Active:</label><br>
    <input type="radio" id="is_active" name="is_active" value="Y">
    <label for="Y">Yes</label><br>
	
    <input type="radio" id="is_active" name="is_active" value="N">
    <label for="N">No</label><br>
  </div>
   
  <button type="submit" class="btn btn-default" id ="submitbutton">Submit</button>
</form>


  </div>
</div>
</div>