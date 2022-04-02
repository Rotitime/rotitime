<?php
use app\models\RtCommonMethod;
use app\models\RiCommonMethods;
/* @var $this yii\web\View */
$session = Yii::$app->session;
			$session->open();
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
						$g = 0;

						foreach($dataFromRestaurantImages as $res) { 
							if($g == 0) {
								$galleryClassName = "col-sm-12 col-md-8";
							} else {
								$galleryClassName = "col-sm-2 blocks";
							}
							if($g%2 != 0 || $g == 0) {
							?>
					<div class="<?=$galleryClassName;?>">
						<?php } ?>
						<a href="<?=$relativeHomeUrl.$res['restaurants_gallery_image']?>" title="Photo title" data-effect="mfp-zoom-in">
						<?php
								if($g == 3) { ?> 
							<div class="bg-btn"><p>View Gallery</p></div>
							<?php
							}
							?>
						<img src="<?=$relativeHomeUrl.$res['restaurants_gallery_image']?>" class="img-gallery" /></a>
					<?php
					if($g%2 == 0 || $g == 0) {
							?>
					</div>
					<?php 
							}
					$g++;			
					} ?>				
			</div>
		</section>
		<section>
			<div class="detail_page_head clearfix">

				<div class="title">
					<h1><?=$dataFromRestaurant['restaurant_name'];?></h1>
					<p><?=$dataFromAddressRestaurant['restaurant_street'].", ".$dataFromAddressRestaurant['restaurant_pincode']." ".$dataFromAddressRestaurant['restaurant_city'];?>  </p>
					<p><span>Opening and closing time</span><br/>
					<?php foreach($dataFromRestaurantTime as $res) { 
						if(date("l") == $res['timing_day']) {
						?>
						<span class="bold">
						<?php } ?>
						<?=$res['timing_day']." - ".$res['restaurant_start_time']. ":00 till ".$res['restaurant_end_time'].":00";?><br/>
					<?php
							if(date("l") == $res['timing_day']) { ?>
							</span>
						<?php }
							} ?>
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
                                <?php 
                                $menuName = "";
                                foreach($dataFromRestaurantDishes as $res) { 
                                    if($menuName != $res['menu_name']) {
                                    ?>
										<table class="table table-striped cart-list">
											<thead>
												<tr>
													<th>
														<?=$res['menu_name'];?>
													</th>
													<th>
														 &nbsp;
													</th>
												</tr>
											</thead>
										<tbody>
                                    <?php } ?>
										<tr>
											<td class="d-md-flex align-items-center">
												<div class="flex-md-column">
													<h4><?=$res['dish_name'];?>
													
                                                    <?php if(!empty($res['dish_allergy_text'])) { ?>
													<button type="button" class="info_p" data-toggle="modal" data-target="#myModal_<?=$res['dish_id'];?>">Product Info</button></h4>
                                                    
														
														 <!-- Modal -->
														<div class="modal fade" id="myModal_<?=$res['dish_id'];?>" role="dialog">
															<div class="modal-dialog">
	
															
															
															</div>
														</div>
                                                        <?php } ?>
														 <!-- Modal Closed -->	
													</h4>

													<p>
														<?=$res['dish_info_english'];?>
													</p>
													<strong>$<?=$res['dish_price'];?></strong>
												</div>
											</td>
											<td class="options  menu-details">
												<div class="input-group ">
													<div class="input-group-prepend">
														<button style="min-width: 2.5rem" class="btn btn-decrement btn-outline-secondary" type="button" onclick="basketUpdate('subs','display','<?=$res['dish_id'];?>');"><strong>−</strong></button>
													</div>
														<input type="text" id="display_<?=$res['dish_id'];?>" name="display_<?=$res['dish_id'];?>" inputmode="decimal" style="text-align: center" class="form-control " disabled = "disabled" placeholder="" value="1">
													<div class="input-group-append">
														<button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary" type="button" onclick="basketUpdate('add','display','<?=$res['dish_id'];?>');"><strong>+</strong></button>
													</div>

												</div>
                                                <?php if(!empty($displayDishSupliments[$res['restaurant_id']][$res['dish_id']]['suppliment_name'])) { ?>
													<a class="plus" role="button" data-toggle="collapse" href="#collapseExample_<?=$res['dish_id'];?>" aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="fas fa-arrow-down"></i>
													  </a>
                                                <?php } ?>
											</td>
										</tr>
                                        <?php if(!empty($displayDishSupliments[$res['restaurant_id']][$res['dish_id']]['suppliment_name'])) { ?>
										<tr>
											<td colspan="2" class="accord">
												<div class="collapse" id="collapseExample_<?=$res['dish_id'];?>">
													<!-- <div class="well">
                                                    <?php foreach($displayDishSuplimentsArr[$res['dish_id']] as $suplimentName) { ?>
														<?=$suplimentName."<br>";?>
                                                        <?php } ?>
                                                    </div> -->
                                                    <div class="well">
														<div class="row">
														<div class="col-md-3"></div>
														<div class="col-md-6">
															<form>
																<!-- <div class="form-group">
																	<label>Your sauce:</label>
																	<select class="form-control"><option>Test</option><option>Test1</option></select>
																</div> -->
																<div class="sub-items">

                                                                <?php 
                                                                $sup = 0;
                                                                foreach($displayDishSuplimentsArr[$res['dish_id']] as $suplimentName) { 
                                                                    $sup++;
                                                                    ?>
																		<div class="clearfix">
																			<div class="checkboxes float-left">
																				<label class="container_check"><?=$suplimentName;?>
																				<input type="checkbox">
																				<span class="checkmark"></span>
																				</label>
																			</div>
																			<div class="float-right mt-1"><button type="button" class="info_p1" data-toggle="modal" data-target="#myModal">Product Info</button></div>
																		</div>
                                                                    <?php 
                                                                    if($sup == 3) { ?>
                                                                    <a class="btn btn-primary plus info_p1" role="button" data-toggle="collapse" href="#showmore" aria-expanded="false" aria-controls="collapseExample">
																			Show <?= count($displayDishSuplimentsArr[$res['dish_id']] - 3)?> more
																		</a>
                                                                   <?php }
                                                                } ?>


																		<div class="clearfix">
																			<div class="checkboxes float-left">
																				<label class="container_check">Item 2
																				<input type="checkbox">
																				<span class="checkmark"></span>
																				</label>
																			</div>
																			<div class="float-right mt-1"><button type="button" class="info_p1" data-toggle="modal" data-target="#myModal">Product Info</button></div>
																		</div>
																		<div class="clearfix">
																			<div class="checkboxes float-left">
																				<label class="container_check">Item 3
																				<input type="checkbox">
																				<span class="checkmark"></span>
																				</label>
																			</div>
																			<div class="float-right mt-1"><button type="button" class="info_p1" data-toggle="modal" data-target="#myModal">Product Info</button></div>
																		</div>
																		<a class="btn btn-primary plus info_p1" role="button" data-toggle="collapse" href="#showmore" aria-expanded="false" aria-controls="collapseExample">
																			Show 4 more
																		</a>
																		<div class="collapse margin-top10" id="showmore">
																			<div class="clearfix">
																				<div class="checkboxes float-left">
																					<label class="container_check">Item 4
																					<input type="checkbox">
																					<span class="checkmark"></span>
																					</label>
																				</div>
																				<div class="float-right mt-1"><button type="button" class="info_p1" data-toggle="modal" data-target="#myModal">Product Info</button></div>
																			</div>
																			<div class="clearfix">
																				<div class="checkboxes float-left">
																					<label class="container_check">Item 5
																					<input type="checkbox">
																					<span class="checkmark"></span>
																					</label>
																				</div>
																				<div class="float-right mt-1"><button type="button" class="info_p1" data-toggle="modal" data-target="#myModal">Product Info</button></div>
                                                                            </div>	
        																																					
                                                                        </div>
                                                                        <div class="clearfix mt-3 mb-3">
																				<div class="checkboxes float-left mt-2">
																					<div class="input-group ">
													<div class="input-group-prepend">
														<button style="min-width: 2.5rem" class="btn btn-decrement btn-outline-secondary" type="button" onclick="basketUpdate('subs','display','29');"><strong>−</strong></button>
													</div>
														<input type="text" id="display_29" name="display_29" inputmode="decimal" style="text-align: center" class="form-control " disabled="disabled" placeholder="" value="1">
													<div class="input-group-append">
														<button style="min-width: 2.5rem" class="btn btn-increment btn-outline-secondary" type="button" onclick="basketUpdate('add','display','29');"><strong>+</strong></button>
													</div>

												</div>
																				</div>
																				<div class=" mt-1" style="
    width: 75%;
    float: right;
"><a href="booking-delivery-2.html" class="btn_1 full-width mb_5">Order Now</a></div>
																			</div>
																</div>																																															
															</form>
													</div>
												</div>
													</div>
												  </div>
											</td>
										</tr>	
                                        <?php } ?>														
										</tbody>
										</table>
                                        <?php 
                                    
                                        $menuName = $res['menu_name'];
                                    } 
                                    ?>											

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
				<?= $this->render('restaurant_basket', [
 
					]
					); ?> 
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
		<form  method="post">
			<div class="box_general write_review">

				<label class="d-block add_bottom_15">Tap to rate your experience</label>
				<div class="reviews-stars" id="tap_to_rate_your_experience" name="tap_to_rate_your_experience" value="">
					<a href="#" class="icons"><i class="icon_star star" id="star1" data-datac="1" ></i></a>
					<a href="#" class="icons"><i class="icon_star star" id="star2" data-datac="2" ></i></a>
					<a href="#" class="icons"><i class="icon_star star" id="star3" data-datac="3" ></i></a>
					<a href="#" class="icons"><i class="icon_star star" id="star4" data-datac="4" ></i></a>
					<a href="#" class="icons"><i class="icon_star star" id="star5" data-datac="5" ></i></a>
				</div>
				
				<div class="form-group">
					<label>What was not upto the mark?</label>
					<input class="form-control" type="text" id="what_was_not_upto_the_mark" name="what_was_not_upto_the_mark" placeholder="If you could say it in one sentence, what would you say?">
				</div>
				<div class="form-group">
					<label>Your review</label>
					<textarea id="your_review" name="your_review" class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business"></textarea>
				</div>
					  <input type="hidden" name="starReview" id="starReview" value="">
				<a href="" id="reviewsubmit" class="btn_1">Submit review</a>
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
<?php
		

		$restaurant_details = $relativeHomeUrl."js/restaurant_details.js?" . rand(1, 1000);
		$this->registerJsFile($restaurant_details);
	?>