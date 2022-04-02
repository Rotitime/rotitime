<?php
use yii\helpers\Url;

$relativeHomeUrl = Url::home();

/* @var $this yii\web\View */

$this->title = 'View Home Page Banner Image';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');
?>

<!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?=$relativeHomeUrl;?>reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Home Page Banner Image</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>View Home Page Banner Image</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Banner Image Alt Text</th>
        <th>Banner Image Title Text</th>
		<th>Display In Homepage</th>
		<th>Banner Image Added At</th>
		<th>action</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($dataFromViewHomePageBannerImage as $res)
	
	{?>
	
	
      <tr>
        <td><?= $res['banner_image_id'] ?></td>
		<td><?= $res['banner_image_alt_text'] ?></td>
        <td><?= $res['banner_image_title_text'] ?></td>
		<td><?= $res['display_in_homepage'] ?></td>
        <td><?= $res['banner_image_added_at'] ?></td>
		<td><a href="<?=$relativeHomeUrl;?>am/edit-home-page-banner-image?rec_id=<?= $res['banner_image_id']; ?>">Edit</a></td>
		<<td><a href="#0" class="btn_1 gray delete" onclick="fnDeleteBannerImageRow('<?= $res['banner_image_id']; ?>')"  data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a>
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
            <button class="btn btn-primary" type="button" id="confirmDeleteBannerImageRow" data-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>    

<?php
		$validation_js = $relativeHomeUrl."js/amsection.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
