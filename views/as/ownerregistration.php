<?php

/* @var $this yii\web\View */

$this->title = 'Restaurant Owner Page';
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
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Register Owner</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Register Owner</h2>
        </div>
			  
			  <form  method="post">
			     <div class="col-md-6">
			  <div class="form-group">
				<label for="owner_email">Owner Email:</label>
				<input type="email" class="form-control" id="owner_email" name="owner_email">
			  </div>
			  </div>
			  
			     <div class="col-md-6">
			  <div class="form-group">
				<label for="owner_first_name">Owner First Name:</label>
				<input type="text" class="form-control" id="owner_first_name" name="owner_first_name">
			  </div>
			  </div>

			     <div class="col-md-6">
			  <div class="form-group">
				<label for="owner_last_name">Owner Last Name:</label>
				<input type="text" class="form-control" id="owner_last_name" name="owner_last_name">
			  </div>
		     </div>

			     <div class="col-md-6">
			   <div class="form-group">
				<label for="password_encrypted">Password:</label>
				<input type="password" class="form-control" id="password_encrypted" name="password_encrypted">
			  </div>
			  </div>
		  
			     <div class="col-md-6">
			   <div class="form-group">
				<label for="re_enter_password_encrypted">Re Enter Password:</label>
				<input type="password" class="form-control" id="re_enter_password_encrypted" name="re_enter_password_encrypted">
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
				<label for="owner_note">Owner Note:</label>
				<input type="text" class="form-control" id="owner_note" name="owner_note">
			  </div>
			  </div>

			   
				 <button type="submit" class="btn btn-default btn_1 medium"id ="submitbutton">Submit</button>
			  </form>

			  </div>
			     </div>
				 </div>