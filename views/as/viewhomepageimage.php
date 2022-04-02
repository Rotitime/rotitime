<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Home Page Image';
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
        <li class="breadcrumb-item active">View Home Page Image</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>View Home Page Image</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">   
				
				<thead>
				  <tr>
					<th>S.No</th>
					<th>Section Image Text</th>
					<th>Section Image Sequence Number</th>
					<th>Section Name</th>
			        <th>Section Category</th>
					<th>Section Image Added On</th>
					<th>Action</th>
					<th>Action</th>

				  </tr>
				</thead>
				<tbody>
			<?php 
			$i = 1;
			foreach($dataFromViewHomePageImageSection as $res) {?>

				  <tr>
					<td><?= $i; ?></td>
					<td><?= $res['section_image_text']; ?></td>
					<td><?= $res['section_image_sequence_number']; ?></td>
					<td><?php if(!empty($displayHomePageImageName[$res['section_id']])) echo $displayHomePageImageName[$res['section_id']]; ?></td>
					<td><?= $res['section_category']; ?></td>
					<td><?= $res['section_image_added_on']; ?></td>
					<td><a href="<?=$relativeHomeUrl;?>as/edit-home-page-image?rec_id=<?=$res['section_image_id']; ?>">Edit</a></td>
		 <td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteHomePageSectionImageRow('<?= $res['section_image_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
		 </td>					 


			 </tr>
			<?php 
			$i++;
			} ?>
			  
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
            <button class="btn btn-primary" type="button" id="confirmDeleteHomePageSectionRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>