<?php

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Are You Owner Section';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
?>

<!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?=$relativeHomeUrl;?>reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">ARE YOU OWNER SECTIONS</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>VIEW ARE YOU OWNER SECTION</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Are You Owner Section Image Alt Text</th>
        <th>Are You Owner Section Image Title Text</th>
        <th>Are You Owner Section Text</th>
		 <th>Are You Owner Section Title</th>
		<th>Are You Owner Added At</th>
		<th>action</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($dataFromViewAreYouOwnerSection as $res)
	
	{?>
	
	
      <tr>
        <td><?= $res['are_u_owner_section_id'] ?></td>
		<td><?= $res['are_u_owner_section_image_alt_text'] ?></td>
        <td><?= $res['are_u_owner_section_image_title_text'] ?></td>
        <td><?= $res['are_u_owner_section_text'] ?></td>
		<td><?= $res['are_u_owner_section_title'] ?></td>
		<td><?= $res['are_u_owner_added_at'] ?></td>
		<td><a href="<?=$relativeHomeUrl;?>am/edit-are-you-owner-section?rec_id=<?= $res['are_u_owner_section_id']; ?>">Edit</a></td>
		 <td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteRow('<?= $res['are_u_owner_section_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
		 </td>

	
       </tr>
	<?php } ?>

    </tbody>
  </table>
  <input type="hidden" name="deleteRowId" id="deleteRowId" />
  <input type="hidden" name="homeUrl" id="homeUrl" value=<?= $relativeHomeUrl; ?> />
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
	  </div>
	  <!-- /.container-fluid-->
   	</div>
<!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Are you really want to delete.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="button" id="confirmDeleteRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
