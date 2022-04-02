<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Home Page Section Image';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;


?>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Home Page Section Image</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Edit Home Page Section Image</h2>
        </div>


 <form method="POST" enctype="multipart/form-data" id="editHomePageImageForm" name="edithomepageimageform">
 
         <div class="col-md-6">
		<div class="form-group">
		<?php
		if(!empty($error)) { ?>
		<div class="alert alert-danger" role="alert">

		<?=$error;?>
		</div>
		<?php
		}
		?>
		</div>
		</div> 
 
		<div class="col-md-6">
			<div class="form-group">
				<label for="section_image">Section Image :</label><br>
				<input type="file" name="section_image" id="section_image" value="<?=$section_image;?>">
				<input type="hidden" name="section_image_hidden" id="section_image_hidden" value="<?=$section_image;?>">
				<input type="hidden" name="page_type" id="page_type" value="edit">
					<figure class="upload-img">
						<img src="<?= 'http://zefasa.com/rotitime/web/'.$section_image; ?>" data-src ="<?= 'http://zefasa.com/rotitime/web/'.$section_image; ?>">
					</figure>
				<div>
					Image size: 460*310
			    </div>
				<div class="invalid-feedback" id="section_image_validation">
				  Please enter Section Image
				</div>
			   <div class="invalid-feedback" id="section_image_extension_validation">
					Please upload file with extension .jpeg/.jpg/.png only
			   </div>
	        </div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="section_image_text">Section Image Text:</label>
		<input type="txt" class="form-control" id="section_image_text" name="section_image_text" value="<?= $section_image_text;?>">
		<div class="invalid-feedback" id="section_image_text_validation">
		Please enter Section Image Text
		</div>
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="section_image_section_id">Section Name:</label>
		<div class="styled-select">
						<select id="section_id" name="section_id">
							<option value=''>Select Section</option>
							<?php foreach($dataFromViewHomePageSections as $res) { ?>
							<option <?php if($section_id == $res['section_id']) { ?> selected = 'selected' <?php } ?> value='<?= $res['section_id']; ?>'><?= $res['section_name']; ?></option>
							<?php } ?>
						</select>
					</div>
		<div class="invalid-feedback" id="section_category_valid">
		Please select Section Name
		</div>					
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="section_image_sequence_number">Section Category:</label>
		<div class="styled-select">
						<select id="section_category" name="section_category">
							<option value=''>Select Category</option>
							<option <?php if($section_category == 'restaurant') { ?> selected = 'selected' <?php } ?> value='restaurant'>Restaurant</option>
							<option <?php if($section_category == 'dish') { ?> selected = 'selected' <?php } ?> value='dish'>Dish</option>
							<option <?php if($section_category == 'city') { ?> selected = 'selected' <?php } ?> value='city'>City</option>
							<option <?php if($section_category == 'city-dist') { ?> selected = 'selected' <?php } ?> value='city-dist'>City - Dist</option>
						</select>
					</div>
		<div class="invalid-feedback" id="section_category_validation">
		Please select Section Category
		</div>					
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="section_image_sequence_number">Section Image Sequence Number:</label>
		<input type="number" class="form-control" id="section_image_sequence_number" name="section_image_sequence_number" value="<?= $section_image_sequence_number;?>">
		<input type="hidden" name="section_image_sequence_number_hidden" id="section_image_sequence_number_hidden" value="<?= $section_image_sequence_number;?>">
		<div class="invalid-feedback" id="section_image_sequence_number_validation">
		Please select Section Image Sequence Number
		</div>
		<div class="invalid-feedback" id="section_image_same_number_validation">
		Image Sequence Number Already Exist
		</div>
		</div>
		</div>

			 <input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>

		<button type="button" class="btn btn-default btn_1 medium" id ="edithomepageimage">submit</button>
		<a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-home-page-image'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
		</form>
		</div>
		</div>
		</div>
		
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
