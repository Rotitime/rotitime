<<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Are You Owner Section';
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
        <li class="breadcrumb-item active">ARE YOU OWNER SECTION</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>EDIT ARE YOU OWNER SECTION</h2>
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
		<input type="file" name="fileToUpload" id="fileToUpload" value="<?= $are_u_owner_section_image_path;?>">
		<input type="hidden" name="are_u_owner_section_image_path_hidden" id="are_u_owner_section_image_path_hidden" value="<?= $are_u_owner_section_image_path;?>">
		<input type="hidden" name="owner_type" id="owner_type" value="edit">
		<figure>
		<img src="<?= 'http://zefasa.com/rotitime/web/'.$are_u_owner_section_image_path; ?>" data-src ="<?= 'http://zefasa.com/rotitime/web/'.$are_u_owner_section_image_path; ?>">
		</figure>
		<div class="invalid-feedback" id="are_u_owner_section_image_path_validation">
			Please enter Are U Owner Section Image Path
		  </div>
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="are_u_owner_section_image_alt_text">Are U Owner Section Image Alt Text:</label>
		<input type="txt" class="form-control" id="are_u_owner_section_image_alt_text" name="are_u_owner_section_image_alt_text" value="<?= $are_u_owner_section_image_alt_text; ?>">
		<div class="invalid-feedback" id="are_u_owner_section_image_alt_text_validation">
			Please enter Are U Owner Section Image Alt Text 
		  </div>
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="are_u_owner_section_image_title_text">Are U Owner Section Image Title Text:</label>
		<input type="text" class="form-control" id="are_u_owner_section_image_title_text" name="are_u_owner_section_image_title_text" value="<?= $are_u_owner_section_image_title_text; ?>">
		<div class="invalid-feedback" id="are_u_owner_section_image_title_text_validation">
			Please enter Are U Owner Section Image Title Text 
		  </div>
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="are_u_owner_section_text">Are U Owner Section Text:</label>
		<input type="text" class="form-control" id="are_u_owner_section_text" name="are_u_owner_section_text" value="<?= $are_u_owner_section_text; ?>">
		<div class="invalid-feedback" id="are_u_owner_section_text_validation">
			Please enter Are U Owner Section Text 
		  </div>
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<label for="are_u_owner_section_title">Are U Owner Section Text:</label>
		<input type="text" class="form-control" id="are_u_owner_section_title" name="are_u_owner_section_title" value="<?= $are_u_owner_section_title; ?>">
		<div class="invalid-feedback" id="are_u_owner_section_title_validation">
			Please enter Are U Owner Section Title
		  </div>
		</div>
		</div>
		<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
		<button type="submit" class="btn btn-default btn_1 medium" id = "submitbuttonowneradd">submit</button>
		<a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-are-you-owner-section'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 medium">Cancel</a>

</form>
</div>
</div>
</div>

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>



