<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Are You Owner Section';
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
        <li class="breadcrumb-item active">Are You Owner Section</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Are You Owner Section</h2>
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
		   <label for="are_u_owner_section_image_path">Are U Owner Section Image Path:</label><br>
		   <input type="file" name="are_u_owner_section_image_path" id="are_u_owner_section_image_path">
		   <div>
			Image size: 1600*1200
		   </div>
		   <div class="invalid-feedback" id="are_u_owner_section_image_path_validation">
			  Please enter Are U Owner Section Image Path
		   </div>
		   <div class="invalid-feedback" id="owner_section_image_extension_validation">
			 Please upload file with extension .jpeg/.jpg/.png only
		   </div>
		  </div>
    </div>

    <div class="col-md-6">
		 <div class="form-group">
			<label for="are_u_owner_section_image_alt_text">Are U Owner Section Image Alt Text:</label>
			<input type="txt" class="form-control" id="are_u_owner_section_image_alt_text" name="are_u_owner_section_image_alt_text">
			<div class="invalid-feedback" id="are_u_owner_section_image_alt_text_validation">
				Please enter Are U Owner Section Image Alt Text
			</div>
		  </div>
    </div>
 
    <div class="col-md-6">
		 <div class="form-group">
			<label for="are_u_owner_section_image_title_text">Are U Owner Section Image Title Text:</label>
			<input type="text" class="form-control" id="are_u_owner_section_image_title_text" name="are_u_owner_section_image_title_text">
			<div class="invalid-feedback" id="are_u_owner_section_image_title_text_validation">
				Please enter Are U Owner Section Image Title Text
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="are_u_owner_section_text">Are U Owner Section Text:</label>
			<input type="text" class="form-control" id="are_u_owner_section_text" name="are_u_owner_section_text">
			<div class="invalid-feedback" id="are_u_owner_section_text_validation">
				Please enter Are U Owner Section Text
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
		 <div class="form-group">
			<label for="are_u_owner_section_title">Are U Owner Section Title:</label>
			<input type="text" class="form-control" id="are_u_owner_section_title" name="are_u_owner_section_title">
			<div class="invalid-feedback" id="are_u_owner_section_title_validation">
				Please enter Are U Owner Section Title
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

   <button type="submit" class="btn btn-default btn_1 medium" id = "submitbuttonowneradd">submit</button>
   <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-are-you-owner-section'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

</form>
</div>
</div>
</div>

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>

