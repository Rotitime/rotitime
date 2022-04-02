<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Home Page Section Banner Image';
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
        <li class="breadcrumb-item active">Home Page Section Banner Image</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Home Page Section Banner Image</h2>
        </div>
		
		
 <form method="post" enctype="multipart/form-data">
 
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
		   <label for="banner_image_path">Banner Image Path:</label><br>
		   <input type="file" name="banner_image_path" id="banner_image_path">
		   <div>
			Image size: 1600*1200
		   </div>
		    <div class="invalid-feedback" id="banner_image_path_validation">
				Please enter Banner Image Path
		    </div>
		  <div class="invalid-feedback" id="banner_image_extension_validation">
			Please upload file with extension .jpeg/.jpg/.png only
		  </div>
		  </div>
    </div>

    <div class="col-md-6">
		 <div class="form-group">
			<label for="banner_image_alt_text">Banner Image Alt Text:</label>
			<input type="txt" class="form-control" id="banner_image_alt_text" name="banner_image_alt_text">
			<div class="invalid-feedback" id="banner_image_alt_text_validation">
				Please enter Banner Image Alt Text
			  </div>
		  </div>
    </div>
 
    <div class="col-md-6">
		<div class="form-group">
			<label for="banner_image_title_text	">Banner Image Title Text:</label>
			<input type="text" class="form-control" id="banner_image_title_text" name="banner_image_title_text">
			<div class="invalid-feedback" id="banner_image_title_text_validation">
				Please enter Banner Image Title Text
			  </div>
		</div>
    </div>
  
  
    <div class="col-md-6">
			<div class="form-group">
			<label for="display_in_homepage">Display In Homepage:</label><br>
			<input type="radio" id="display_in_homepage" name="display_in_homepage" value="Y">
			<label for="Y">Yes</label><br>

			<input type="radio" id="display_in_homepage" name="display_in_homepage" value="N">
			<label for="N">No</label><br>
			<div class="invalid-feedback" id="display_in_homepage_validation">
				Please enter Display In Homepage
			</div>
		  </div>
    </div>
	
  	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>  

   <button type="submit" class="btn btn-default btn_1 medium" id = "submitbuttonbanneradd">submit</button>
   <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-home-page-banner-image'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
</form>
</div>
</div>
</div>

     <?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
