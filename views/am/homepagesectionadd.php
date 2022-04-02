<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Home Page Section Add';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

if(empty($result)){
	echo $result;
}

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
        <li class="breadcrumb-item active">HOME PAGE SECTION</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>HOME PAGE SECTION ADD</h2>
        </div>
		
		
 <form method="POST" method="post" enctype="multipart/form-data">
 
 <div class="col-md-6">
  <div class="form-group">
    <label for="section_name_english ">Section Name English:</label>
    <input type="text" class="form-control" id="section_name_english" name="section_name_english">
	<div class="invalid-feedback" id="section_name_english_validation">
        Please enter Section Name English
      </div>
  </div>
  </div>
 
   <div class="col-md-6">
  <div class="form-group">
    <label for="section_name_german">Section Name German:</label>
    <input type="text" class="form-control" id="section_name_german" name="section_name_german">
	<div class="invalid-feedback" id="section_name_german_validation">
        Please enter Section Name German
      </div>
  </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
    <label for="section_title_english">Section Title English:</label>
    <input type="text" class="form-control" id="section_title_english" name="section_title_english">
	<div class="invalid-feedback" id="section_title_english_validation">
        Please enter Section Title English
      </div>
  </div>
  </div>
  
 <div class="col-md-6">
  <div class="form-group">
    <label for="section_title_german">Section Title German:</label>
    <input type="text" class="form-control" id="section_title_german" name="section_title_german">
	<div class="invalid-feedback" id="section_title_german_validation">
        Please enter Section Title German
      </div>
  </div>
  </div>
  
  <div class="col-md-6">
  <div class="form-group">
   <label for="section_image">Section Image:</label><br>
   <input type="file" name="fileToUpload" id="fileToUpload">
   <div class="invalid-feedback" id="section_image_validation">
        Please enter Section Section Image
      </div>
  </div>
  </div>

 <div class="col-md-6">
 <div class="form-group">
    <label for="section_image_alt_text_english">Section Image Alt Text English:</label>
    <input type="txt" class="form-control" id="section_image_alt_text_english" name="section_image_alt_text_english">
	<div class="invalid-feedback" id="section_image_alt_text_english_validation">
        Please enter Section Image Alt Text English
      </div>
  </div>
  </div>
 
  <div class="col-md-6">
 <div class="form-group">
    <label for="section_image_alt_text_german">Section Image Alt Text German:</label>
    <input type="text" class="form-control" id="section_image_alt_text_german" name="section_image_alt_text_german">
	<div class="invalid-feedback" id="section_image_alt_text_german_validation">
        Please enter Section Image Alt Text German
      </div>
  </div>
  </div>
 
 
  <div class="col-md-6">
  <div class="form-group">
    <label for="section_image_title_text_english">Section Image Title Text English:</label>
    <input type="text" class="form-control" id="section_image_title_text_english" name="section_image_title_text_english">
	<div class="invalid-feedback" id="section_image_title_text_english_validation">
        Please enter Section Image Title Text English
      </div>
  </div>
  </div>
 
  <div class="col-md-6">
 <div class="form-group">
    <label for="section_image_title_text_german">Section Image Title Text German:</label>
    <input type="text" class="form-control" id="section_image_title_text_german" name="section_image_title_text_german">
	<div class="invalid-feedback" id="section_image_title_text_german_validation">
        Please enter Section Image Title Text German
      </div>
  </div>
  </div>
 
  
  <div class="col-md-6">
 <div class="form-group">
    <label for="Section_sequence_number">Section Sequence Number:</label>
    <input type="number" class="form-control" id="Section_sequence_number" name="Section_sequence_number">
	<div class="invalid-feedback" id="Section_sequence_number_validation">
        Please enter Section Sequence Number
      </div>
  </div>
  </div>
 
 <div class="col-md-6">
 <div class="form-group">
    <label for="section_image_link">Section Image Link:</label>
    <input type="url" class="form-control" id="section_image_link" name="section_image_link">
	<div class="invalid-feedback" id="section_image_link_validation">
        Please enter Section Image Link
      </div>
  </div>
  </div>
  
 
   
    
  <button type="submit" class="btn btn-default btn_1 medium" id = "submitbuttonhomepageadd">submit</button>
  <a href="<?php echo Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurants'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 medium">Cancel</a>
</form>
</div>
</div>
</div>

	<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>