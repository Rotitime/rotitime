<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Edit Restaurants Menus';
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
        <li class="breadcrumb-item active">RESTAURANTS MENUS</li>
      </ol>

      <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>EDIT RESTAURANTS MENUS</h2>
        </div>
		
		
 <form  method="post" enctype="multipart/form-data" id="editMenus" name="editmenus">
 
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
			<input type="text" class="form-control" id="menu_name" name="menu_name" value="<?php echo $menu_name; ?>">
			<input type="hidden" name="menu_name_hidden" id="menu_name_hidden" value="<?php echo $menu_name;?>">
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
			<input type="text" class="form-control" id="menu_type" name="menu_type" value="<?php echo $menu_type; ?>">
			<div class="invalid-feedback" id="menu_type_validation">
				Please enter Menu Type
			</div>
		  </div>
    </div>
  
    <div class="col-md-6">
		  <div class="form-group">
		   <label for="menu_image">Menu Image:</label><br>
		   <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $menu_image;?>">
		   <input type="hidden" name="menu_image_hidden" id="menu_image_hidden" value="<?php echo $menu_image;?>">
		   <input type="hidden" name="menu_image_type" id="menu_image_type" value="edit">
		   <figure class="upload-img">
		 <img src="<?php echo 'http://zefasa.com/rotitime/web/'.$menu_image; ?>" data-src ="<?php echo 'http://zefasa.com/rotitime/web/'.$menu_image; ?>">
		 </figure>
		   <div>
			Image size: 800*600
		   </div>
          <div class="invalid-feedback" id="menu_image_validation">
           Please enter Menu Image
          </div>
        </div>
    </div>

    <div class="col-md-6">
		 <div class="form-group">
			<label for="menu_image_alt_text">Menu Image Alt Text:</label>
			<input type="txt" class="form-control" id="menu_image_alt_text" name="menu_image_alt_text" value="<?php echo $menu_image_alt_text; ?>">
		  </div>
		  </div>
		 
		  <div class="col-md-6">
		 <div class="form-group">
			<label for="menu_image_title_text">Menu Image Title Text:</label>
			<input type="text" class="form-control" id="menu_image_title_text" name="menu_image_title_text" value="<?php echo $menu_image_title_text; ?>">
		  </div>
    </div>
 
  
    <div class="col-md-6">
			<div class="form-group">
			<label for="is_active">Is Active:</label><br>
			<input type="radio" id="is_active" name="is_active" value="Y" <?php if($is_active == 'Y') { ?> checked = "checked" <?php } ?>>
			<label for="Y">Yes</label><br>

			<input type="radio" id="is_active" name="is_active" value="N" <?php if($is_active == 'N') { ?> checked = "checked" <?php } ?>>
			<label for="N">No</label><br>
		  <div class="invalid-feedback" id="is_active_validation">
				Please enter Is Active
			</div>
		  </div>
    </div>
  
 
    
  <button type="button" class="btn btn-default btn_1 medium" id ="menuedit">submit</button>
     <a href="<?php echo Yii::$app->homeUrl.'/'.$controllerName.'/view-restaurant-menus'; ?>" id="cancel" name="cancel" class="btn btn-default btn_1 gray medium">Cancel</a>

</form>
</div>
</div>
</div>

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>

