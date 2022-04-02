<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'View Restaurants';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$controllerName = Yii::$app->controller->id;
?>

  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Orders</li>
      </ol>

      <div class="box_general pb-3">
        <div class="header_box">
            <h2 class="d-inline-block"><?=$orderSummary['order_number'];?></h2>
            <!--<div class="filter">
              <select name="orderby" class="selectbox">
                  <option value="Any status">Any status</option>
                  <option value="Approved">Approved</option>
                  <option value="Pending">Pending</option>
                  <option value="Cancelled">Cancelled</option>
              </select>
          </div> -->
        </div>
        <div class="list_general order">
            <ul>
                <li>
                    <figure><img src="img/item_1.jpg" alt=""></figure>
                    <h4><?=$dataFromAddressRestaurant['restaurant_name'];?> <!--<i class="pending">Pending</i>--></h4>
                    <ul class="booking_list">
                        <li><strong>Client</strong> <?=$userInfo['user_name'];?></li>
                        <li><strong>Date and time</strong> <?=$orderSummary['ordered_at'];?></li>
                        <li><strong>Address</strong> <?=$orderSummary['customer_address'];?></li>
                        <li><strong>Client Contacts</strong> <a href="#0"><?=$orderSummary['customer_phone_number'];?></a> - <a href="#0"><?=$userInfo['user_email'];?></a></li>
                    </ul>
                    <!--<p><a href="#0" class="btn_1" data-toggle="modal" data-target="#client_detail_modal"><i class="fa fa-fw fa-envelope"></i> Edit client detail</a></p>
                    <ul class="buttons">
                        <li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Confirm</a></li>
                        <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li>
                    </ul>-->
                </li>
            </ul>
        </div>
        <hr>
        <h5>Order detail</h5>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Dish Name</th>
                        <th>Quantity</th>
                        <th>Subliments</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1; 
                foreach($orderDetailsSummary as $res) { ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$res['dish_name'];?></td>
                        <td><?= $res['dish_quantity'];?></td>
                        <td><?=!empty($displaySuplimentsArr[$res['dish_id']])?substr($displaySuplimentsArr[$res['dish_id']],2):"";?></td>
                        <td>€<?= $res['dish_price']*$res['dish_quantity'];?></td>
                    </tr>
                    <?php 
                    $i++;
                } ?> 
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end total_order">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <ul>
                    <li>
                        <span>Subtotal</span> €<?=$orderSummary['order_sub_total']?>
                    </li>
                    <li>
                        <span>Delivery Fee</span> €<?=$orderSummary['order_delivery_charges']?>
                    </li>
                    <li>
                        <span>Total</span> €<?=$orderSummary['order_price']?>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /total_order-->
    </div>
    <!-- /box_general-->
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

    <!-- Client Detail Modal -->
    <div class="modal fade" id="client_detail_modal" tabindex="-1" role="dialog" aria-labelledby="client_detail_modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="client_detail_modalLabel">Edit client detail</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" value="Mark Twain">
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Date</label>
                              <input type="text" class="form-control" value="5 November 2020">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Time</label>
                              <input type="text" class="form-control" value="08.30pm">
                          </div>
                      </div>
                  </div>
                  <!-- /Row -->
                  <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" value="Barda Bonilla 24 apt. 10, 2414 London">
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Telephone</label>
                              <input type="text" class="form-control" value="98432983242">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" value="mark@hotmail.com">
                          </div>
                      </div>
                  </div>
                  <!-- /Row -->
                  <div class="form-group">
                      <label>Payment method</label>
                      <div class="styled-select">
                          <select>
                              <option selected="">Paypal</option>
                              <option>Credit Card</option>
                              <option>Cash</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Withdrawal method</label>
                      <div class="styled-select">
                          <select>
                              <option selected="">Delivery</option>
                              <option>Take Away</option>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <a class="btn btn-primary" href="login.html">Save</a>
              </div>
          </div>
      </div>
  </div>    
	<?php
		$validation_js = $relativeHomeUrl."js/asjava.js?" . rand(1, 1000);
		$this->registerJsFile($validation_js);
	?>
