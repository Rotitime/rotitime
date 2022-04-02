<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add CMS Page';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');



$editor_css = $relativeHomeUrl."admin_section/js/editor/summernote-bs4.css?" . rand(1, 1000);
$this->registerCssFile($editor_css);


$controllerName = Yii::$app->controller->id;

?>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">CMS Page</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add CMS Page</h2>
        </div>
		
		
 <form  method="post" id="addCms" name="addcms" enctype="multipart/form-data">
 
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
 
    <div class="col-md-12">
		  <div class="form-group">
			<label for="page_name">Page Name:</label>
			<input type="text" class="form-control" id="page_name" name="page_name">
			<div class="invalid-feedback" id="page_name_validation">
				Please enter Page Name
			  </div>
		  </div>
    </div>
  
 
    <div class="col-md-12">
		  <div class="form-group">
			<label for="page_content">Page Content:</label>
			<textarea class="form-control editor" id="page_content" name="page_content"></textarea>
			<div class="invalid-feedback" id="page_content_validation">
				Please enter  Page Content
			  </div>
		  </div>
    </div>
	
    <div class="col-md-6">
			<div class="form-group">
			<label for="is_active">Is Active:</label><br>
			<input type="radio" id="is_active" name="is_active" value="Y">
			<label for="Y">Yes</label><br>

			<input type="radio" id="is_active" name="is_active" value="N">
			<label for="N">No</label><br>
			<div class="invalid-feedback" id="is_active_validation">
				Please enter Is Active
			</div>
		  </div>
    </div>

    <div class="col-md-6">
			<div class="form-group">
			<label for="is_display_in_footer">Is Display In Footer:</label><br>
			<input type="radio" id="is_display_in_footer" name="is_display_in_footer" value="Y">
			<label for="Y">Yes</label><br>

			<input type="radio" id="is_display_in_footer" name="is_display_in_footer" value="N">
			<label for="N">No</label><br>
			<div class="invalid-feedback" id="is_display_in_footer_validation">
				Please enter Is Display In Footer
			</div>
		  </div>
    </div>

	<div class="col-md-6">
		  <div class="form-group">
			<label for="display_sequence_number"> Display Sequence Number:</label>
			<input type="number" class="form-control" id="display_sequence_number" name="display_sequence_number">
			<input type="hidden" name="display_sequence_number_hidden" id="display_sequence_number_hidden" value="<?= $display_sequence_number;?>">
			<div class="invalid-feedback" id="display_sequence_number_validation">
			Please enter Display Sequence Number
			  </div>
		  <div class="invalid-feedback" id="display_sequence_same_number_validation">
		    Display Sequence Number Already Exist
		  </div>
		  </div>
    </div>
 
 	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>

  <button type="button" class="btn btn-default btn_1 medium" id="submitbuttoncms">submit</button>
  <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-cms-page'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
</form>
</div>
</div>
</div>

  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>