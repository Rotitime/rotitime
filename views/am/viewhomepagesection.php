<?php

/* @var $this yii\web\View */

$this->title = 'Roti Time';
$this->registerJsFile('js/jquery-3.4.1.min.js');
?>

<!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?=$relativeHomeUrl;?>reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">HOME PAGE SECTION</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i>VIEW HOME PAGE SECTION</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Section Name English</th>
        <th>Section Name German</th>
        <th>Section Title English</th>
        <th>Section Image</th>
		<th>Section Sequence Number</th>
        <th>Section Added By</th>
		<th>Section Image Added At</th>
		<th>action</th>
		<th>action</th>
		
      </tr>
    </thead>
    <tbody>
	<?php foreach($dataFromViewHomepageSection as $res)
	
	{?>
	
	
      <tr>
        <td><?php echo $res['section_id'] ?></td>
        <td><?php echo $res['section_name_english'] ?></td>
        <td><?php echo $res['section_name_german'] ?></td>
        <td><?php echo $res['section_title_english'] ?></td>
        <td><?php echo $res['section_image'] ?></td>
        <td><?php echo $res['section_sequence_number'] ?></td>
        <td><?php echo $res['section_added_by'] ?></td>
        <td><?php echo $res['section_image_added_at'] ?></td>
		<td><a href="<?=$relativeHomeUrl;?>am/hm-page-edit?rec_id=<?php echo $res['section_id']; ?>" target="_blank">Edit</a></td>
		 <td><a onclick="ConfirmDelete('<?php echo $res['section_id']; ?>'); " >Delete</a></td>

	
       </tr>
	<?php } ?>

    </tbody>
  </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
	  </div>
	  <!-- /.container-fluid-->
   	</div>
