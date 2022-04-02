<?php
use app\models\RtCommonMethod;
use app\models\RiCommonMethods;
use app\models\BsCommonMethods;

/* @var $this yii\web\View */

use yii\helpers\Url;

$relativeHomeUrl = Url::home();

$this->title = 'Restaurant Details Page';
$this->registerJsFile($relativeHomeUrl.'js/jquery-3.4.1.min.js');

$RtCommonMethod = new RtCommonMethod();
?>
<div class="container">
		<section class="photo-gallery">
			<div class="row magnific-gallery">
			<?php 
			print_r($dataFromRestaurantImages);
			exit;{ ?>
					<div class="col-sm-12 col-md-8">
						<a href="<?=$relativeHomeUrl?><?=$res?>" title="Photo title" data-effect="mfp-zoom-in"><img src="<?=$relativeHomeUrl?>/img/detail_2.jpg" class="img-fluid" /></a>
					</div>
					<div class="col-sm-2 blocks">
						<a href="<?=$relativeHomeUrl?>img/detail_1.jpg" title="Photo title" data-effect="mfp-zoom-in"><img src="<?=$relativeHomeUrl?>/img/detail_1.jpg" class="img-gallery"/></a>
						<a href="<?=$relativeHomeUrl?>/img/detail_3.jpg" title="Photo title" data-effect="mfp-zoom-in"><img src="<?=$relativeHomeUrl?>/img/detail_3.jpg" class="img-gallery"/></a>						
					</div>
					<div class="col-sm-2 blocks">
						<a href="<?=$relativeHomeUrl?>/img/detail_3.jpg" title="Photo title" data-effect="mfp-zoom-in"><div class="bg-btn"><p>View Gallery</p></div><img src="<?=$relativeHomeUrl?>/img/detail_3.jpg" class="img-gallery"/></a>
						<a href="<?=$relativeHomeUrl?>/img/detail_1.jpg" title="Photo title" data-effect="mfp-zoom-in"><img src="<?=$relativeHomeUrl?>/img/detail_1.jpg" class="img-gallery"/></a>
					</div>
			<?php }?>					
			</div>
		</section>
		<section>
			<div class="detail_page_head clearfix">

				<div class="title">
					<h1>Pizzeria da Alfredo</h1>
					<p>27 Old Gloucester St, 4530 London</p>
					<p><span>Opening and closing time</span><br/>
						Monday - 11:00 till 23:00<br/>
						Tuesday - 11:00 till 22:00<br/>
						Wednesday - 10:00 till 21:30<br/>
						<span class="bold">Thusrday - 10:00 till 21:30</span><br/>
						Friday - 10:00 till 21:30<br/>
						Saturday - 10:00 till 21:30<br/>
						Sunday - 10:00 till 21:30<br/>
					</p>
					<ul class="tags">
						<li><a href="#review-in-dialog" id="review-in"><i class="icon_star"></i> Add Reviews</a></li>
						<li><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="blank"><i class="icon_pin"></i> Get directions</a></li>
						<li><a href="#share-in-dialog" id="share-in"><i class="social_share"></i> &nbsp; Share</a></li>
					</ul>
					
				</div>
				<div class="rating1">
					<ul>
						<li>
							<div class="rating">
								<span class="rates">☆</span><span class="rates">☆</span><span>☆</span><span>☆</span><span>☆</span>
								<strong>4.5</strong>
							</div>							
							1080 Rotitime Reviews
						</li>
						<li>
							<div class="rating">
							<span class="rates">☆</span><span class="rates">☆</span><span>☆</span><span>☆</span><span>☆</span>
							<strong>4.5</strong>
						</div>							
						30k Google Reviews
						</li>
					</ul>
				</div>
			</div>			

		</section>
	</div>
    <!--Container-->

	<div class="container">
		<div class="row">
			<div class="col-lg-8">

				<div class="tabs_detail">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Order Online</a>
						</li>
						<li class="nav-item">
							<a id="tab-B" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
						</li>						
						<li class="nav-item">
							<a id="tab-A" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Menu</a>
						</li>
					</ul>

					<div class="tab-content" role="tablist">
						<div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
							<div class="card-header" role="tab" id="heading-A">
								<h5>
									<a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
										Order Online
									</a>
								</h5>
							</div>
							<div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
								<div class="card-body info_content">
									
										<table class="table table-striped cart-list">
											<thead>
												<tr>
													<th>
														Main Courses
													</th>
													<th>
														 &nbsp;
													</th>
												</tr>
											</thead>
										<tbody>
										<tr>
											<td class="d-md-flex align-items-center">
												<div class="flex-md-column">
													<h4>Cheese Quesadilla</h4>
													<p>
														Fuisset mentitum deleniti sit ea.
													</p>
													<strong>$12.00</strong>
												</div>
											</td>
											<td class="options">
												<input type="number" value="100" min="0" max="100" step="1"/>
											</td>
										</tr>
										<tr>
											<td class="d-md-flex align-items-center">
												<div class="flex-md-column">
													<h4>Cheese Quesadilla</h4>
													<p>
														Fuisset mentitum deleniti sit ea.
													</p>
													<strong>$12.00</strong>
												</div>
											</td>
											<td class="options">
												<input type="number" value="100" min="0" max="100" step="1"/>
											</td>
										</tr>
										<tr>
											<td class="d-md-flex align-items-center">
												<div class="flex-md-column">
													<h4>Cheese Quesadilla</h4>
													<p>
														Fuisset mentitum deleniti sit ea.
													</p>
													<strong>$12.00</strong>
												</div>
											</td>
											<td class="options">
												<input type="number" value="100" min="0" max="100" step="1"/>
											</td>
										</tr>																				

										</tbody>
										</table>

										<table class="table table-striped cart-list">
											<thead>
												<tr>
													<th>
														Desserts
													</th>
													<th>
														 &nbsp;
													</th>
												</tr>
											</thead>
										<tbody>
										<tr>
											<td class="d-md-flex align-items-center">
												<div class="flex-md-column">
													<h4>Cheese Quesadilla</h4>
													<p>
														Fuisset mentitum deleniti sit ea.
													</p>
													<strong>$12.00</strong>
												</div>
											</td>
											<td class="options">
												<input type="number" value="100" min="0" max="100" step="1"/>
											</td>
										</tr>
										<tr>
											<td class="d-md-flex align-items-center">
												<div class="flex-md-column">
													<h4>Cheese Quesadilla</h4>
													<p>
														Fuisset mentitum deleniti sit ea.
													</p>
													<strong>$12.00</strong>
												</div>
											</td>
											<td class="options">
												<input type="number" value="100" min="0" max="100" step="1"/>
											</td>
										</tr>
										<tr>
											<td class="d-md-flex align-items-center">
												<div class="flex-md-column">
													<h4>Cheese Quesadilla</h4>
													<p>
														Fuisset mentitum deleniti sit ea.
													</p>
													<strong>$12.00</strong>
												</div>
											</td>
											<td class="options">
												<input type="number" value="100" min="0" max="100" step="1"/>
											</td>
										</tr>																				

										</tbody>
										</table>										

								</div>
							</div>
						</div>
						<!-- /tab -->
						<div id="pane-B" class="card tab-pane" role="tabpanel" aria-labelledby="tab-B">
							<div class="card-header" role="tab" id="heading-B">
								<h5>
									<a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="true" aria-controls="collapse-B">
										Information
									</a>
								</h5>
							</div>
							<div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
								<div class="card-body info_content">
									
									
									<div class="add_bottom_25"></div>
									<h2>Pizzeria da Alfredo Menu</h2>
									<div class="pictures magnific-gallery clearfix">
										<figure><a href="<?=$relativeHomeUrl?>/img/detail_gallery/detail_1.jpg" title="Photo title" data-effect="mfp-zoom-in"><img src="<?=$relativeHomeUrl?>/img/thumb_detail_placeholder.jpg" data-src="<?=$relativeHomeUrl?>/img/thumb_detail_1.jpg" class="lazy" alt=""></a></figure>
										<figure><a href="<?=$relativeHomeUrl?>/img/detail_gallery/detail_2.jpg" title="Photo title" data-effect="mfp-zoom-in"><img src="<?=$relativeHomeUrl?>/img/thumb_detail_placeholder.jpg" data-src="<?=$relativeHomeUrl?>/img/thumb_detail_2.jpg" class="lazy" alt=""></a></figure>
										
									</div>
									<!-- /pictures -->

								</div>
							</div>
						</div>
						<!-- /tab -->

						<div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
							<div class="card-header" role="tab" id="heading-C">
								<h5>
									<a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-C">
										Reviews
									</a>
								</h5>
							</div>
							<div id="collapse-C" class="collapse" role="tabpanel" aria-labelledby="heading-C">
								<div class="card-body reviews">
									<div class="row add_bottom_45 d-flex align-items-center">
										<div class="col-md-3">
											<div id="review_summary">
												<strong>8.5</strong>
												<em>Superb</em>
												<small>Based on 4 reviews</small>
											</div>
										</div>
										<div class="col-md-9 reviews_sum_details">
											<div class="row">
												<div class="col-md-6">
													<h6>Food Quality</h6>
													<div class="row">
														<div class="col-xl-10 col-lg-9 col-9">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="col-xl-2 col-lg-3 col-3"><strong>9.0</strong></div>
													</div>
													<!-- /row -->
													<h6>Service</h6>
													<div class="row">
														<div class="col-xl-10 col-lg-9 col-9">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="col-xl-2 col-lg-3 col-3"><strong>9.5</strong></div>
													</div>
													<!-- /row -->
												</div>
												<div class="col-md-6">
													<h6>Location</h6>
													<div class="row">
														<div class="col-xl-10 col-lg-9 col-9">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
													</div>
													<!-- /row -->
													<h6>Price</h6>
													<div class="row">
														<div class="col-xl-10 col-lg-9 col-9">
															<div class="progress">
																<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</div>
														<div class="col-xl-2 col-lg-3 col-3"><strong>6.0</strong></div>
													</div>
													<!-- /row -->
												</div>
											</div>
											<!-- /row -->
										</div>
									</div>

									<div id="reviews">
										<div class="review_card">
											<div class="row">
												<div class="col-md-2 user_info">
													<figure><img src="<?=$relativeHomeUrl?>/img/avatar4.jpg" alt=""></figure>
													<h5>Lukas</h5>
												</div>
												<div class="col-md-10 review_content">
													<div class="clearfix add_bottom_15">
														<span class="rating">8.5<small>/10</small> <strong>Rating average</strong></span>
														<em>Published 54 minutes ago</em>
													</div>
													<h4>"Great Location!!"</h4>
													<p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.</p>
													<ul>
														<li><a href="#0"><i class="icon_like"></i><span>Useful</span></a></li>
														<li><a href="#0"><i class="icon_dislike"></i><span>Not useful</span></a></li>
														<li><a href="#0"><i class="arrow_back"></i> <span>Reply</span></a></li>
													</ul>
												</div>
											</div>
											<!-- /row -->
										</div>
										<!-- /review_card -->
										<div class="review_card">
											<div class="row">
												<div class="col-md-2 user_info">
													<figure><img src="<?=$relativeHomeUrl?>/img/avatar6.jpg" alt=""></figure>
													<h5>Lukas</h5>
												</div>
												<div class="col-md-10 review_content">
													<div class="clearfix add_bottom_15">
														<span class="rating">8.5<small>/10</small> <strong>Rating average</strong></span>
														<em>Published 10 Oct. 2019</em>
													</div>
													<h4>"Awesome Experience"</h4>
													<p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.</p>
													<ul>
														<li><a href="#0"><i class="icon_like"></i><span>Useful</span></a></li>
														<li><a href="#0"><i class="icon_dislike"></i><span>Not useful</span></a></li>
														<li><a href="#0"><i class="arrow_back"></i> <span>Reply</span></a></li>
													</ul>
												</div>
											</div>
											<!-- /row -->
										</div>
										<!-- /review_card -->
										<div class="review_card">
											<div class="row">
												<div class="col-md-2 user_info">
													<figure><img src="<?=$relativeHomeUrl?>/img/avatar1.jpg" alt=""></figure>
													<h5>Marika</h5>
												</div>
												<div class="col-md-10 review_content">
													<div class="clearfix add_bottom_15">
														<span class="rating">9.0<small>/10</small> <strong>Rating average</strong></span>
														<em>Published 11 Oct. 2019</em>
													</div>
													<h4>"Really great dinner!!"</h4>
													<p>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.</p>
													<ul>
														<li><a href="#0"><i class="icon_like"></i><span>Useful</span></a></li>
														<li><a href="#0"><i class="icon_dislike"></i><span>Not useful</span></a></li>
														<li><a href="#0"><i class="arrow_back"></i> <span>Reply</span></a></li>
													</ul>
												</div>
											</div>
											<!-- /row -->
											<div class="row reply">
												<div class="col-md-2 user_info">
													<figure><img src="<?=$relativeHomeUrl?>/img/avatar.jpg" alt=""></figure>
												</div>
												<div class="col-md-10">
													<div class="review_content">
														<strong>Reply from Foogra</strong>
														<em>Published 3 minutes ago</em>
														<p><br>Hi Monika,<br><br>Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his. Tollit molestie suscipiantur his et.<br><br>Thanks</p>
													</div>
												</div>
											</div>
											<!-- /reply -->
										</div>
										<!-- /review_card -->
									</div>
									<!-- /reviews -->
									<div class="text-right"><a href="leave-review.html" class="btn_1">Leave a review</a></div>
								</div>
							</div>
						</div>
					</div>
					<!-- /tab-content -->
				</div>
				<!-- /tabs_detail -->
			</div>
			<!-- /col -->

			<div class="col-lg-4" id="sidebar_fixed">
				<div class="box_booking">
					<div class="head">
						<h3>Shopping cart </h3>
					</div>
					<!-- /head -->
					<div class="main">
						<ul class="clearfix">
							<li><p>1* Enchiladas</p> <p><span class="add"><input type="number" value="1" min="0" max="100" step="1"/></span><span>$11</span><a href="#0"></a></p></li>
							<li><p>2* Burrito</p> <p><span class="add"><input type="number" value="1" min="0" max="100" step="1"/></span><span>$14</span><a href="#0"></a></p></li>
							<li><p>1* Chicken</p> <p><span class="add"><input type="number" value="1" min="0" max="100" step="1"/></span><span>$10</span><a href="#0"></a></p></li>
							<li><p>2* Corona Beer</p> <p><span class="add"><input type="number" value="1" min="0" max="100" step="1"/></span><span>$7</span><a href="#0"></a></p></li>
						</ul>

						<ul class="clearfix total">
							<li>Subtotal<span>$56</span></li>
							<li>Delivery fee<span>$10</span></li>
							<li class="total">Total<span>$66</span></li>
						</ul>


						<a href="booking-delivery-2.html" class="btn_1 full-width mb_5">Order Now</a>
					</div>
				</div>
				<!-- /box_booking -->

			</div>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->	

	<!-- Review Modal -->
	<div id="review-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Write a Review</h3>
		</div>
		<form>
			<div class="box_general write_review">

				<label class="d-block add_bottom_15">Tap to rate your experience</label>
				<div class="reviews-stars">
					<a href="" class="icons"><i class="icon_star"></i></a>
					<a href="" class="icons"><i class="icon_star"></i></a>
					<a href="" class="icons"><i class="icon_star"></i></a>
					<a href="" class="icons"><i class="icon_star"></i></a>
					<a href="" class="icons"><i class="icon_star"></i></a>
				</div>
				
				<div class="form-group">
					<label>What was not upto the mark?</label>
					<input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?">
				</div>
				<div class="form-group">
					<label>Your review</label>
					<textarea class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
				</div>
				<a href="confirm.html" class="btn_1">Submit review</a>
			</div>
		</form>
		<!--form -->
	</div>
	<!-- /Review In Modal -->	

	<!-- Share Modal -->
	<div id="share-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="modal_header">
			<h3>Share</h3>
		</div>
		<form>
			<div class="sign-in-wrapper new-box">
				<a href="" target="_blank" class="social-icons facebook"><i class="social_facebook"></i></a>
				<a href="" target="_blank" class="social-icons instagram"><i class="social_instagram"></i></a>
				<a href="" target="_blank" class="social-icons twitter"><i class="social_twitter"></i></a>
			</div>
		</form>
		<!--form -->
	</div>
	<!-- /Share In Modal -->