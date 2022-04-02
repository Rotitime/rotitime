<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Reviews';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
?>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://zefasa.com/rotitime/web/reports/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Reviews</li>
      </ol>

      		<!-- Example DataTables Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> Orders Table Example</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reviewer Email</th>
                      <th>Reviewer Name</th>
                      <th>Reviewed Restaurant</th>
                      <th>Ratings</th>
                      <th>Title</th>
                      <th>Review</th>
                      <th>Review Type</th>
                      <th>Reviewed Time</th>
                      <th>Is Approve</th>
                    </tr>
                  </thead>
                  <tbody>
            <?php   $i  = 1;
                    foreach($reviewsWithDuration as $res) { ?>
                    <tr>
                      <td><?= $i; ?></td>
                      <td><?= $res['reviewer_email']; ?></td>
                      <td><?= $res['reviewer_name']; ?></td>
 					  <td><?= $res['reviewed_restaurant_id']; ?></td>
                      <td><?= $res['tap_to_rate_your_experience'];?></td>
                      <td><?= $res['review_title'];?></td>
                      <td><?= $res['your_review']; ?></td>
                      <td><?= $res['review_type']; ?></td>
                      <td><?= $res['reviewed_on']; ?></td>
                      <td><div>
                        <select class="selectreviews" id="approve_reviews_<?=$res['review_id'];?>" name="approve_reviews_<?=$res['review_id'];?>" onchange="reviewsApprove('<?=$res['review_id'];?>')" >
                            <option value="pending" <?php if ($res['is_review_approved'] == '-') { ?>  selected="selected" <?php } ?> >Pending</option>
                            <option value="approved" <?php if ($res['is_review_approved'] == 'Y') { ?>  selected="selected" <?php } ?>>Approved</option>
                            <option value="cancelled" <?php if ($res['is_review_approved'] == 'N') { ?>  selected="selected" <?php } ?>>Not Approve</option>  
                    </select>
          </div></td>
                    </tr>
            <?php 
                    $i++;
            } ?>

                  </tbody>
                </table>
                <input type="hidden" id="homeUrl" name="homeUrl" value="<?=$relativeHomeUrl;?>" />
              </div>
            </div>
          </div>
	  </div>
	  <!-- /.container-fluid-->
   	</div>
    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © RotiTime 2019</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
	<?php
		$validation_js = $relativeHomeUrl."js/reports.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
