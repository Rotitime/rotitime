<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Add Restaurants Menus';
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
        <li class="breadcrumb-item active">Restaurants Menus</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Add Restaurants Menus</h2>
        </div>
		
	<div class="row">
			<?= $this->render('add_restaurant_steps', [
									   
									]
								); ?>		
		
		
 <form method="post" id="menuformAdd" name="menuformAdd" enctype="multipart/form-data">
 
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
			  <div class="form-group">
				<label for="menu_name">Menu Name:</label>
				<input type="text" class="form-control" id="menu_name" name="menu_name">
				<div class="invalid-feedback" id="menu_name_validation">
					Please enter Menu Name
				</div>
				<div class="invalid-feedback" id="menu_same_name_validation">
				   Menu Name Already Exist
				</div>
			  </div>
    </div>
 
    <div class="col-md-6">
		  <div class="form-group">
			<label for="menu_type">Menu Type:</label>
			<input type="text" class="form-control" id="menu_type" name="menu_type">
			<div class="invalid-feedback" id="menu_type_validation">
				Please enter Menu Type
			</div>
		  </div>
    </div>
	
  
    <div class="col-md-6">
		  <div class="form-group">
		   <label for="menu_image">Menu Image:</label><br>
		   <input type="file" name="menu_image" id="menu_image">
		  <div>
			Image size: 800*600
		   </div>
		   <div class="invalid-feedback" id="menu_image_validation">
				Please enter Menu Image
			</div>
		   <div class="invalid-feedback" id="menu_image_extension_validation">
			 Please upload file with extension .jpeg/.jpg/.png only
		   </div>
		  </div>
    </div>

    <div class="col-md-6">
		 <div class="form-group">
			<label for="menu_image_alt_text">Menu Image Alt Text:</label>
			<input type="txt" class="form-control" id="menu_image_alt_text" name="menu_image_alt_text">
		  </div>
    </div>
		 
	<div class="col-md-6">
		 <div class="form-group">
			<label for="menu_image_title_text">Menu Image Title Text:</label>
			<input type="text" class="form-control" id="menu_image_title_text" name="menu_image_title_text">
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
			<label for="menu_display_sequence_number">Menu Display Sequence Number:</label>
			<input type="number" class="form-control" id="menu_display_sequence_number" name="menu_display_sequence_number">
			<input type="hidden" name="menu_display_sequence_number_hidden" id="menu_display_sequence_number_hidden" value="<?= $menu_display_sequence_number;?>">
			<div class="invalid-feedback" id="menu_display_sequence_number_validation">
				Please enter Menu Display Sequence Number
			  </div>
		  <div class="invalid-feedback" id="menu_display_sequence_same_number_validation">
			Menu Display Sequence Number Already Exist
		  </div>
		  </div>
    </div>
  
  
  <input type="hidden" name="addType" id="addType" value="">
 
	 <input id="form-token-do" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>"/>
    
   <button type="button" class="btn btn-default btn_1 medium submitbuttonmenu" id="addOne" value="addOne">Add Menu to Restaurant</button>
  <button type="button" class="btn btn-default btn_1 medium submitbuttonmenu" id="addMultiple" value="addMultiple">Add another Menu in the Same Restaurant</button>
     <a href="<?= Yii::$app->homeUrl.'/'.$controllerName.'/add-restaurant-menus'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />

</form>
</div>
</div>
</div>
</div>

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>

