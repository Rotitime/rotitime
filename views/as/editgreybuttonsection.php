<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Grey Buttons';
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
        <li class="breadcrumb-item active">Grey Button Section</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Edit Grey Button Section</h2>
        </div>
			  
			  <form  method="post" id="editGreyButtonForm" name="editGreyButton">
			  
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
				<label for="grey_button_title">Grey Button Title:</label>
				<input type="text" class="form-control" id="grey_button_title" name="grey_button_title" value="<?= $grey_button_title; ?>">
				  <div class="invalid-feedback" id="grey_button_title_validation">
					Please enter Grey Button Title
				  </div>
			  </div>
			  </div>
			  
			 <div class="col-md-6">
			   <div class="form-group">
			   <label for="grey_button_type">Grey Button Type:</label>
			   <div class="styled-select">
								<select id="grey_button_type" name="grey_button_type" value="<?= $grey_button_type; ?>">
									<option value=''>Grey Button Type</option>
							<option <?php if($grey_button_type == 'dish name') { ?> selected = 'selected' <?php } ?> value='dish name'>Dish Name</option>
							<option <?php if($grey_button_type == 'dish type ') { ?> selected = 'selected' <?php } ?> value='dish type '>Dish Type </option>
							<option <?php if($grey_button_type == 'dish category') { ?> selected = 'selected' <?php } ?> value='dish category'>Dish Category</option>
							<option <?php if($grey_button_type == 'halal') { ?> selected = 'selected' <?php } ?> value='halal'>Halal</option>
								</select>
							</div>
		    <div class="invalid-feedback" id="grey_button_type_validation">
				   Please enter Grey Button Type
			</div>					
		    </div>
            </div>
			  
			     <div class="col-md-6">
			  <div class="form-group">
				<label for="display_sequence_number">Display Sequence Number:</label>
			<input type="number" class="form-control" min="1" max="99" required    id="display_sequence_number" name="display_sequence_number" value="<?= $display_sequence_number;?>">
		        <input type="hidden" name="display_sequence_number_hidden" id="display_sequence_number_hidden" value="<?= $display_sequence_number;?>">
				 <div class="invalid-feedback" id="display_sequence_number_validation">
				   Please enter Display Sequence Number
				 </div>
				<div class="invalid-feedback" id="sequence_number_validation">
				Display Sequence Number Already Exist
				</div>
				<div class="invalid-feedback" id="sequence_number_greaterthan">
				Sequence Number shoulb be greater than zero
				</div>
			  </div>
		     </div>

			 <input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>

				 <button type="button" class="btn btn-default btn_1 medium" id ="editgreybutton">Submit</button>
               <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-grey-button-section'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

			  </form>

			  </div>
			  </div>
			  </div>
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>				 
