<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Restaurants Gallery';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;

?>



	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Restaurants Gallery</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Edit Restaurants Gallery</h2>
        </div>
			  
			  <form  method="post" enctype="multipart/form-data" id="editRestaurantGalleryForm" name="editrestaurantgalleryform">
			  
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
    <label for="restaurant_name">Restaurant Name:<?=$restaurant_name;?></label>
	<select id="restaurant_id" class="form-control"  name="restaurant_id">
		<option value=''>Select Restaurant</option>
		<?php foreach($loggedInOwnerRestaurants as $res) { ?>
		<option <?php if($resultRestaurantImage[0]['restaurant_id'] == $res['restaurant_id']) { ?> selected = 'selected' <?php } ?> value='<?= $res['restaurant_id']; ?>'><?= $res['restaurant_name']; ?></option>
		<?php } ?>
	</select>

	<div class="invalid-feedback" id="restaurant_name_valids">
        Please Select Restaurant Name
      </div>
  </div>
  </div>
				

	<div class="col-md-6">
		<?php foreach($resultRestaurantImage as $res) { ?>
		<div id="inputFormImage">
		   <label for="restaurants_gallery_image">Restaurants Gallery Image:</label><br>
		   <input type="file" name="files[]" id="files" multiple value="<?=$res['restaurants_gallery_image']; ?>">
		   <input type="hidden" name="restaurants_gallery_image_hidden" id="restaurants_gallery_image_hidden" value="<?= $restaurants_gallery_image;?>">
		   <input type="hidden" name="gallery_image_type" id="gallery_image_type" value="edit">
		   <figure class="upload-img">
			<img src="<?= $relativeHomeUrl.$res['restaurants_gallery_image']; ?>" data-src =<?= $relativeHomeUrl.$res['restaurants_gallery_image']; ?> >
		   </figure>
		<div class="input-group-append">                
		    <button id="removeImage" onclick="fnDeleteRowGallery('<?= $res['restaurants_gallery_id']; ?>')" type="button" style="padding: .75rem .75rem;" class="btn btn-danger">Remove Image</button>
		</div>
		  <div class="invalid-feedback" id="restaurants_gallery_image_validation">
			Please Upload Restaurant Gallery Images
		  </div>
		  <div class="invalid-feedback" id="gallery_image_extension_validation">
		    Please upload file with extension .jpeg/.jpg/.png only.
		  </div>
		  <div>
			Image size: 800*450
		   </div>		   
		</div>
	   <?php } ?>
			
	</div>
    <input type="hidden" name="homeUrl" id="homeUrl" value="<?=$relativeHomeUrl;?>">

	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
	<div class="col-md-6" style="padding-top: 20px;">
	<button type="submit" class="btn btn-default btn_1 medium" id = "submitbuttoneditgallery">submit</button>
   <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurants-gallery'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

	</form>
	</div>
	</div>
    </div>
	</div>
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>