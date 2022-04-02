<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Grey Buttons';
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
        <li class="breadcrumb-item active">View Grey Button Section</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> View Grey Button Section</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">   
				
				<thead>
				  <tr>
					<th>S.No</th>
					<th>Grey Button Title</th>
					<th>Grey Button Type</th>
					<th>Display Sequence Number</th>
			        <th>Grey Button Added By</th>
					<th>Grey Button Added At</th>
					<th>Action</th>
					<th>Action</th>

				  </tr>
				</thead>
				<tbody>
			<?php foreach($dataFromViewGreyButtonSection as $res) {?>

				  <tr>
					<td><?= $res['grey_button_id'] ?></td>
					<td><?= $res['grey_button_title'] ?></td>
					<td><?= $res['grey_button_type'] ?></td>
					<td><?= $res['display_sequence_number'] ?></td>
					<td><?= $res['grey_button_added_by'] ?></td>
					<td><?= $res['grey_button_added_at'] ?></td>
					<td><a href="<?=$relativeHomeUrl;?>as/edit-grey-button-section?rec_id=<?= $res['grey_button_id']; ?>">Edit</a></td>
		 <td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteGreyButtonRow('<?= $res['grey_button_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
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
            <button class="btn btn-primary" type="button" id="confirmDeleteGreyButtonRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>