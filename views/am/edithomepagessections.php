<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Home Pages Sections';
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
        <li class="breadcrumb-item active">Home Pages Sections</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Edit Home Pages Sections</h2>
        </div>
		
		
 <form  method="post" enctype="multipart/form-data"  id="editHomePageForm" name="edithomepageform">
 
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
			<label for="section_name">Section Name:</label>
			<input type="text" class="form-control" id="section_name" name="section_name" value="<?= $section_name; ?>">
			<input type="hidden" name="section_name_hidden" id="section_name_hidden" value="<?= $section_name;?>">
			<div class="invalid-feedback" id="section_name_validation">
				Please enter Section Name
			  </div>
			<div class="invalid-feedback" id="section_same_name_validation">
			   Section Name Already Exist
			  </div>
		  </div>
    </div>
 
    <div class="col-md-6">
		  <div class="form-group">
			<label for="section_display_sequence_number">Section Display Sequence Number:</label>
			<input type="number" class="form-control" id="section_display_sequence_number" name="section_display_sequence_number" value="<?= $section_display_sequence_number; ?>">
			<input type="hidden" name="section_display_sequence_number_hidden" id="section_display_sequence_number_hidden" value="<?= $section_display_sequence_number;?>">
			<div class="invalid-feedback" id="section_display_sequence_number_validation">
				Please enter Section Display Sequence Number
			  </div>
		  <div class="invalid-feedback" id="section_display_same_number_validation">
			Section Display Sequence Number Already Exist
		  </div>
		  </div>
    </div>

	<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
 
  <button type="button" class="btn btn-default btn_1 medium" id = "edithomepages">submit</button>
  <a href="<?=Yii::$app->homeUrl.'/'.$controllerName.'/view-home-pages-sections'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
</form>
</div>
</div>
</div>

  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>