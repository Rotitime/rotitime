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
            <h2 class="d-inline-block">Order ID 12</h2>
            <div class="filter">
              <select name="orderby" class="selectbox">
                  <option value="Any status">Any status</option>
                  <option value="Approved">Approved</option>
                  <option value="Pending">Pending</option>
                  <option value="Cancelled">Cancelled</option>
              </select>
          </div>
        </div>
        <div class="list_general order">
            <ul>
                <li>
                    <figure><img src="img/item_1.jpg" alt=""></figure>
                    <h4>Da Alfredo <i class="pending">Pending</i></h4>
                    <ul class="booking_list">
                        <li><strong>Client</strong> Mark Twain</li>
                        <li><strong>Date and time</strong> 5 November 2020 08.30pm</li>
                        <li><strong>Address</strong> Barda Bonilla 24 apt. 10, 2414 London</li>
                        <li><strong>Client Contacts</strong> <a href="#0">98432983242</a> - <a href="#0">mark@hotmail.com</a></li>
                        <li><strong>Payment</strong> Paied via Paypal</li>
                        <li><strong>Withdrawal</strong> Delivery</li>
                    </ul>
                    <p><a href="#0" class="btn_1" data-toggle="modal" data-target="#client_detail_modal"><i class="fa fa-fw fa-envelope"></i> Edit client detail</a></p>
                    <ul class="buttons">
                        <li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Confirm</a></li>
                        <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <hr>
        <h5>Order detail</h5>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Options</th>
                        <th>Edit</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>45</td>
                        <td>Enchiladas</td>
                        <td>2</td>
                        <td>Extra Tomato, Extra Pepper</td>
                        <td><a href="#0"><strong>Delete</strong></a></td>
                        <td>$12</td>
                    </tr>
                    <tr>
                        <td>48</td>
                        <td>Burrito</td>
                        <td>1</td>
                        <td>-</td>
                        <td><a href="#0"><strong>Delete</strong></a></td>
                        <td>$8</td>
                    </tr>
                    <tr>
                        <td>89</td>
                        <td>Chicken</td>
                        <td>1</td>
                        <td>-</td>
                        <td><a href="#0"><strong>Delete</strong></a></td>
                        <td>$10</td>
                    </tr>
                    <tr>
                        <td>83</td>
                        <td>Cheese Cake</td>
                        <td>2</td>
                        <td>-</td>
                        <td><a href="#0"><strong>Delete</strong></a></td>
                        <td>$20</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end total_order">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <ul>
                    <li>
                        <span>Subtotal</span> $40.00
                    </li>
                    <li>
                        <span>Delivery Fee</span> $7.00
                    </li>
                    <li>
                        <span>Total</span> $47.00
                    </li>
                </ul>
                <a href="#0" class="btn_1 full-width cart" style="width: 100%; text-align: center;">Place Order</a>
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
