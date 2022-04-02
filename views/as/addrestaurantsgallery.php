<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurants Gallery';
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
        <li class="breadcrumb-item active">Add Restaurants Gallery</li>
      </ol>

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Restaurants Gallery</h2>
        </div>
		
		<div class="row">
			<?= $this->render('add_restaurant_steps', [
									   
									]
		    ); ?>	
			<form  method="post" enctype="multipart/form-data" id="addRestaurantGalleryForm" name="addRestaurantGalleryForm">
			  
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

		 <?= $this->render('logged_in_user_restaurants', [
                               "restaurant_id" => $restaurant_id,
                            ]
                        ); ?>
						
		<div class="col-md-6">
			<div id="inputFormRow">
			<label for="restaurants_gallery_image">Restaurant Gallery Images:</label>
				<div class="input-group mb-3">
					<input type="file" id="files" name="files[]"  multiple >
				</div>
			  <div class="invalid-feedback" id="restaurants_gallery_image_validation">
				Please Upload Restaurant Gallery Images
			  </div>
				<div>
					Image size: 800*450
				</div>
			</div>
			
		    <div id="newImage"></div>
        </div>

				<input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
				<div class="col-md-6" style="padding-top:8px;">
					<button type="button" class="btn btn-default btn_1 medium" id ="submitbuttongallery">Submit</button>
					<a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurants-gallery'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
				</div>
			</form>

			</div>
        </div>
	</div>
    </div>							
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>