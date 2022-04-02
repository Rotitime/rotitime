<?php

/* @var $this yii\web\View */

$this->title = 'Customer Reviwes';
$this->registerJsFile('js/jquery-3.4.1.min.js');
if(!empty($error)){
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
        <li class="breadcrumb-item active">Customer Reviews</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Insert</h2>
        </div>
 
 <form method="POST" method="post" enctype="multipart/form-data">
 
 <div class="col-md-6">
  <div class="form-group">
    <label for="reviewer_first_name">reviewer first name:</label>
    <input type="text" class="form-control" id="reviewer_first_name" name="reviewer_first_name" value="<?php echo $reviewer_first_name; ?>">
  </div>
  </div>
 
   <div class="col-md-6">
  <div class="form-group">
    <label for="reviewer_last_name">reviewer last name:</label>
    <input type="text" class="form-control" id="reviewer_last_name" name="reviewer_last_name" value="<?php echo $reviewer_last_name; ?>">
  </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
    <label for="reviewer_sur_name">reviewer sur name:</label>
    <input type="text" class="form-control" id="reviewer_sur_name" name="reviewer_sur_name" value="<?php echo $reviewer_sur_name; ?>">
  </div>
  </div>
  
 <div class="col-md-6">
  <div class="form-group">
    <label for="reviewed_text">reviewed text:</label>
    <input type="text" class="form-control" id="reviewed_text" name="reviewed_text" value="<?php echo $reviewed_text; ?>">
  </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
   <label for="reviewed_dish">reviewed dish:</label><br>
   <input type="text" class="form-control" id="reviewed_dish" name="reviewed_dish" value="<?php echo $reviewed_dish; ?>">
  </div>
  </div>
 

    <div class="col-md-6">
    <div class="form-group">
    <label for="is_review_approved">is review approved:</label><br>
    <input type="radio" id="is_active" name="is_review_approved" value="Y" <?php if($is_restaurant_premium == 'Y') { ?> checked = "checked" <?php } ?>>
    <label for="Y">Yes</label><br>

    <input type="radio" id="is_active1" name="is_review_approved" value="N" <?php if($is_restaurant_premium == 'N') { ?> checked = "checked" <?php } ?>>
    <label for="N">No</label><br>
  </div>
  </div>
  
  
 <button type="submit" class="btn btn-default btn_1 medium" id = "submitbutton">submit</button></form>
</div>
</div>
</div>


